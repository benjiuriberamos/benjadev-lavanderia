<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutputDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'output_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity',
        'price',
        'output_id',
        'product_id',
        'is_subalmacen',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setAttribute('is_subalmacen', 0);
    }

    /**
     * Get the product associated with the detail.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * Get the product associated with the detail.
     */
    public function output()
    {
        return $this->belongsTo('App\Models\Output');
    }
}
