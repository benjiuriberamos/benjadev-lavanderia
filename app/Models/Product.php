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
        'title',
        'description',
        'image',
        'slug',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
    ];

    protected $casts = [
    ];

    /**
     * Get the provider that owns the product.
     */
    public function provider()
    {
        return $this->belongsTo('App\Models\Provider', 'provider_id');
    }

}
