@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @include('layouts.message')
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
                          <div class="btn-group">
                            <button type="button" class="btn btn-danger btn-sm">Select Action</button>
                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                              <li><a href="#"><i class="fa fa-edit"></i> Modify</a></li>
                              <li>
                                <a href="{{ route('pregnancydelivery.destroy',['id' => $pd_record->id]) }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('delete-form-{{$pd_record->id}}').submit();">
                                    <i class="fa fa-trash"></i> Delete
                                </a>

                                <form id="delete-form-{{$pd_record->id}}" action="{{ route('pregnancydelivery.destroy',['id' => $pd_record->id]) }}" method="POST" style="display: none;">
                                    {{ csrf_field() }} {{method_field('DELETE')}}
                                </form>
                              </li>
                              <li role="separator" class="divider"></li>
                              <li><a href="{{route('pregnancydelivery.medicalprocedure',['id' => $pd_record->id])}}"><i class="fa fa-plus-square"></i> Medical Procedures</a></li>
                              <li><a href="{{route('pregnancydelivery.antenatalcheckup',['id' => $pd_record->id])}}"><i class="fa fa-medkit"></i> Antenatal Checkups</a></li>
                              <li><a href="{{route('pregnancydelivery.newborn',['id' => $pd_record->id])}}"><i class="fa fa-child"></i> New Born Details</a></li>
                            </ul>
                          </div>
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
