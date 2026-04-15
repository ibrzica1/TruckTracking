<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentFile extends Model
{
    protected $table = 'shipment_files';

    protected $fillable = [
        'file_name',
        'shipment_id',
        'type',
    ];
}
