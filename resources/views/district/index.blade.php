@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="page-header">
            <h1>Districts <small></small></h1>
          </div>
          <form class="form-inline" method="POST" action="{{ route('district.store') }}">
              {{ csrf_field() }}

            <div class="form-group{{ $errors->has('state_id') ? ' has-error' : '' }}">
              <label for="state_id" class="control-label">State: </label>
              <select class="form-control" id="state_id" name="state_id" required autofocus>
                <option value="">--Select State--</option>
                @foreach ($states as $state)
                  <option value="{{$state->id}}">{{$state->state_name}}</option>
                @endforeach
              </select>
              @if ($errors->has('state_id'))
                  <span class="help-block">
                      <strong>{{ $errors->first('state_id') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('district_code') ? ' has-error' : '' }}">
              <label for="district_code" class="control-label">District Code: </label>
              <input type="text" class="form-control" id="district_code" name="district_code" placeholder="District Code" value="{{ old('district_code') }}" required autofocus>
              @if ($errors->has('district_code'))
                  <span class="help-block">
                      <strong>{{ $errors->first('district_code') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('district_name') ? ' has-error' : '' }}">
              <label for="district_name" class="control-label">District Name: </label>
              <input type="text" class="form-control" id="district_name" name="district_name" placeholder="District Name" value="{{ old('district_name') }}" required autofocus>
              @if ($errors->has('districtname'))
                  <span class="help-block">
                      <strong>{{ $errors->first('district_name') }}</strong>
                  </span>
              @endif
            </div>

            <button type="submit" class="btn btn-success">Add New</button>
          </form>
        </div>
    </div>

    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <p>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>State</th>
                <th>District Code</th>
                <th>District Name</th>
                <th>Modify</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($districts as $district)
                <tr>
                  <td>{{$district->id}}</td>
                  <td>{{$district->state->state_name}}</td>
                  <td>{{$district->district_code}}</td>
                  <td>{{$district->district_name}}</td>
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
