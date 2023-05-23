<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'locals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
    ];

    // protected $casts = [
    //     'image_items' => 'json',
    // ];

}
