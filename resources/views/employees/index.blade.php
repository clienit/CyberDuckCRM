@extends('layouts.master')
 
@section('content')

<div class="card">
  <div class="card-header">
      <h3 class="card-title">{{ __('Employees') }}</h3>
      <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 178px;">
            <a class="btn btn-success" href="{{ route('employees.create') }}"> {{ __('Create New Employee') }}</a>
          </div>
      </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table class="table table-bordered">
      <thead>                  
        <tr>
          <th style="width: 10px">#</th>
          <th>{{ __('First Name') }}</th>
          <th>{{ __('Last Name') }}</th>
          <th>{{ __('Company') }}</th>
          <th>{{ __('Email') }}</th>
          <th>{{ __('Phone') }}</th>
          <th style="width: 280px">{{ __('Actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($employees as $employee)
        <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $employee->first_name }}</td>
          <td>{{ $employee->last_name }}</td>
          <td>{{ $employee->company->name ?? '' }}</td>
          <td>{{ $employee->email }}</td>
          <td>{{ $employee->phone }}</td>
          <td>
            <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">
                <a class="btn btn-success" href="{{ route('employees.show',$employee->id) }}">{{ __('Show') }}</a>
                <a class="btn btn-primary" href="{{ route('employees.edit',$employee->id) }}">{{ __('Edit') }}</a>
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
    {!! $employees->links() !!}
  </div>
</div>
<!-- /.card -->

@endsection