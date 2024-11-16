<?php

namespace App\Http\Controllers;


use App\Models\Serie;
use App\Models\Manga;
use App\Models\News;
use App\Models\User;
use App\Models\Purchases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    //Dashboard
    public function dashboard()
    {

        $purchasesMangas = DB::table('purchases_has_mangas')
        ->join('mangas', 'purchases_has_mangas.manga_fk', '=', 'mangas.id')
        ->select(
            'mangas.id',
            'mangas.title',
            'mangas.price',
            'mangas.cover',
            'mangas.cover_description',
            'purchases_has_mangas.quantity'
        )        
        ->get();

        $mangaMasVendido = [];

        foreach ($purchasesMangas as $purchase) {
            if (!array_key_exists($purchase->id, $mangaMasVendido)) {
                $mangaMasVendido[] = [
                    'id' => $purchase->id,
                    'title' => $purchase->title,
                    'price' => $purchase->price,
                    'cover' => $purchase->cover,
                    'cover_description' => $purchase->cover_description,
                    'total_quantity' => $purchase->quantity
                ];
            } else {
                $mangaMasVendido[$purchase->id]['total_quantity'] += $purchase->quantity;
            }
        }

        usort($mangaMasVendido, function($a, $b) {
            return $b['total_quantity'] <=> $a['total_quantity'];
        });

        return view('admin.dashboard',[
            'mangaMasVendido' => $mangaMasVendido
        ]);
    }

    public function mangasDashboard()
    {
        $mangas = Manga::with(['serie'])->get();

        return view('admin.mangas', [
            'mangas' => $mangas
        ]);
    }

    public function seriesDashboard()
    {
        $series = Serie::all();

        return view('admin.series', [
            'series' => $series
        ]);
    }

    public function noticiasDashboard()
    {
        $noticias = News::all();

        return view('admin.noticias', [
            'noticias' => $noticias
        ]);
        
    }

    public function usuariosDashboard()
    {
        $usuarios = User::all();

        return view('admin.usuarios', [
            'usuarios' => $usuarios
        ]);
    }

    public function usuarioDetalle(int $id)
    {
        $usuario = User::findOrFail($id);

        $compras = Purchases::with(['user'])
                        ->where('user_fk', '=', $id)
                        ->get();


        return view('admin.usuarioDetalle', [
            'usuario' => $usuario,
            'compras' => $compras
        ]);
    }





    //Admin Mangas
    public function formNew()
    {
        return view('admin.new-manga', [
            'series' => Serie::orderBy('title')->get(),
        ]);
    }

    public function processNew(Request $request)
    {

        $data = $request->except(['_token']);
        
        $request->validate(Manga::validationRules(), Manga::validationMessages());

        if($request->hasFile('cover')) {
            $data['cover'] = $this->uploadCover($request);
        }

        Manga::create($data);

        return redirect()
            ->route('admin.mangas')
            ->with('status.message', 'Se añadio el manga <b>' . e($data['title']) . '</b> con éxito.');

    }

    public function confirmDelete(int $id)
    {
        return view('admin.confirm-delete', [
            'manga' => Manga::findOrFail($id),
        ]);
    }

    public function processDelete(int $id)
    {
        $manga = Manga::findOrFail($id);

        $manga->delete();      

        return redirect()
            ->route('admin.mangas')
            ->with('status.message', 'Se elimino el manga <b>' . e($manga->title) . '</b> con éxito. Aun podes encontrarlo en la papelera.');

    }

    public function formUpdate(int $id)
    {
        return view('admin.update-form', [
            'manga' => Manga::findOrFail($id),
            'series' => Serie::orderBy('title')->get(),
        ]);
 
    }

    public function processUpdate(int $id, Request $request)
    {
        $manga = Manga::findOrFail($id);

        $request->validate(Manga::validationRules(), Manga::validationMessages());

        $data = $request->except(['_token']);

        if($request->hasFile('cover')) {
            $data['cover'] = $this->uploadCover($request);

            $oldCover = $manga->cover;
        }

        $manga->update($data);

        $this->deleteCover($oldCover ?? null);

        return redirect()
            ->route('admin.mangas')
            ->with('status.message', 'Se actualizo el manga <b>' . e($manga->title) . '</b> con éxito.');
    }


    
    protected function uploadCover(Request $request): string
    {
        $cover = $request->file('cover');
       
        $coverName = date('YmdHis-') . \Str::slug($request->input('title')) . "." . $cover->guessExtension();

        $cover->storeAs('imgs', $coverName);

        return $coverName;
    }


    protected function deleteCover(?string $cover): void
    {
        if($cover !== null && Storage::has('imgs/' . $cover)) {
            Storage::delete('imgs/' . $cover);
        }
    }

    public function trash()
    {
        return view('admin.trashed.mangas.index', [
            'mangas' => Manga::onlyTrashed()->get(),
        ]);
    }

    public function confirmTrashDeleteManga(int $id)
    {
        return view('admin.trashed.mangas.confirm-trash-delete', [
            'manga' => Manga::onlyTrashed()->findOrFail($id),
        ]);
    }

    public function processTrashDeleteManga(int $id)
    {
        $manga = Manga::onlyTrashed()->findOrFail($id);

        $manga->forceDelete();

        $this->deleteCover($manga->cover);

        return redirect()
            ->route('admin.trashed.mangas.index')
            ->with('status.message', 'Se elimino el manga de forma permanente <b>' . e($manga->title) . '</b> con éxito.');
    }


    //Admin Noticias
    public function formNewNoticia()
    {
        return view('admin.new-noticia');
    }

    public function processNewNoticia(Request $request)
    {

        $data = $request->except(['_token']);
        
        $request->validate(News::validationRules(), News::validationMessages());

        if($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request);
        }

        News::create($data);

        return redirect()
            ->route('admin.noticias')
            ->with('status.message', 'Se añadio la noticia <b>' . e($data['title']) . '</b> con éxito.');

    }

    public function formUpdateNoticia(int $id)
    {
        return view('admin.update-form-noticia', [
            'noticia' => News::findOrFail($id),
        ]);
    }

    public function processUpdateNoticia(int $id, Request $request)
    {
        $noticia = News::findOrFail($id);

        $request->validate(News::validationRules(), News::validationMessages());

        $data = $request->except(['_token']);

        if($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request);

            $oldImage = $noticia->image;
        }

        $noticia->update($data);

        $this->deleteImage($oldImage ?? null);

        return redirect()
            ->route('admin.noticias')
            ->with('status.message', 'Se actualizo el noticia <b>' . e($noticia->title) . '</b> con éxito.');
    }






    public function confirmDeleteNoticia(int $id)
    {
        return view('admin.confirm-delete-noticia', [
            'noticia' => News::findOrFail($id),
        ]);
    }

    public function processDeleteNoticia(int $id)
    {
        $noticia = News::findOrFail($id);

        $noticia->delete();      

        return redirect()
            ->route('admin.noticias')
            ->with('status.message', 'Se elimino el noticia <b>' . e($noticia->title) . '</b> con éxito. Aun podes encontrarlo en la papelera.');

    }





    public function trashNoticia()
    {
        return view('admin.trashed.noticias.index', [
            'noticias' => News::onlyTrashed()->get(),
        ]);
    }

    public function confirmTrashDeleteNoticia(int $id)
    {
        return view('admin.trashed.noticias.confirm-trash-delete', [
            'noticia' => News::onlyTrashed()->findOrFail($id),
        ]);
    }

    public function processTrashDeleteNoticia(int $id)
    {
        $noticia = News::onlyTrashed()->findOrFail($id);

        $noticia->forceDelete();

        $this->deleteImage($noticia->image);

        return redirect()
            ->route('admin.trashed.noticias.index')
            ->with('status.message', 'Se elimino la noticia de forma permanente <b>' . e($noticia->title) . '</b> con éxito.');
    }

    protected function uploadImage(Request $request): string
    {
        $image = $request->file('image');
       
        $imageName = date('YmdHis-') . \Str::slug($request->input('title')) . "." . $image->guessExtension();

        $image->storeAs('imgs', $imageName);

        return $imageName;
    }


    protected function deleteImage(?string $image): void
    {
        if($image !== null && Storage::has('imgs/' . $image)) {
            Storage::delete('imgs/' . $image);
        }
    }


    //Admin Series
    public function formNewSerie()
    {
        return view('admin.new-serie');
    }

    public function processNewSerie(Request $request)
    {

        $data = $request->except(['_token']);
        
        $request->validate(Serie::validationRules(), Serie::validationMessages());

        if($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request);
        }

        Serie::create($data);

        return redirect()
            ->route('admin.series')
            ->with('status.message', 'Se añadio la serie <b>' . e($data['title']) . '</b> con éxito.');

    }

    public function confirmDeleteSerie(int $id)
    {
        return view('admin.confirm-delete-serie', [
            'serie' => Serie::findOrFail($id),
        ]);
    }

    public function processDeleteSerie(int $id)
    {
        $mangas = Manga::with(['serie'])
            ->where('serie_fk', '=', $id)
            ->get();

        foreach ($mangas as $manga) {
            $this->deleteCover($manga->cover);
        }

        $mangas = Manga::with(['serie'])
            ->where('serie_fk', '=', $id)
            ->forceDelete();

        $serie = Serie::findOrFail($id);

        $serie->delete();      

        $this->deleteImage($serie->image);

        return redirect()
            ->route('admin.series')
            ->with('status.message', 'Se elimino el serie y todos los mangas relaciondas a la misma permanentemente <b>' . e($serie->title) . '</b> con éxito.');

    }

    public function formUpdateSerie(int $id)
    {
        return view('admin.update-form-serie', [
            'serie' => Serie::findOrFail($id),
        ]);
    }

    public function processUpdateSerie(int $id, Request $request)
    {
        $serie = Serie::findOrFail($id);

        $request->validate(Serie::validationRules(), Serie::validationMessages());

        $data = $request->except(['_token']);

        if($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request);

            $oldImage = $serie->image;
        }

        $serie->update($data);

        $this->deleteImage($oldImage ?? null);

        return redirect()
            ->route('admin.series')
            ->with('status.message', 'Se actualizo el serie <b>' . e($serie->title) . '</b> con éxito.');
    }


}
