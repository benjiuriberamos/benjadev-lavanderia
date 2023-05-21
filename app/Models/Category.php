<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'home_show',
        'home_image',
        'header_show',
        'footer_show',
    ];

    /**
     * The products that belong to the category.
     */
    public function products()
    {
        return $this->belongsToMany('App\Model\Product', 'products_categories', 'product_id', 'category_id');
    }
}
