<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



/**
 * App\Models\Purchases
 *
 * @property int $id
 * @property int $user_fk
 * @property int $total_price
 * @property string $purchase_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Purchases newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchases newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchases query()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchases whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchases whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchases wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchases whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchases whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchases whereUserFk($value)
 * @mixin \Eloquent
 */
class Purchases extends Model
{

    protected $fillable = ['total_price', 'purchase_date', 'user_fk'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_fk', 'user_id');
    }

    public function mangas(): BelongsToMany
    {
        return $this->belongsToMany(
            Manga::class,
            'purchases_has_mangas',
            'purchase_fk', 
            'manga_fk',
            'id',
            'id',
        )->withPivot('quantity');
    }
}
