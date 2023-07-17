@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Product Out') }}</h1>
                    <a href="{{ route('admin.products_out.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products_out.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ __('Select Customer') }}</label>
                        <select class="form-control " id="customer_id" name="customer_id">
                            <option value="">Select Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Select Product') }}</label>
                        <select class="form-control " id="product_id" name="product_id">
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">{{ __('Quantity') }}</label>
                        <input type="number" class="form-control" id="out_quantity" name="out_quantity" value="{{ old('out_quantity') }}" />
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Unit Price') }}</label>
                        <input type="number" class="form-control" id="out_unit_price" name="out_unit_price" value="{{ old('out_unit_price') }}" />
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('WS Unit Price') }}</label>
                        <input type="number" class="form-control" id="out_ws_unit_price" name="out_ws_unit_price" value="{{ old('out_ws_unit_price') }}" />
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Date') }}</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" />
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection