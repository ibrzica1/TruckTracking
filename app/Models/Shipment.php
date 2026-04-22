<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

use function PHPUnit\Framework\throwException;

class Shipment extends Model
{
    use HasFactory;

    protected $table = 'shipment';
    
    protected $fillable = [
        'title',
        'from_city',
        'from_country',
        'to_city',
        'to_country',
        'user_id', 
        'client_id',
        'price',
        'status',
        'details'
    ];

    const STATUS_IN_PROGRESS = 'in_progress';
    const UNNASIGNED = 'unnasigned';
    const COMPLETED = 'completed';
    const PROBLEM = 'problem';

    const ALLOWED_STATUSES = [
        self::STATUS_IN_PROGRESS, self::UNNASIGNED,
        self::COMPLETED, self::PROBLEM
    ];

    public static function booted()
    {
        static::created(function($shipment) {
            if($shipment->status === self::UNNASIGNED){
                Cache::forget('unnasignedShipments');
            }
        });
    }

    public function setStatusAttribute($status)
    {
        if(!in_array($status,self::ALLOWED_STATUSES)){
            throw new Exception("Invalid Status");
        };

        $this->attributes['status'] = $status;
    }

    public function files()
    {
        return $this->hasMany(ShipmentFile::class,'shipment_id','id');
    }

}
