<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'name', 'price', 'quantity'
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * To disable usage of date_created and date_last_modified in queries
     *
     * @var bool
     */
    public $timestamps = false;

    public function getOrder()
    {
        return $this->belongsTo(Order::class, 'order_id')->getResults();
    }
}