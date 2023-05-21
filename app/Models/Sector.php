<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
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
        'home_text',
        'home_btn_text',
        'home_image',
    ];

    /**
     * The products that belong to the sector.
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Products', 'products_sectors', 'product_id', 'sector_id');
    }
}
