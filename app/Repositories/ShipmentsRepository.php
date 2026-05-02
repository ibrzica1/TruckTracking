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
            'from_city' => $request['fromCity'],
            'from_country' => $request['fromCountry'],
            'to_city' => $request['toCity'],
            'to_country' => $request['toCountry'],
            'price' => $request['price'],
            'client_Id' => $request['clientId'],
            'status' => $request['status'],
            'details' => $request['details'],
        ]);

        return $shipment;
    }

}