<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentFile;

class ShipmentFileController extends Controller
{
   public function show(Shipment $shipment)
   {
        $shipmentFiles = [];

        $shipmentFiles = ShipmentFile::where('shipment_id',$shipment->id)->get();

        return view('shipments.show-files', compact('shipmentFiles'));
   }
}
