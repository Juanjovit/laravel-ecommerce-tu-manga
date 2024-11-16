<?php
/** @var \App\Models\Manga $movie */
?>
<article class="card customCard mb-3 d-flex ">
    <div class="card d-flex">
        <a href="{{ route('mangas' , ['id' => $manga->id]) }}">
            @if($manga->cover !== null && Storage::has('imgs/' . $manga->cover))
                <img src="{{ Storage::url('imgs/' . $manga->cover) }}" alt="{{ $alt ?? $manga->cover_description }}" class="w-100">
            @else
                <img src="{{ Storage::url('imgs/' . 'imagenNoDisponible.jpg') }}" alt="imagen no disponible" class="w-100">
            @endif        
            <div class="card-body">
                <h3 class="card-title">{{ $manga->title }}</h3>
                <p class="card-text">{{ $manga->synopsis }}</p>
                <p class="card-text">${{ $manga->price }}</p>
            </div>
        </a>
    </div>
</article>
