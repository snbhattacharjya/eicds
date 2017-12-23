@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="page-header">
            <h1>Icds Projects <small></small></h1>
          </div>
          <form class="form-inline" method="POST" action="{{ route('icdsproject.store') }}">
              {{ csrf_field() }}

            <div class="form-group{{ $errors->has('district_id') ? ' has-error' : '' }}">
              <label for="district_id" class="control-label">District: </label>
              <select class="form-control" id="district_id" name="district_id" required autofocus>
                <option value="">--Select District--</option>
                @foreach ($districts as $district)
                  <option value="{{$district->id}}">{{$district->state->state_name}} - {{$district->district_name}}</option>
                @endforeach
              </select>
              @if ($errors->has('district_id'))
                  <span class="help-block">
                      <strong>{{ $errors->first('district_id') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('project_code') ? ' has-error' : '' }}">
              <label for="project_code" class="control-label">Project Code: </label>
              <input type="text" class="form-control" id="project_code" name="project_code" placeholder="Project Code" value="{{ old('project_code') }}" required autofocus>
              @if ($errors->has('project_code'))
                  <span class="help-block">
                      <strong>{{ $errors->first('project_code') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('project_name') ? ' has-error' : '' }}">
              <label for="project_name" class="control-label">Project Name: </label>
              <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Project Name" value="{{ old('project_name') }}" required autofocus>
              @if ($errors->has('project_name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('project_name') }}</strong>
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
                <th>District</th>
                <th>Project Code</th>
                <th>Project Name</th>
                <th>Modify</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($projects as $project)
                <tr>
                  <td>{{$project->id}}</td>
                  <td>{{$project->district->state->state_name}}</td>
                  <td>{{$project->district->district_name}}</td>
                  <td>{{$project->project_code}}</td>
                  <td>{{$project->project_name}}</td>
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
