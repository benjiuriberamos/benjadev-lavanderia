<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inputs';

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
    public function inputDetails()
    {
        return $this->hasMany('App\Models\InputDetail', 'input_id');
    }

}
