<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $table = 'services_order';
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer',
        'order_date',
        'total_funds',
        'status',
        'pickup_phone',
        'email',
        'booking_time',
        'id_user',
        'product_id'
    ];

    protected $casts = [
        'customer' => 'string',
        'order_date' => 'datetime',
        'total_funds' => 'int',
        'status' => 'int' ,
        'pickup_phone' => 'string',
        'email' => 'string',
        'booking_time' => 'datetime',
        'id_user' => 'int',
        'product_id' => 'int'
    ];

    protected $dates = [
        'order_date',
        'booking_time'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = \Str::uuid();
        });
    }

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
};
