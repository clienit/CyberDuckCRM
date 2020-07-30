@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ __('Company Details') }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="callout callout-info">
            <h5>{{ __('Name:') }}</h5>
            {{ $company->name }}
        </div>
        <div class="callout callout-info">
            <h5>{{ __('Email:') }}</h5>
            {{ $company->email }}
        </div>
        <div class="callout callout-info">
            <h5>{{ __('Logo:') }}</h5>
            <ul class="users-list clearfix">
                <li>
                    <img src="{{ asset('storage/'.$company->logo) }}">
                </li>
            </ul>
        </div>
        <div class="callout callout-info">
            <h5>{{ __('Website:') }}</h5>
            {{ $company->website }}
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <a class="btn btn-danger float-right" href="{{ route('companies.index') }}">Back</a>
    </div>
    <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->

@endsection
