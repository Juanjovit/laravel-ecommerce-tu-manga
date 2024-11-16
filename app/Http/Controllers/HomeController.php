<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\News;
use App\Models\User;
use App\Models\Purchases;



class HomeController extends Controller
{
    public function home()
    {
        $mangas = Manga::with(['serie'])->get();
        $noticias = News::all();

        return view('home', [
            'mangas' => $mangas,
            'noticias' => $noticias

        ]);

    }

    public function perfil(int $id)
    {
        $usuario = User::findOrFail($id);
        $compras = Purchases::with(['user'])
                        ->where('user_fk', '=', $id)
                        ->get();
                                    
        return view('perfil', [
            'usuario' => $usuario,
            'compras' => $compras
        ]);
    }

    public function verCompra(int $id, int $compra_id)
    {
        $usuario = User::findOrFail($id);
        $compra = Purchases::findOrFail($compra_id);
             
        return view('verCompra', [
            'usuario' => $usuario,
            'compra' => $compra
        ]);
    }
    



    public function carrito(int $id)
    {
        $mangas = Manga::with(['serie'])->get();
        $noticias = News::all();

        return view('home', [
            'mangas' => $mangas,
            'noticias' => $noticias

        ]);
    }

}
