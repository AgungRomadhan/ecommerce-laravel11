@extends('layouts.admin')
@section('content')
<h1>Flash Sale</h1>
<a href="{{ route('admin.flash-sale.create') }}" class="btn btn-primary">Add Flash Sale</a>
<table class="table">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Original Price</th>
            <th>Discount Price</th>
            <th>Start Time</th>
            <th>End Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($flashSales as $sale)
        <tr>
            <td>{{ $sale->product_name }}</td>
            <td>{{ $sale->original_price }}</td>
            <td>{{ $sale->discount_price }}</td>
            <td>{{ $sale->start_time }}</td>
            <td>{{ $sale->end_time }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
