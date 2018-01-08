@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @include('layouts.message')
          <div class="page-header">
            <h1>Register No. 5 - Pregnancy and Delivery Records  <small>(Medical Procedures)</small></h1>
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
                        <th>Procedure Name</th>
                        <th>Procedure Date</th>
                        <th>Remarks</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($pd_record->medicalProcedures as $medical_procedure)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$medical_procedure->procedure->procedure_name}}</td>
                          <td>{{$medical_procedure->procedure_date}}</td>
                          <td>{{$medical_procedure->remarks}}</td>
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
              <div class="panel-heading">New Pregnancy Medical Procedure</div>
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('pregnancymedicalprocedure.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="pregnancy_id" name="pregnancy_id" value="{{$pd_record->id}}">

                    <div class="form-group{{ $errors->has('procedure_id') ? ' has-error' : '' }}">
                        <label for="procedure_id" class="col-md-4 control-label">Procedure Name</label>

                        <div class="col-md-6">
                            <select type="text" id="procedure_id" type="text" class="form-control" name="procedure_id" required autofocus>
                              <option value="">--Select--</option>
                              @foreach ($procedures as $procedure)
                                <option value="{{$procedure->id}}">{{$procedure->procedure_name}}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('procedure_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('procedure_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('procedure_date') ? ' has-error' : '' }}">
                        <label for="procedure_date" class="col-md-4 control-label">Procedure Date</label>

                        <div class="col-md-6">
                            <input type="text" id="procedure_date" type="text" class="form-control" name="procedure_date" value="{{old('procedure_date')}}" required>
                            @if ($errors->has('procedure_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('procedure_date') }}</strong>
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
