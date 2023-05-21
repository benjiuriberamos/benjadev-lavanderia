<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContact extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'main_show',
        'main_title',
        'map_show',
        'map_iframe',
        'form_show',
        'contact_show',
        'contact_title',
        'contact_items',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
    ];

    protected $casts = [
        'contact_items' => 'json',
    ];

    public function getContactItemsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setContactItemsAttribute($value)
    {
        $this->attributes['contact_items'] = json_encode(array_values($value));
    }

    
}
