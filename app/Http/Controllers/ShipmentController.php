<?php

namespace App\Http\Controllers;

use App\Models\Shipments;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveShipmentRequest;
use App\Repositories\ShipmentsRepository;
use Illuminate\Http\Request;

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
        $shipments = Shipments::all();
        return  view('shipments.index',compact('shipments'));   
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
        $this->shipmentsRepo->createNew($request->validated());
        return redirect()->route('shipments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipments $shipments)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipments $shipments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipments $shipments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipments $shipments)
    {
        //
    }
}
