@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @include('layouts.message')
          <div class="page-header">
            <h1>Register No. 5 - Pregnancy and Delivery Records  <small>(Ante Natal Checkups)</small></h1>
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
                <div class="panel-heading">Pregnancy Medical Procedures</div>
                <div class="panel-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr class="bg-primary">
                        <th>#</th>
                        <th>Checkup Place</th>
                        <th>Checkup Date</th>
                        <th>Doctor Name</th>
                        <th>Remarks</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($pd_record->anteNatalCheckups as $checkup)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$checkup->checkup_place}}</td>
                          <td>{{$checkup->checkup_date}}</td>
                          <td>{{$checkup->doctor_name}}</td>
                          <td>{{$checkup->remarks}}</td>
                          <td>
                            <a href="#"><i class="fa fa-trash"></i> Remove</a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-danger">
              <div class="panel-heading">New Ante Natal Checkup</div>
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('pregnancyantenatalcheckup.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="pregnancy_id" name="pregnancy_id" value="{{$pd_record->id}}">

                    <div class="form-group{{ $errors->has('checkup_place') ? ' has-error' : '' }}">
                        <label for="checkup_place" class="col-md-4 control-label">Checkup Place</label>

                        <div class="col-md-6">
                            <input type="text" id="checkup_place" type="text" class="form-control" name="checkup_place" value="{{old('checkup_place')}}" required autofocus>
                            @if ($errors->has('checkup_place'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('checkup_place') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('checkup_date') ? ' has-error' : '' }}">
                        <label for="checkup_date" class="col-md-4 control-label">Checkup Date</label>

                        <div class="col-md-6">
                            <input type="text" id="checkup_date" type="text" class="form-control" name="checkup_date" value="{{old('checkup_date')}}" required>
                            @if ($errors->has('checkup_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('checkup_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('doctor_name') ? ' has-error' : '' }}">
                        <label for="doctor_name" class="col-md-4 control-label">Doctor Name</label>

                        <div class="col-md-6">
                            <input type="text" id="doctor_name" type="text" class="form-control" name="doctor_name" value="{{old('doctor_name')}}">
                            @if ($errors->has('doctor_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('doctor_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
                        <label for="remarks" class="col-md-4 control-label">Remarks</label>

                        <div class="col-md-6">
                            <textarea id="remarks" class="form-control" name="remarks" required>{{old('remarks')}}</textarea>
                            @if ($errors->has('remarks'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('remarks') }}</strong>
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
