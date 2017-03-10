<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'quantity'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id')->getResults();
    }

    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'product_id')->getResults();
    }

    public static function getItem($userId, $productId)
    {
        return self::query()
            ->where([
                ['user_id', '=', $userId],
                ['product_id', '=', $productId],
            ])->first();
    }
}