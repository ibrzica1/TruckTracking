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
            'title' => $request->get('title'),
            'from_city' => $request->get('from_city'),
            'from_country' => $request->get('from_country'),
            'to_city' => $request->get('to_city'),
            'to_country' => $request->get('to_country'),
            'price' => $request->get('price'),
            'status' => $request->get('status'),
            'user_id' => $request->get('user_id'),
            'details' => $request->get('details'),
        ]);
    }

}