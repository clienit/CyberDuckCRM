@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ __('Employee Details') }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="callout callout-info">
            <h5>{{ __('First Name:') }}</h5>
            {{ $employee->first_name }}
        </div>
        <div class="callout callout-info">
            <h5>{{ __('Last Name:') }}</h5>
            {{ $employee->last_name }}
        </div>
        <div class="callout callout-info">
            <h5>{{ __('Company:') }}</h5>
            {{ $employee->company->name ?? '' }}
        </div>
        <div class="callout callout-info">
            <h5>{{ __('Email:') }}</h5>
            {{ $employee->email }}
        </div>
        <div class="callout callout-info">
            <h5>{{ __('Phone:') }}</h5>
            {{ $employee->phone }}
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <a class="btn btn-danger float-right" href="{{ route('employees.index') }}">Back</a>
    </div>
    <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->

@endsection
