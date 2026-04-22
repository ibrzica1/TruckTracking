@extends("layout")

@section("pageTitle")
    Edit Shipment
@endsection

@section("content")
    @php
        use App\Models\Shipment;
    @endphp

    <div class="container mt-4">
    <h1 class="mb-4">Create Shipment</h1>

    <form action="{{ route('shipments.update', ['shipment' => $shipment->id]) }}" method="POST" enctype="multipart/form-data">
        @if($errors->any())
            <p>Error: {{$errors->first()}}</p>
        @endif
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required value="{{$shipment->title}}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Price (€)</label>
                <input type="number" step="0.01" name="price" class="form-control" required value="{{$shipment->price}}">
            </div>

            <div class="col-md-6 mb-3">
                @if($errors->has('user_id'))
                    <p>{{$errors->first()}}</p>
                @endif
                <label class="form-label">Driver ID</label>
                <input type="number" name="user_id" class="form-control" required value="{{$shipment->user_id}}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">From City</label>
                <input type="text" name="from_city" class="form-control" required value="{{$shipment->from_city}}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">From Country</label>
                <input type="text" name="from_country" class="form-control" required value="{{$shipment->from_country}}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">To City</label>
                <input type="text" name="to_city" class="form-control" required value="{{$shipment->to_city}}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">To Country</label>
                <input type="text" name="to_country" class="form-control" required value="{{$shipment->to_country}}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    @foreach(Shipment::ALLOWED_STATUSES as $status)
                        <option value="{{$status}}" {{$shipment->status === $status ? 'selected' : ''}}>
                            {{$status}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="documents">Documents</label>
                <input type="file" name="documents[]" class="form-control">
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Details</label>
                <textarea name="details" class="form-control" rows="4">{{$shipment->details}}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Update Shipment
        </button>
    </form>
</div>

@endsection