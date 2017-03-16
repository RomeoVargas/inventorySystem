<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_NEW            = 1;
    const STATUS_FOR_DELIVER    = 2;
    const STATUS_COMPLETED      = 3;
    const STATUS_CANCELLED      = 4;
    const STATUS_UNPAID         = 5;

    public static $statuses = array(
        0                           => 'All Orders',
        self::STATUS_NEW            => 'Pending',
        self::STATUS_FOR_DELIVER    => 'Scheduled for Delivery',
        self::STATUS_COMPLETED      => 'Delivered',
        self::STATUS_CANCELLED      => 'Cancelled',
        self::STATUS_UNPAID         => 'Unpaid'
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'status', 'delivery_address', 'date_delivered'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id')->getResults();
    }

    public function getItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id')->getResults();
    }

    public function getReferenceNumber()
    {
        return strtotime($this->created_at);
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->getItems() as $orderItem) {
            $totalPrice += ($orderItem->price * $orderItem->quantity);
        }

        return $totalPrice;
    }

    public function isNew()
    {
        return $this->status == self::STATUS_NEW;
    }

    public function isForDeliver()
    {
        return $this->status == self::STATUS_FOR_DELIVER;
    }

    public function isCompleted()
    {
        return $this->status == self::STATUS_COMPLETED;
    }

    public function isCancelled()
    {
        return $this->status == self::STATUS_CANCELLED;
    }

    public function isUnpaid()
    {
        return $this->status == self::STATUS_UNPAID;
    }

    public function isTransactionDone()
    {
        return $this->isCompleted() || $this->isCancelled() || $this->isUnpaid();
    }

    public function getViewClass()
    {
        switch ($this->status) {
            case self::STATUS_NEW:
                return 'warning';
            case self::STATUS_FOR_DELIVER:
                return 'info';
            case self::STATUS_COMPLETED:
                return 'success';
            case self::STATUS_CANCELLED:
            case self::STATUS_UNPAID:
                return 'danger';
            default:
                throw new \InvalidArgumentException('Invalid status');
        }
    }

    public static function search($dateFrom, $dateTo, $userId = null, $status = null)
    {
        $condition = array(
            ['created_at', '>=', to_time_format($dateFrom, 'Y-m-d 00:00:00')],
            ['created_at', '<=', to_time_format($dateTo, 'Y-m-d 23:59:59')],
        );
        if ($userId) {
            $condition[] = array('user_id', '=', $userId);
        }
        if ($status) {
            $condition[] = array('status', '=', $status);
        }

        return self::query()
            ->where($condition)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public static function getSummary($dateFrom, $dateTo)
    {
        $orders = self::search($dateFrom, $dateTo);

        $summary = array(
            self::STATUS_NEW            => 0,
            self::STATUS_FOR_DELIVER    => 0,
            self::STATUS_COMPLETED      => 0,
            self::STATUS_CANCELLED      => 0,
            self::STATUS_UNPAID         => 0,
        );
        foreach ($orders as $order) {
            $summary[$order->status]++;
        }

        return $summary;
    }

    public static function getByReferenceNumber($refNum)
    {
        $createdAt = Carbon::createFromTimestamp($refNum);

        return self::query()
            ->where('created_at', '=', $createdAt->toDateTimeString())
            ->first();
    }
}