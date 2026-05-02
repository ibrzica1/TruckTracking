<?php

use App\Http\Requests\SaveShipmentRequest;
use App\Models\Shipment;
use App\Models\User;
use App\Services\ShipmentService;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public string $title;

    public string $fromCity;

    public string $fromCountry;

    public string $toCity;

    public string $toCountry;

    public float $price;

    public int $clientId;
    public string $clientError;

    public array $documents;

    public string $details;

    public array $statuses = [];
    public string $status = '';

    public function mount()
    {
        $this->statuses = Shipment::ALLOWED_STATUSES;
    }

    public function validateClient()
    {
       /* $user = User::firstWhere('id', $this->clientId);
         $this->clientError = "";
        if(!$user){
            $this->clientError = 'This client doesnt exist';
        }  */

        $this->validate([
            'clientId' => 'required|integer|exists:users,id'
        ]);
        
    }

    public function submit(ShipmentService $shipmentService)
    {
        $request = new SaveShipmentRequest();

        $data = $this->validate($request->rules());

        $shipmentService->store($data);
    }
};
?>

<div>
    
    <form action="{{ route('shipments.store') }}" method="POST"  
    wire:submit="submit" class="container mt-4" enctype="multipart/form-data">

        @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach

        <h1 class="mb-4">Create Shipment</h1>

        <div class="col-md-6 mb-3">
            <label class="form-label">Title</label>
            <input type="text" wire:model="title" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">From City</label>
            <input type="text" wire:model='fromCity' class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">From Country</label>
            <input type="text" wire:model='fromCountry' class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">To City</label>
            <input type="text" wire:model='toCity' class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">To Country</label>
            <input type="text" wire:model='toCountry' class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Price (€)</label>
            <input type="number" step="0.01" wire:model='price' class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            @error('clientId')
                <p>{{$message}}</p>
            @enderror
            <label class="form-label">Client</label>
            <input type="number" wire:blur="validateClient" wire:model='clientId' class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <select wire:model="status">
                @foreach ($statuses as $singleStatus)
                    <option value="{{$singleStatus}}">{{$singleStatus}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="documents">Documents</label>
            <input type="file" wire:model='documents' class="form-control" required multiple>
        </div>

        <div class="col-12 mb-3">
            <label class="form-label">Details</label>
            <textarea wire:model='details' class="form-control" rows="4"></textarea>
        </div>

        <button type="submit">Create Shipment</button>

    </form>

</div>