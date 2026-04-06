<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Shipments;

class ShipmentsRepository
{
    private $shipmentModel;

    public function __construct()
    {
        $this->shipmentModel = new Shipments();
    }

    

}