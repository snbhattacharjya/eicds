@extends('layouts.app')

@section('content')
<div class="container-fluid">


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.message')
          <div class="page-header">
            <h1>Create New Weight Record</h1>
          </div>
          <div class="panel panel-primary">
              <div class="panel-heading">Enter Weight Details</div>

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
                <form class="form-horizontal" method="POST" action="{{ route('weightrecord.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="member_id" name="member_id" value="{{$member->id}}">

                    <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                        <label for="weight" class="col-md-4 control-label">Weight</label>

                        <div class="col-md-6">
                            <input type="text" id="weight" type="text" class="form-control" name="weight" value="{{old('weight')}}" required autofocus>
                            @if ($errors->has('weight'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('weight') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('weight_change') ? ' has-error' : '' }}">
                        <label for="weight_change" class="col-md-4 control-label">Weight Change</label>

                        <div class="col-md-6">
                            <input type="text" id="weight_change" type="text" class="form-control" name="weight_change" value="{{old('weight_change')}}" required>
                            @if ($errors->has('weight_change'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('weight_change') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('weight_status') ? ' has-error' : '' }}">
                        <label for="weight_status" class="col-md-4 control-label">Weight Status</label>

                        <div class="col-md-6">
                            <select id="weight_status" class="form-control" name="weight_status" required>
                              <option value="">--Select--</option>
                              <option value="Normal">Normal</option>
                              <option value="Moderately Underweight">Moderately Underweight</option>
                              <option value="Severely Underweight">Severely Underweight</option>
                            </select>
                            @if ($errors->has('weight_status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('weight_status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('reported_date') ? ' has-error' : '' }}">
                        <label for="reported_date" class="col-md-4 control-label">Reported Date</label>

                        <div class="col-md-6">
                            <input type="text" id="reported_date" type="text" class="form-control" name="reported_date" value="{{old('reported_date')}}" required>
                            @if ($errors->has('reported_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('reported_date') }}</strong>
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
@endsection
