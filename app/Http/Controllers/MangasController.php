<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Serie;


class MangasController extends Controller
{


    public function shop()
    {
        $mangas = Manga::with(['serie'])->get();


        return view('shop', [
            'mangas' => $mangas
        ]);
    }

    public function series()
    {
        $series = Serie::all();

        return view('series', [
            'series' => $series
        ]);
    }

    public function serieById(int $id)
    {
        $mangas = Manga::with(['serie'])
                        ->where('serie_fk', '=', $id)
                        ->get();

        return view('seriesById', [
            'mangas' => $mangas,
        ]);
    }

    public function mangaById(int $id)
    {
        $manga = Manga::findOrFail($id);

        return view('mangas', [
            'manga' => $manga,
        ]);
    }
}
