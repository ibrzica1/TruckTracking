<?php

namespace App\Repositories;

use App\Models\ShipmentFile;

class ShipmentFileRepository
{
    private $shipmentFileModel;

    public function __construct()
    {
        $this->shipmentFileModel = new ShipmentFile();
    }

    public function createNew($path,$shipmentId,$type)
    {
        $shipmentFile = $this->shipmentFileModel::create([
            'file_name' => $path,
            'shipment_id' => $shipmentId,
            'type' => $type,
        ]);

        return $shipmentFile;
    }


}