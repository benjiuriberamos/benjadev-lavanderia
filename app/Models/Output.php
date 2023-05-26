<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'outputs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_input',
        'user_id',
    ];

    // protected $casts = [
    //     'image_items' => 'json',
    // ];

    /**
     * Get the input_details for the input.
     */
    public function outputDetails()
    {
        return $this->hasMany('App\Models\OutputDetail', 'output_id');
    }

    /**
     * Get the user associated with the detail.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
