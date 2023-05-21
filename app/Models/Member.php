<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'members';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active',
        'name',
        'charge',
        'image',
        'facebook',
        'instagram',
        'twiter',
    ];

    // protected $casts = [
    //     'image_items' => 'json',
    // ];

    /**
     * Get the brand that owns the product.
     */
    public function home()
    {
        return $this->belongsTo('App\Models\PageAbout', 'about_id');
    }

}
