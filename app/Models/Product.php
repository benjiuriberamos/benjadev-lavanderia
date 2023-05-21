<?php

namespace App\Models;

use App\Traits\ProductFilterTrait;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active',
        'title',
        'descripcion',
        'image',
        'image_items',
        'home_show',
        'is_top',
        'price',
        'sku',
        'quantity',
        'material_text',
        'description_show',
        'description_items',
        'related_show',
        'related_title',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'image_items' => [],
        'description_items' => [],
    ];

    protected $casts = [
        'image_items' => 'array',
        'description_items' => 'array',
    ];

    /**
     * Get the brand that owns the product.
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    /**
     * The categories that belong to the product.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'products_categories', 'product_id', 'category_id');
    }

    /**
     * The colors that belong to the product.
     */
    public function colors()
    {
        return $this->belongsToMany('App\Models\Color', 'products_colors', 'product_id', 'color_id');
    }

    /**
     * The sectors that belong to the product.
     */
    public function sectors()
    {
        return $this->belongsToMany('App\Models\Sector', 'products_sectors', 'product_id', 'sector_id');
    }

    /**
     * The sizes that belong to the product.
     */
    public function sizes()
    {
        return $this->belongsToMany('App\Models\Size', 'products_sizes', 'product_id', 'size_id');
    }

    /**
     * The sizes that belong to the product.
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'related_products', 'product_id', 'product_related_id');
    }

    public function getImageItemsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setImageItemsAttribute($value)
    {
        $this->attributes['image_items'] = json_encode(array_values($value));
    }

    public function getDescriptionItemsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setDescriptionItemsAttribute($value)
    {
        $this->attributes['description_items'] = json_encode(array_values($value));
    }
    
}
