@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="page-header">
            <h1>Register No. 5 - Pregnancy and Delivery Records  <small></small></h1>
          </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">Beneficiary Record <a href="{{route('pregnancydelivery.index')}}" class="pull-right"><i class="fa fa-arrow-left"></i> Back</a></div>
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
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-success">
              <div class="panel-heading">Pregnancy Delivery Records<a href="{{route('pregnancydelivery.create',['member' => $member->id])}}" class="pull-right"><i class="fa fa-plus-circle"></i> New</a></div>
              <div class="panel-body">
                <table class="table table-bordered">
                  <thead>
                    <tr class="bg-primary">
                      <th>#</th>
                      <th>Pregnancy Order</th>
                      <th>LMP Date</th>
                      <th>Expected Delivery Date</th>
                      <th>Delivery Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pd_records as $pd_record)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$pd_record->pregnancy_order}}</td>
                        <td>{{$pd_record->lmp_date}}</td>
                        <td>{{$pd_record->edd_date}}</td>
                        <td>{{$pd_record->delivery_date}}</td>
                        <td>
                            <a href="{{route('pregnancydelivery.show',['member' => $member->id])}}" class="btn btn-warning btn-sm">Select</a>
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
            <div class="panel panel-warning">
                <div class="panel-heading">Medical Procedures<a href="{{route('pregnancydelivery.index')}}" class="pull-right"><i class="fa fa-plus-circle"></i> New</a></div>
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
                      @foreach ($medical_records as $medical_record)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$medical_record->procedure->procedure_name}}</td>
                          <td>{{$medical_record->procedure_date}}</td>
                          <td>{{$medical_record->remarks}}</td>
                          <td>
                              <a href="{{route('pregnancydelivery.show',['member' => $member->id])}}" class="btn btn-warning btn-sm">Select</a>
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
                  <div class="panel-heading">Antenatal Checkups<a href="{{route('pregnancydelivery.index')}}" class="pull-right"><i class="fa fa-plus-circle"></i> New</a></div>
                  <div class="panel-body">

                  </div>
                </div>
              </div>
            </div>
</div>
@endsection
