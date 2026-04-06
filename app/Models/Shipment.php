<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'price',
        'status',
        'user_id',
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

    public function setStatusAttribute($status)
    {
        if(!in_array($status,self::ALLOWED_STATUSES)){
            throw new Exception("Invalid Status");
        };

        $this->attributes['status'] = $status;
    }

}
