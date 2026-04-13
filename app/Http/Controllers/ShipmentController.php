<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\SaveShipmentRequest;
use App\Models\Shipment;
use App\Repositories\ShipmentsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShipmentController extends Controller
{
    private $shipmentsRepo;

    public function __construct()
    {
        $this->shipmentsRepo = new ShipmentsRepository();
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
        $fileTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];
        foreach($request->file('documents') as $document){
            if(str_starts_with($document->getMimeType(),'image/') ){
                dd('Its a picture');
            }elseif(in_array($document->getMimeType(),$fileTypes)){
                dd('Its a document');
            }else{
                dd('Not allowed');
            }
        }
        $this->shipmentsRepo->createNew($request->validated());
        return redirect()->route('shipments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        return view('shipments.show', compact('shipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipments)
    {
        //
    }
}
