@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-12">
          <div class="page-header">
            <h1>Icds Project Sectors <small></small></h1>
          </div>
          <form class="form-inline" method="POST" action="{{ route('anganwadicentre.store') }}">
              {{ csrf_field() }}

            <div class="form-group{{ $errors->has('sector_id') ? ' has-error' : '' }}">
              <label for="sector_id" class="control-label">Project/Sector: </label>
              <select class="form-control" id="sector_id" name="sector_id" required autofocus>
                <option value="">--Select Sector--</option>
                @foreach ($sectors as $sector)
                  <option value="{{$sector->id}}">{{$sector->project->project_name}}/{{$sector->sector_name}}</option>
                @endforeach
              </select>
              @if ($errors->has('sector_id'))
                  <span class="help-block">
                      <strong>{{ $errors->first('sector_id') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('centre_code') ? ' has-error' : '' }}">
              <label for="centre_code" class="control-label">Centre Code: </label>
              <input type="text" class="form-control" id="centre_code" name="centre_code" placeholder="Centre Code" value="{{ old('centre_code') }}" required autofocus>

              @if ($errors->has('centre_code'))
                  <span class="help-block">
                      <strong>{{ $errors->first('centre_code') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('centre_name') ? ' has-error' : '' }}">
              <label for="sector_name" class="control-label">Centre Name: </label>
              <input type="text" class="form-control" id="sector_name" name="centre_name" placeholder="Centre Name" value="{{ old('centre_name') }}" required autofocus>

              @if ($errors->has('centre_name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('centre_name') }}</strong>
                  </span>
              @endif
            </div>

            <button type="submit" class="btn btn-success">Add New</button>
          </form>
        </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <p>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>State</th>
                <th>District</th>
                <th>Project</th>
                <th>Sector</th>
                <th>Centre Code</th>
                <th>Centre Name</th>
                <th>Modify</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($centres as $centre)
                <tr>
                  <td>{{$centre->id}}</td>
                  <td>{{$centre->sector->project->district->state->state_name}}</td>
                  <td>{{$centre->sector->project->district->district_name}}</td>
                  <td>{{$centre->sector->project->project_name}}</td>
                  <td>{{$centre->sector->sector_name}}</td>
                  <td>{{$centre->centre_code}}</td>
                  <td>{{$centre->centre_name}}</td>
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
