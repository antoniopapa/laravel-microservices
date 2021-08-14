<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LinkProduct
 *
 * @property int $id
 * @property int $link_id
 * @property int $product_id
 * @method static \Illuminate\Database\Eloquent\Builder|LinkProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkProduct whereLinkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkProduct whereProductId($value)
 * @mixin \Eloquent
 */
class LinkProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;
}
