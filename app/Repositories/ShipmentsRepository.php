<?php

namespace App\Repositories;

use App\Models\Shipment;

class ShipmentsRepository
{
    private $shipmentModel;

    public function __construct()
    {
        $this->shipmentModel = new Shipment();
    }

   public function createNew($request)
    {
        $shipment = $this->shipmentModel->create([
            'title' => $request['title'],
            'from_city' => $request['from_city'],
            'from_country' => $request['from_country'],
            'to_city' => $request['to_city'],
            'to_country' => $request['to_country'],
            'price' => $request['price'],
            'user_id' => $request['user_id'],
            'status' => $request['status'],
            'details' => $request['details'],
        ]);

        return $shipment;
    }

}