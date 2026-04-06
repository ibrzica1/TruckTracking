@extends("layout")

@section("pageTitle")
    Main page
@endsection

@section("content")

<div class="container mt-4">
    <h1 class="mb-4">Shipments</h1>

    <div class="row">
        @forelse($shipments as $shipment)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{$shipment->title}}
                        </h5>

                        <p class="card-text">
                            <strong>Price:</strong> €{{$shipment->price}}
                        </p>

                        <p class="text-muted small">
                            {{$shipment->from_city}} → {{$shipment->to_city}}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <p>No shipments available.</p>
        @endforelse
    </div>
</div>

@endsection