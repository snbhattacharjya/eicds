@extends('layouts.app')

@section('content')
<div class="container-fluid">


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.message')
          <div class="page-header">
            <h1>Create New Pregnancy Delivery Record</h1>
          </div>
          <div class="panel panel-primary">
              <div class="panel-heading">Enter Pregnancy Delivery Details</div>

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
                <form class="form-horizontal" method="POST" action="{{ route('pregnancydelivery.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="member_id" name="member_id" value="{{$member->id}}">

                    <div class="form-group{{ $errors->has('pregnancy_order') ? ' has-error' : '' }}">
                        <label for="pregnancy_order" class="col-md-4 control-label">Pregnancy Order</label>

                        <div class="col-md-6">
                            <input type="text" id="pregnancy_order" type="text" class="form-control" name="pregnancy_order" value="{{old('pregnancy_order')}}" required autofocus>
                            @if ($errors->has('pregnancy_order'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pregnancy_order') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('anganwadi_registration_date') ? ' has-error' : '' }}">
                        <label for="anganwadi_registration_date" class="col-md-4 control-label">Registration Date</label>

                        <div class="col-md-6">
                            <input type="text" id="anganwadi_registration_date" type="text" class="form-control" name="anganwadi_registration_date" value="{{old('anganwadi_registration_date')}}" required>
                            @if ($errors->has('anganwadi_registration_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('anganwadi_registration_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('lmp_date') ? ' has-error' : '' }}">
                        <label for="lmp_date" class="col-md-4 control-label">LMP Date</label>

                        <div class="col-md-6">
                            <input type="text" id="lmp_date" type="text" class="form-control" name="lmp_date" value="{{old('lmp_date')}}" required>
                            @if ($errors->has('lmp_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lmp_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('edd_date') ? ' has-error' : '' }}">
                        <label for="edd_date" class="col-md-4 control-label">Expected Date of Delivery</label>

                        <div class="col-md-6">
                            <input type="text" id="edd_date" type="text" class="form-control" name="edd_date" value="{{old('edd_date')}}" required>
                            @if ($errors->has('edd_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('edd_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('delivery_date') ? ' has-error' : '' }}">
                        <label for="delivery_date" class="col-md-4 control-label">Delivery Date</label>

                        <div class="col-md-6">
                            <input type="text" id="delivery_date" type="text" class="form-control" name="delivery_date" value="{{old('delivery_date')}}">
                            @if ($errors->has('delivery_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('delivery_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('anganwadi_reported_date') ? ' has-error' : '' }}">
                        <label for="anganwadi_reported_date" class="col-md-4 control-label">Reported Date</label>

                        <div class="col-md-6">
                            <input type="text" id="anganwadi_reported_date" type="text" class="form-control" name="anganwadi_reported_date" value="{{old('anganwadi_reported_date')}}">
                            @if ($errors->has('anganwadi_reported_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('anganwadi_reported_date') }}</strong>
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
