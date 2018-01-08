@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @include('layouts.message')
          <div class="page-header">
            <h1>Register No. 5 - Pregnancy and Delivery Records  <small>(New Born Details)</small></h1>
          </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">Beneficiary Record <a href="{{route('pregnancydelivery.show',['member' => $member->id])}}" class="pull-right"><i class="fa fa-arrow-left"></i> Back</a></div>
            <div class="panel-body">
              <div class="col-md-6">
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
              </div>
              <div class="col-md-6">
                <dl class="dl-horizontal well">
                  <dt>Pregnancy Order:</dt>
                  <dd>{{$pd_record->pregnancy_order}}</dd>
                  <dt>LMP Date:</dt>
                  <dd>{{$pd_record->lmp_date}}</dd>
                  <dt>Expected Delivery Date:</dt>
                  <dd>{{$pd_record->edd_date}}</dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">New Born Details</div>
                <div class="panel-body">
                  @foreach ($pd_record->newBorns as $new_born)
                    <dl class="dl-horizontal well">
                      <dt>Name of Child:</dt>
                      <dd>{{$new_born->member->name}}</dd>
                      <dt>Mode of Delivery:</dt>
                      <dd>{{$new_born->mode_of_delivery}}</dd>
                      <dt>Delivery Location Type:</dt>
                      <dd>{{$new_born->delivery_location_type}}</dd>
                      <dt>Delivery Location Name:</dt>
                      <dd>{{$new_born->delivery_location_name}}</dd>
                      <dt>Village/Town Name:</dt>
                      <dd>{{$new_born->village_town_name}}</dd>
                      <dt>Attending Doctor:</dt>
                      <dd>{{$new_born->doctor_name}}</dd>
                      <dt>Pediatrician:</dt>
                      <dd>{{$new_born->pediatrician_name}}</dd>
                      <dt>Birth Status:</dt>
                      <dd>{{$new_born->birth_status}}</dd>
                      <dt>Birth Date and Time:</dt>
                      <dd>{{$new_born->birth_date_time}}</dd>
                      <dt>Gender:</dt>
                      <dd>{{$new_born->gender}}</dd>
                      <dt>First Weight:</dt>
                      <dd>{{$new_born->first_weight}}</dd>
                      <dt>First Weight:</dt>
                      <dd>{{$new_born->first_weight_date}}</dd>
                    </dl>
                  @endforeach

                </div>
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-danger">
              <div class="panel-heading">Add New Born Detail</div>
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('newborn.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="pregnancy_id" name="pregnancy_id" value="{{$pd_record->id}}">

                    <div class="form-group{{ $errors->has('child_name') ? ' has-error' : '' }}">
                        <label for="child_name" class="col-md-4 control-label">Name of Child</label>

                        <div class="col-md-6">
                            <input type="text" id="child_name" type="text" class="form-control" name="child_name" value="{{old('child_name')}}" required autofocus>
                            @if ($errors->has('child_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('child_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('mode_of_delivery') ? ' has-error' : '' }}">
                        <label for="mode_of_delivery" class="col-md-4 control-label">Mode of Delivery</label>

                        <div class="col-md-6">
                            <select id="mode_of_delivery" class="form-control" name="mode_of_delivery" required>
                              <option value="">--Select--</option>
                              <option value="Normal">Normal</option>
                              <option value="Caeserean">Caeserean</option>
                            </select>
                            @if ($errors->has('mode_of_delivery'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mode_of_delivery') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('delivery_location_type') ? ' has-error' : '' }}">
                        <label for="delivery_location_type" class="col-md-4 control-label">Delivery Location Type</label>

                        <div class="col-md-6">
                            <select id="delivery_location_type" class="form-control" name="delivery_location_type" required>
                              <option value="">--Select--</option>
                              <option value="Institution">Institution</option>
                              <option value="Home">Home</option>
                            </select>
                            @if ($errors->has('delivery_location_type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('delivery_location_type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('delivery_location_name') ? ' has-error' : '' }}">
                        <label for="delivery_location_name" class="col-md-4 control-label">Delivery Location Name</label>

                        <div class="col-md-6">
                            <input type="text" id="delivery_location_name" class="form-control" name="delivery_location_name" value="{{old('delivery_location_name')}}">
                            @if ($errors->has('delivery_location_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('delivery_location_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('village_town_name') ? ' has-error' : '' }}">
                        <label for="village_town_name" class="col-md-4 control-label">Village/Town Name</label>

                        <div class="col-md-6">
                            <input type="text" id="village_town_name" class="form-control" name="village_town_name" value="{{old('village_town_name')}}" required>
                            @if ($errors->has('village_town_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('village_town_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('doctor_name') ? ' has-error' : '' }}">
                        <label for="doctor_name" class="col-md-4 control-label">Attending Doctor Name</label>

                        <div class="col-md-6">
                            <input type="text" id="doctor_name" class="form-control" name="doctor_name" value="{{old('doctor_name')}}" required>
                            @if ($errors->has('doctor_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('doctor_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('pediatrician_name') ? ' has-error' : '' }}">
                        <label for="pediatrician_name" class="col-md-4 control-label">Pediatrician Name</label>

                        <div class="col-md-6">
                            <input type="text" id="pediatrician_name" class="form-control" name="pediatrician_name" value="{{old('pediatrician_name')}}" required>
                            @if ($errors->has('pediatrician_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pediatrician_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('birth_status') ? ' has-error' : '' }}">
                        <label for="birth_status" class="col-md-4 control-label">Birth Status</label>

                        <div class="col-md-6">
                            <select id="birth_status" class="form-control" name="birth_status" required>
                              <option value="">--Select--</option>
                              <option value="Live">Live</option>
                              <option value="Dead">Dead</option>
                            </select>
                            @if ($errors->has('birth_status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birth_status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('birth_date_time') ? ' has-error' : '' }}">
                        <label for="birth_date_time" class="col-md-4 control-label">Birth Date and Time</label>

                        <div class="col-md-6">
                            <input type="text" id="birth_date_time" class="form-control" name="birth_date_time" value="{{old('birth_date_time')}}" required>
                            @if ($errors->has('birth_date_time'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birth_date_time') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                        <label for="gender" class="col-md-4 control-label">Gender</label>

                        <div class="col-md-6">
                            <select id="gender" class="form-control" name="gender" required>
                              <option value="">--Select--</option>
                              <option value="M">Male</option>
                              <option value="F">Female</option>
                            </select>
                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('first_weight') ? ' has-error' : '' }}">
                        <label for="first_weight" class="col-md-4 control-label">First Weight</label>

                        <div class="col-md-6">
                            <input type="text" id="first_weight" class="form-control" name="first_weight" value="{{old('first_weight')}}" required>
                            @if ($errors->has('first_weight'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_weight') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('first_weight_date') ? ' has-error' : '' }}">
                        <label for="first_weight_date" class="col-md-4 control-label">First Weight Date</label>

                        <div class="col-md-6">
                            <input type="text" id="first_weight_date" class="form-control" name="first_weight_date" value="{{old('first_weight_date')}}" required>
                            @if ($errors->has('first_weight_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_weight_date') }}</strong>
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
