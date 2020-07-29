@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ __('Company Create') }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- Horizontal Form -->
    <!-- form start -->
    <form class="form-horizontal" action="{{ route('companies.store') }}" method="POST">
        @csrf

        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="form-group row">
                <label for="website" class="col-sm-2 col-form-label">{{ __('Website') }}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="website" name="website" placeholder="Website">
                </div>
            </div>                  
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Create</button>
            <a class="btn btn-danger float-right" href="{{ route('companies.index') }}">Cancel</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->

@endsection