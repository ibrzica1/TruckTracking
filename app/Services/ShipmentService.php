<?php

namespace App\Services;

use App\Repositories\ShipmentsRepository;

class ShipmentService
{
    public function store($data)
    {
        $shipmentRepo = new ShipmentsRepository;
        $shipmentRepo->createNew($data);
    }
}