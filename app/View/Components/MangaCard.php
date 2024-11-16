<?php

namespace App\View\Components;

use App\Models\Manga;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MangaCard extends Component
{

    public function __construct(
        public Manga $manga
    )
    {}


    public function render(): View|Closure|string
    {
        return view('components.manga-card');
    }
}
