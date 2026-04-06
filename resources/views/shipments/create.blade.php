@extends("layout")

@section("pageTitle")
    Create Shipment
@endsection

@section("content")

<div class="container mt-4">
    <h1 class="mb-4">Create Shipment</h1>

    <form action="{{ route('shipments.store') }}" method="POST">
        @if($errors->any())
            <p>Error: {{$errors->first()}}</p>
        @endif
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Price (€)</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">From City</label>
                <input type="text" name="from_city" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">From Country</label>
                <input type="text" name="from_country" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">To City</label>
                <input type="text" name="to_city" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">To Country</label>
                <input type="text" name="to_country" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">User ID</label>
                <input type="number" name="user_id" class="form-control" required>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Details</label>
                <textarea name="details" class="form-control" rows="4"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Create Shipment
        </button>
    </form>
</div>
@endsection