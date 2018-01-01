@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default">
              <div class="panel-heading">New Supplementary Food Distribution</div>

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
                <form class="form-horizontal" method="POST" action="{{ route('fooddistribution.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="member_id" name="member_id" value="{{$member->id}}">
                    <div class="form-group{{ $errors->has('food_type') ? ' has-error' : '' }}">
                        <label for="food_type" class="col-md-4 control-label">Food Type</label>

                        <div class="col-md-6">
                            <select id="food_type" class="form-control" name="food_type" value="{{ old('food_type') }}" required autofocus>
                              <option value="">--Select--</option>
                              @foreach ($food_types as $food_type)
                                <option value="{{$food_type->id}}">{{$food_type->type_name}}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('food_type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('food_type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('ration_given_quantity') ? ' has-error' : '' }}">
                        <label for="ration_given_quantity" class="col-md-4 control-label">Quantity</label>

                        <div class="col-md-6">
                            <select id="ration_given_quantity" class="form-control" name="ration_given_quantity" required>
                              <option value="">--Select--</option>
                              <option value="N">Normal</option>
                              <option value="L">Large</option>
                            </select>
                            @if ($errors->has('ration_given_quantity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ration_given_quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('ration_given_date') ? ' has-error' : '' }}">
                        <label for="ration_given_date" class="col-md-4 control-label">Service Date</label>

                        <div class="col-md-6">
                            <input id="ration_given_date" type="text" class="form-control" name="ration_given_date" value="{{ old('ration_given_date') }}" required>

                            @if ($errors->has('ration_given_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ration_given_date') }}</strong>
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
