<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imageb1',
        'imageb2',
        'imageb3',
        'title',
        'subtitle',
        'btn_show',
        'btn_target',
        'btn_text',
        'btn_url',
    ];


    /**
     * Get the brand that owns the product.
     */
    public function home()
    {
        return $this->belongsTo('App\Models\PageHome', 'home_id');
    }

}
