<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageHome extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'home';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banner_show',
        'sector_show',
        'product_show',
        'product_title',
        'offert_show',
        'offert_title',
        'offert_subtitle',
        'offert_image',
        'offert_btn_show',
        'offert_btn_target',
        'offert_btn_text',
        'offert_btn_url',
        'category_show',
        'category_title',
        'brand_show',
        'clients_show',
        'clients_items',
        'about_show',
        'about_title',
        'about_description',
        'about_image',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'clients_items' => [],
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'clients_items' => 'array',
    ];

    /**
     * Get the products for the brand post.
     */
    public function banners()
    {
        return $this->hasMany('App\Models\Banner', 'home_id');
    }

    public function getClientsItemsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setClientsItemsAttribute($value)
    {
        $this->attributes['clients_items'] = json_encode(array_values($value));
    }

}
