@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ __('Employee Create') }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- Horizontal Form -->
    <!-- form start -->
    <form class="form-horizontal" action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="card-body">
            <div class="form-group row">
                <label for="first_name" class="col-sm-2 col-form-label">{{ __('First Name') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-2 col-form-label">{{ __('Last Name') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="company_id" class="col-sm-2 col-form-label">{{ __('Company') }}</label>
                <div class="col-sm-10">
                    <select class="form-control" name="company_id" name="company_id">
                        <option value="">{{ __('Please Select') }}</option>
                        @foreach (App\Model\Company::all() as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">{{ __('Phone') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                </div>
            </div>                  
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Create</button>
            <a class="btn btn-danger float-right" href="{{ route('employees.index') }}">Cancel</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->

@endsection