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

   public function createNew($request)
    {
        $this->shipmentModel->create([
            'title' => $request['title'],
            'from_city' => $request['from_city'],
            'from_country' => $request['from_country'],
            'to_city' => $request['to_city'],
            'to_country' => $request['to_country'],
            'price' => $request['price'],
            'status' => $request['status'],
            'user_id' => $request['user_id'],
            'details' => $request['details'],
        ]);
    }

}