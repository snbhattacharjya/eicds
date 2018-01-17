@extends('layouts.app')

@section('content')
  @include('layouts.message')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="page-header">
        <h1>Register No. 7 - Vitamin A Dose Records for Children  <small></small></h1>
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">List of Children </div>
          <div class="panel-body">
            <table class="table table-bordered">
              <thead>
                <tr class="bg-primary">
                  <th>#</th>
                  <th>Member Name</th>
                  <th>Gender</th>
                  <th>Relation</th>
                  <th>Age</th>
                  <th>Beneficiary Type</th>
                  <th>Residence Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($members as $member)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$member->name}}</td>
                    <td>{{$member->gender}}</td>
                    <td>{{$member->relation}}</td>
                    <td>
                      @if (date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y > 0)
                        {{date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y.' yr'}}
                      @else
                        {{date_diff(date_create($member->dob), date_create(date("Y-m-d")))->m.' mon'}}
                      @endif
                    </td>
                    <td>{{$member->target->target_name}}</td>
                    <td>
                      @if ($member->anganwadi_resident)
                        {{'Permanant'}}
                      @else
                        {{'Temporary'}}
                      @endif
                    </td>
                    <td>
                        <a href="{{route('vitamina.create',['member' => $member->id])}}" class="btn btn-warning btn-sm">Select</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
@endsection
