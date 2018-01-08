@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @include('layouts.message')
          <div class="page-header">
            <h1>Register No. 10 - Children Weight Records  <small></small></h1>
          </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">Beneficiary Record <a href="{{route('weightrecord.index')}}" class="pull-right"><i class="fa fa-arrow-left"></i> Back</a></div>
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
              <div class="panel-heading">Weight Records<a href="{{route('weightrecord.create',['member' => $member->id])}}" class="pull-right"><i class="fa fa-plus-circle"></i> New</a></div>
              <div class="panel-body">
                <table class="table table-bordered">
                  <thead>
                    <tr class="bg-primary">
                      <th>#</th>
                      <th>Reported Date</th>
                      <th>Age</th>
                      <th>Weight</th>
                      <th>Change</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($wt_records as $wt_record)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$wt_record->reported_date}}</td>
                        <td>{{$wt_record->age}}</td>
                        <td>{{$wt_record->weight}}</td>
                        <td>{{$wt_record->weight_change}}</td>
                        <td>{{$wt_record->weight_status}}</td>
                        <td>
                          <a href="#"><i class="fa fa-edit text-success"></i></a></li>
                          <a href="{{ route('weightrecord.destroy',['id' => $wt_record->id]) }}"
                              onclick="event.preventDefault();
                                       document.getElementById('delete-form-{{$wt_record->id}}').submit();">
                              <i class="fa fa-trash text-danger"></i>
                          </a>

                          <form id="delete-form-{{$wt_record->id}}" action="{{ route('pregnancydelivery.destroy',['id' => $wt_record->id]) }}" method="POST" style="display: none;">
                              {{ csrf_field() }} {{method_field('DELETE')}}
                          </form>
                        </td>
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
