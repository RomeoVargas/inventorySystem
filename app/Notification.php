<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    const TYPE_NEW_ORDER = 1;
    const TYPE_CANCELLED_ORDER = 2;
    const TYPE_NEW_CUSTOMER = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'content', 'link', 'is_read'
    ];

    public static function getUnreadByDateRange($dateFrom, $dateTo, $type)
    {
        return self::query()
            ->where([
                ['is_read', '=', false],
                ['type', '=', $type],
                ['created_at', '>=', to_time_format($dateFrom, 'Y-m-d 00:00:00')],
                ['created_at', '<=', to_time_format($dateTo, 'Y-m-d 23:59:59')],
            ])->get();
    }

    public static function getAllUnread()
    {
        return self::query()->where('is_read', '=', false)->get();
    }
}