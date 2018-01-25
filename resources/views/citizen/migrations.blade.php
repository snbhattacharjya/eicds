@extends('layouts.citizen')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Citizen Dashboard</div>

                <div class="panel-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr class="bg-primary">
                        <th>#</th>
                        <th>Member Name</th>
                        <th>Migration Type</th>
                        <th>Remarks</th>
                        <th>Migration Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($records as $record)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$record->member_name}}</td>
                          <td>{{$record->type}}</td>
                          <td>{{$record->remarks}}</td>
                          <td>{{$record->created_at}}</td>
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
