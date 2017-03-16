<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const MAX_LENGTH_NAME = 50;
    const IMAGE_DIR = 'uploads/products';
    const NO_IMAGE_URI = 'img/no-image.jpg';
    const RESTOCK_METER = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'stocks_left', 'is_made_to_order', 'price', 'description', 'image_url'
    ];

    public static function getNumNeedsRestock()
    {
        return self::query()
            ->where('stocks_left', '<=', self::RESTOCK_METER)
            ->get()
            ->count();
    }

    public static function getBaseUploadDir()
    {
        return base_path().'/public/'.self::IMAGE_DIR;
    }

    public function getImage()
    {
        $imageUrl = self::IMAGE_DIR.'/'.$this->image_url;

        if (!file_exists($imageUrl)) {
            $imageUrl = self::NO_IMAGE_URI;
        }

        return asset($imageUrl);
    }

    public function isNeedsRestock()
    {
        return $this->stocks_left <= self::RESTOCK_METER && !$this->is_made_to_order;
    }
}