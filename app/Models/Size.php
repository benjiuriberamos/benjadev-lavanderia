<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * The products that belong to the size.
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Products', 'products_sizes', 'product_id', 'size_id');
    }
}
