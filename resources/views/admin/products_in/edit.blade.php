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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Edit Product In')}}</h1>
                    <a href="{{ route('admin.products_in.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.products_in.update', $stock->id) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="name">{{ __('Select Supplier') }}</label>
                        <select class="form-control " id="supplier_id" name="supplier_id">
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
                        <input type="number" class="form-control" id="in_quantity" name="in_quantity" value="{{ old('in_quantity', $stock->in_quantity) }}" />
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Per Unit Price') }}</label>
                        <input type="number" class="form-control" id="in_unit_price" name="in_unit_price" value="{{ old('in_unit_price', $stock->in_unit_price) }}" />
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Date') }}</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $stock->date) }}" />
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection