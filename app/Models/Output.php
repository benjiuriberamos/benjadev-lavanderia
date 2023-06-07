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
        'factory',
        'date_input',
        'user_id',
        'local_id',
        'is_subalmacen',
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

    /**
     * Get the local associated with the detail.
     */
    public function local()
    {
        return $this->belongsTo('App\Local');
    }
}
