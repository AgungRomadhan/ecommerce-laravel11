@extends('layouts.admin')
@section('content')
<h1>Add Flash Sale</h1>
<form action="{{ route('admin.flash-sale.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Product Name</label>
        <input type="text" name="product_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Original Price</label>
        <input type="number" name="original_price" class="form-control" required step="0.01">
    </div>
    <div class="form-group">
        <label>Discount Price</label>
        <input type="number" name="discount_price" class="form-control" required step="0.01">
    </div>
    <div class="form-group">
        <label>Start Time</label>
        <input type="datetime-local" name="start_time" class="form-control" required>
    </div>
    <div class="form-group">
        <label>End Time</label>
        <input type="datetime-local" name="end_time" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Product Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
