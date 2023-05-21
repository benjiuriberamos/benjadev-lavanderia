<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
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
     * Get the products for the brand post.
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'products_brand_id_foreign', 'brand_id');
    }
}
