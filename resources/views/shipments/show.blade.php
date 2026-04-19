@extends("layout")

@section("pageTitle")
    Show Shipment
@endsection

@section("content")

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">

            <h2 class="card-title mb-4">
                {{$shipment->title}}
            </h2>

            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>From:</strong><br>
                    {{$shipment->from_city}}, {{$shipment->from_country}}
                </div>

                <div class="col-md-6">
                    <strong>To:</strong><br>
                    {{$shipment->to_city}}, {{$shipment->to_country}}
                </div>

                
            </div>

            

            <hr>

            <p>
                <strong>Price:</strong> €{{$shipment->price}}
            </p>

            <p>
                <strong>Status:</strong>
                <span class="badge 
                    @if($shipment->status == \App\Models\Shipment::STATUS_IN_PROGRESS) bg-warning
                    @elseif($shipment->status == \App\Models\Shipment::UNNASIGNED) bg-secondary
                    @elseif($shipment->status == \App\Models\Shipment::COMPLETED) bg-success
                    @elseif($shipment->status == \App\Models\Shipment::PROBLEM) bg-danger
                    @endif
                ">
                    {{ str_replace('_', ' ', $shipment->status) }}
                </span>
            </p>


            <p>
                <strong>User ID:</strong> {{$shipment->user_id}}
            </p>

            <p>
                <strong>Details:</strong><br>
                {{$shipment->details ?? 'No details provided.'}}
            </p>

            @foreach($shipment->files as $shipmentFile)
                <a href="{{route('shipment.files.show',['shipmentFile' => $shipmentFile->id])}}">
                    {{$shipmentFile->file_name}}
                </a>
            @endforeach

        </div>
    </div>
</div>

@endsection
