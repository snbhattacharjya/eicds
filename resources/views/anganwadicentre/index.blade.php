@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-12">
          <div class="page-header">
            <h1>Icds Project Sectors <small></small></h1>
          </div>
          <form class="form-inline" method="POST" action="{{ route('sector.store') }}">
              {{ csrf_field() }}

            <div class="form-group{{ $errors->has('district_id') ? ' has-error' : '' }}">
              <label for="project_id" class="control-label">Project: </label>
              <select class="form-control" id="project_id" name="project_id" required autofocus>
                <option value="">--Select Project--</option>
                @foreach ($projects as $project)
                  <option value="{{$project->id}}">{{$project->district->state->state_name}}/{{$project->district->district_name}}/{{$project->project_name}}</option>
                @endforeach
              </select>
              @if ($errors->has('project_id'))
                  <span class="help-block">
                      <strong>{{ $errors->first('project_id') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('sector_code') ? ' has-error' : '' }}">
              <label for="sector_code" class="control-label">Sector Code: </label>
              <input type="text" class="form-control" id="sector_code" name="sector_code" placeholder="Sector Code" value="{{ old('sector_code') }}" required autofocus>
              @if ($errors->has('sector_code'))
                  <span class="help-block">
                      <strong>{{ $errors->first('sector_code') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('sector_name') ? ' has-error' : '' }}">
              <label for="sector_name" class="control-label">Sector Name: </label>
              <input type="text" class="form-control" id="sector_name" name="sector_name" placeholder="Sector Name" value="{{ old('sector_name') }}" required autofocus>
              @if ($errors->has('sector_name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('sector_name') }}</strong>
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
              @foreach ($sectors as $sector)
                <tr>
                  <td>{{$sector->id}}</td>
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
