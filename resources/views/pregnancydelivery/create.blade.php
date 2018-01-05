@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="#">Home</a></li>
      <li role="presentation"><a href="#">Profile</a></li>
      <li role="presentation"><a href="#">Messages</a></li>
    </ul>
    <div class="row">
        <div class="col-md-4">
          <div class="panel panel-success">
              <div class="panel-heading">New Preschool Education Record</div>

              <div class="panel-body">
                <dl class="dl-horizontal well">
                  <dt>Member:</dt>
                  <dd>{{$member->name}}</dd>
                  <dt>Gender:</dt>
                  <dd>{{$member->gender}}</dd>
                  <dt>Beneficiary Type:</dt>
                  <dd>{{$member->target->target_name}}</dd>
                  <dt>Age:</dt>
                  <dd>
                    @if (date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y > 0)
                      {{date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y.' yr'}}
                    @else
                      {{date_diff(date_create($member->dob), date_create(date("Y-m-d")))->m.' mon'}}
                    @endif
                  </dd>
                  <dt>Residence under AWC:</dt>
                  <dd>
                    @if ($member->anganwadi_resident)
                      {{'Permanant'}}
                    @else
                      {{'Temporary'}}
                    @endif
                  </dd>
                </dl>
                <form class="form-horizontal" method="POST" action="{{ route('preschooleducation.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="member_id" name="member_id" value="{{$member->id}}">

                    <div class="form-group{{ $errors->has('attendance_date') ? ' has-error' : '' }}">
                        <label for="attendance_date" class="col-md-4 control-label">Preschool Education Date</label>

                        <div class="col-md-6">
                            <select id="attendance_date" type="text" class="form-control" name="attendance_date" required autofocus>
                              @foreach ($preschool_dates as $preschool_date)
                                <option value="{{date_format(date_create_from_format('Y-m-d',$preschool_date->preschool_date),'d/m/Y')}}">{{date_format(date_create_from_format('Y-m-d',$preschool_date->preschool_date),'d/m/Y')}}</option>
                              @endforeach
                            </select>

                            @if ($errors->has('attendance_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('attendance_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
              </div>
            </div>
        </div>

        <div class="col-md-4">
          <div class="panel panel-warning">
              <div class="panel-heading">New Preschool Day </div>
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('activitypreschool.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="member_id" name="member_id" value="{{$member->id}}">
                    <div class="form-group{{ $errors->has('preschool_date') ? ' has-error' : '' }}">
                        <label for="preschool_date" class="col-md-4 control-label">Preschool Education Date</label>

                        <div class="col-md-6">
                            <input id="preschool_date" type="text" class="form-control" name="preschool_date" value="{{ old('preschool_date') }}" required autofocus>

                            @if ($errors->has('preschool_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('preschool_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('activity_name') ? ' has-error' : '' }}">
                        <label for="activity_name" class="col-md-4 control-label">Select Acivity</label>

                        <div class="col-md-6">
                            <select id="activity_id" type="text" class="form-control" name="activity_id" required>
                              @foreach ($activities as $activity)
                                <option value="{{$activity->id}}">{{$activity->activity_name}}</option>
                              @endforeach
                            </select>

                            @if ($errors->has('activity_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('activity_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
              </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="panel panel-danger">
              <div class="panel-heading">New Preschool Activity </div>
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('preschoolactivity.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="member_id" name="member_id" value="{{$member->id}}">
                    <div class="form-group{{ $errors->has('activity_name') ? ' has-error' : '' }}">
                        <label for="activity_name" class="col-md-4 control-label">Acivity Name</label>

                        <div class="col-md-6">
                            <input id="activity_name" type="text" class="form-control" name="activity_name" value="{{ old('activity_name') }}" required autofocus>

                            @if ($errors->has('activity_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('activity_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
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
</div>
@endsection
