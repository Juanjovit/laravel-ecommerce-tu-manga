<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;




/**
 * App\Models\Manga
 *
 * @property int $id
 * @property int $serie_fk
 * @property string $title
 * @property string $en_alternative_title
 * @property string $es_alternative_title
 * @property string $synopsis
 * @property int $price
 * @property string $release_date
 * @property string|null $cover
 * @property string|null $cover_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Manga newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Manga newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Manga onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Manga query()
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereCoverDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereEnAlternativeTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereEsAlternativeTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereSerieFk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereSynopsis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manga withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Manga withoutTrashed()
 * @property-read \App\Models\Serie $serie
 * @mixin \Eloquent
 */
class Manga extends Model
{

    use SoftDeletes;


    protected $fillable = ['serie_fk', 'title', 'en_alternative_title', 'es_alternative_title', 'synopsis', 'price', 'release_date', 'cover', 'cover_description'];


    public static function validationRules(): array
    {
        return [
            'title' => 'required',
            'en_alternative_title' => 'required',
            'es_alternative_title' => 'required',
            'synopsis' => 'required',
            'release_date' => 'required',
            'price' => 'required|numeric',
            'serie_fk' => 'required|numeric',
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'title.required' => 'Es necesario escribir el titulo',
            'en_alternative_title.required' => 'Es necesario escribir el titulo en ingles',
            'es_alternative_title.required' => 'Es necesario escribir el titulo en español',
            'synopsis.required' => 'Es necesario escribir la sinopsis',
            'price.required' => 'Es necesario escribir el precio',
            'price.numeric' => 'El precio tiene que ser un número',
            'release_date.required' => 'Es necesario escribir la fecha de estreno',
            'serie_fk.required' => 'Es necesario elegir una serie',
            'serie_fk.numeric' => 'El valor seleccionado la serie no es correcto.',
        ];
    }


    protected function price(): Attribute
    {

        return Attribute::make(

            fn (float $price) => $price / 100,

            fn (float $price) => $price * 100
 
        );
    }

    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class, 'serie_fk', 'id');
    }


}
