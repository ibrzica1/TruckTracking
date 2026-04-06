@extends("layout")
@section("pageTitle")
    Main page
@endsection

@section("content")
    
    @foreach($shipments as $shipment)
        <p>{{$shipment->title}}</p>
    @endforeach

@endsection