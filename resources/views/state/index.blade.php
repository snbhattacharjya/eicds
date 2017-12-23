@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="page-header">
            <h1>States <small></small></h1>
          </div>
          <form class="form-inline" method="POST" action="{{ route('state.store') }}">
              {{ csrf_field() }}
            <div class="form-group{{ $errors->has('state_code') ? ' has-error' : '' }}">
              <label for="state_code" class="control-label">State Code: </label>
              <input type="text" class="form-control" id="state_code" name="state_code" placeholder="State Code" value="{{ old('state_code') }}" required autofocus>
              @if ($errors->has('state_code'))
                  <span class="help-block">
                      <strong>{{ $errors->first('state_code') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('state_name') ? ' has-error' : '' }}">
              <label for="state_name" class="control-label">State Name: </label>
              <input type="text" class="form-control" id="state_name" name="state_name" placeholder="State Name" value="{{ old('state_name') }}" required autofocus>
              @if ($errors->has('state_name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('state_name') }}</strong>
                  </span>
              @endif
            </div>

            <button type="submit" class="btn btn-success">Add New</button>
          </form>
        </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <p>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>State Code</th>
                <th>State Name</th>
                <th>Modify</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($states as $state)
                <tr>
                  <td>{{$state->id}}</td>
                  <td>{{$state->state_code}}</td>
                  <td>{{$state->state_name}}</td>
                  <td>Edit</td>
                </tr>
              @endforeach
            </tbody>
          </table
        </p>
      </div>
    </div>
</div>
@endsection
