<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Manga;
use Illuminate\Http\Request;

class MangasAdminController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 0,
            'data' => Manga::all(),
        ]);
    }

    public function view(int $id)
    {
        return response()->json([
            'status' => 0,
            'data' => Manga::findOrFail($id),
        ]);
    }

    public function create(Request $request)
    {

        $manga = Manga::create($request->only(['serie_fk', 'title', 'en_alternative_title', 'es_alternative_title', 'synopsis' , 'price', 'release_date', 'cover', 'cover_description']));

        return response()->json([
            'status' => 0,
            'data' => $manga
        ]);
    }
}
