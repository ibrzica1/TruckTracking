<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\SaveShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Shipment;
use App\Repositories\ShipmentFileRepository;
use App\Repositories\ShipmentsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\ShipmentFile;
use App\Traits\ImageUpload;

class ShipmentController extends Controller
{
    use ImageUpload;

    private $shipmentsRepo;
    private $shipmentFileRepo;

    public function __construct()
    {
        $this->shipmentsRepo = new ShipmentsRepository();
        $this->shipmentFileRepo = new ShipmentFileRepository();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipments = Cache::remember('unnasignedShipments',300,function() {
            return Shipment::where('status',Shipment::UNNASIGNED)->get();
        });
        return  view('welcome',compact('shipments'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shipments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveShipmentRequest $request)
    {
        $shipment = $this->shipmentsRepo->createNew($request->validated());

        $fileTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];
        foreach($request->file('documents') as $document){
            if(str_starts_with($document->getMimeType(),'image/') ){
                
                $name = $this->uploadImage($document,'documents/'.$shipment->id);
                $path = $shipment->id.'/'.$name;

                $this->shipmentFileRepo->createNew($path,$shipment->id,'image');

            }elseif(in_array($document->getMimeType(),$fileTypes)){

                $shipmentId = $shipment->id;

                $extension = $document->getClientOriginalExtension();

                $fileName = uniqid().".".$extension;

                $path = $document->storeAs("documents/{$shipmentId}",$fileName,'public');
                $path = str_replace('documents/',"",$path);

                $this->shipmentFileRepo->createNew($path,$shipmentId,'document');

            }else{
                dd('Not allowed');
            }
        }
        
        return redirect()->route('shipments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        return view('shipments.show', compact('shipment'));
    }

    public function showFile(ShipmentFile $shipmentFile)
    {
        return view('shipments.show-files', compact('shipmentFile'));
    }
   
    public function edit(Shipment $shipment)
    {
        return view('shipments.edit', compact('shipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShipmentRequest $request, Shipment $shipment)
    {
        $shipment->update($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipments)
    {
        //
    }
}
