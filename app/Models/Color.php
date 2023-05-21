<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'slug',
    ];

    /**
     * The products that belong to the color.
     */
    public function products()
    {
        return $this->belongsToMany('App\Model\Product', 'products_colors', 'product_id', 'color_id');
    }
}
