@extends('layouts.master')
 
@section('content')

<div class="card">
  <div class="card-header">
      <h3 class="card-title">{{ __('Companies') }}</h3>
      <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 178px;">
            <a class="btn btn-success" href="{{ route('companies.create') }}"> {{ __('Create New Company') }}</a>
          </div>
      </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table class="table table-bordered">
      <thead>                  
        <tr>
          <th style="width: 10px">#</th>
          <th>{{ __('Name') }}</th>
          <th>{{ __('Email') }}</th>
          <th>{{ __('Logo') }}</th>
          <th>{{ __('Website') }}</th>
          <th style="width: 280px">{{ __('Actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($companies as $company)
        <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $company->name }}</td>
          <td>{{ $company->email }}</td>
          <td>{{ $company->logo }}</td>
          <td>{{ $company->website }}</td>
          <td>
            <form action="{{ route('companies.destroy',$company->id) }}" method="POST">
                <a class="btn btn-success" href="{{ route('companies.show',$company->id) }}">{{ __('Show') }}</a>
                <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">{{ __('Edit') }}</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
              </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  <div class="card-footer clearfix">
    {!! $companies->links() !!}
  </div>
</div>
<!-- /.card -->

@endsection