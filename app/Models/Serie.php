<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Serie
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Serie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Serie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Serie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Serie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Serie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Serie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Serie whereUpdatedAt($value)
 * @property string|null $image
 * @property string|null $image_description
 * @method static \Illuminate\Database\Eloquent\Builder|Serie whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Serie whereImageDescription($value)
 * @mixin \Eloquent
 */
class Serie extends Model
{
    protected $fillable = ['title', 'image', 'image_description'];

    public static function validationRules(): array
    {
        return [
            'title' => 'required',
        ];
    }

    public static function validationMessages(): array
    {
        return [
            'title.required' => 'Es necesario escribir el titulo',
        ];
    }}
