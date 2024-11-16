<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\News
 *
 * @property int $id
 * @property string $title
 * @property string $resume
 * @property string $article
 * @property string|null $image
 * @property string|null $image_description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereImageDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereResume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia withoutTrashed()
 * @property string $release_date
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereReleaseDate($value)
 * @mixin \Eloquent
 */
class News extends Model
{

    use SoftDeletes;


    protected $fillable = ['title', 'resume', 'article', 'image', 'image_description', 'release_date'];

    public static function validationRules(): array
    {
        return [
            'title' => 'required',
            'resume' => 'required',
            'article' => 'required',
            'release_date' => 'required',
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'title.required' => 'Es necesario escribir el titulo',
            'resume.required' => 'Es necesario escribir el resumen',
            'article.required' => 'Es necesario escribir el articulo',
            'release_date.required' => 'Es necesario escribir la fecha de publicación',
        ];
    }


}
