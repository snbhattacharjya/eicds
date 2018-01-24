@extends('layouts.citizen')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">All Family Members </div>
            <div class="panel-body">
              <table class="table table-bordered">
                <thead>
                  <tr class="bg-primary">
                    <th>#</th>
                    <th>Member Name</th>
                    <th>Relation</th>
                    <th>Age</th>
                    <th>Beneficiary Type</th>
                    <th>Disability</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($members as $member)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$member->name}}</td>
                      <td>{{$member->relation}}</td>
                      <td>
                        @if (date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y > 0)
                          {{date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y.' yr'}}
                        @else
                          {{date_diff(date_create($member->dob), date_create(date("Y-m-d")))->m.' mon'}}
                        @endif
                      </td>
                      <td>{{$member->target->target_name}}</td>
                      <td>{{$member->disability->disability_type_name}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
@endsection
