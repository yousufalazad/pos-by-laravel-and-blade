@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Content Row -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('create customer') }}</h1>
                    <a href="{{ route('admin.customers.index') }}"
                        class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.customers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">{{ __('name') }}</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') }}" />
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('email') }}</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" />
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('phone') }}</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ old('phone') }}" />
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('address') }}</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address') }}" />
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('start date') }}</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ old('start_date') }}" />
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('profile image') }}</label>
                        <input type="file" class="form-control" id="profile_img" name="profile_img"
                            value="{{ old('profile_img') }}" />
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
                </form>
            </div>
        </div>


        <!-- Content Row -->

    </div>
@endsection
