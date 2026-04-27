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

                        <a href="{{route('shipments.show',['shipment' => $shipment->id])}}" class="btn btn-primary">
                            Show Shipment
                        </a>

                        <form action="{{route('shipment.assign.user', ['shipment' => $shipment->id])}}" 
                        method="post">
                            @csrf
                            <input type="hidden" value="{{$shipment->id}}" name="shipment_id">
                            <select name="user_id" class="form-select" aria-label="Default select example">
                            <option selected disabled>Open this select menu</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                            </select>
                            <button type='submit' class="btn btn-primary">Assign User</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No shipments available.</p>
        @endforelse
    </div>
</div>

@livewire('shipments-assigned-list')

@endsection