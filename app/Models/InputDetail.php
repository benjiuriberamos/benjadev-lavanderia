<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'input_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity',
        'price',
        'input_id',
        'product_id',
    ];

    /**
     * Get the product associated with the detail.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * Get the input associated with the detail.
     */
    public function input()
    {
        return $this->belongsTo('App\Models\Input');
    }
}
