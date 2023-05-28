<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subuser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_subusers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'local_id',
        'user_id',
    ];

    // protected $casts = [
    //     'image_items' => 'json',
    // ];

    /**
     * Get the phone record associated with the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function local()
    {
        return $this->belongsTo('App\Models\Local');
    }

    /**
     * Get the input_details for the input.
     */
    public function inputDetails()
    {
        return $this->hasMany('App\Models\InputDetail', 'input_id');
    }

}
