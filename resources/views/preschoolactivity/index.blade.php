@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-danger">
              <div class="panel-heading">New Preschool Activity </div>
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('preschoolactivity.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('activity_name') ? ' has-error' : '' }}">
                        <label for="activity_name" class="col-md-3 control-label">Acivity Name</label>

                        <div class="col-md-6">
                            <input id="activity_name" type="text" class="form-control" name="activity_name" value="{{ old('activity_name') }}" required autofocus>

                            @if ($errors->has('activity_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('activity_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
              </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-success">
            <div class="panel-heading">Preschool Activities</div>
            <div class="panel-body">
              <table class="table table-bordered table-condensed table-striped">
                <thead>
                  <tr class="bg-primary">
                    <th>#</th>
                    <th>Activity ID</th>
                    <th>Activity Name</th>
                    <th>Supported By</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($activities as $activity)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$activity['id']}}</td>
                      <td>{{$activity['activity_name']}}</td>
                      <td>
                        @if ($activity['type'] == 'Central')
                          {{$activity['type']}}
                        @else
                          {{$activity['type']}} ({{$activity['supported_by']}})
                        @endif
                      </td>
                      <td><a href="#" class="btn btn-sm btn-info">select</a.</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
