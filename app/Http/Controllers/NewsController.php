<?php

namespace App\Http\Controllers;

use App\Models\News;


class NewsController extends Controller
{

    
    public function noticias()
    {
        $noticias = News::all();

        return view('noticias', [
            'noticias' => $noticias
        ]);
    }

    public function noticiaById(int $id)
    {
        $noticia = News::findOrFail($id);

        return view('noticiaById', [
            'noticia' => $noticia,
        ]);
    }
}
