@extends('layouts.citizen')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Supplementary Nutrition Program</div>

                <div class="panel-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr class="bg-primary">
                        <th>#</th>
                        <th>Member Name</th>
                        <th>Food Type</th>
                        <th>Quantity</th>
                        <th>Service Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($records as $record)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$record->member_name}}</td>
                          <td>{{$record->type_name}}</td>
                          <td>{{$record->ration_given_quantity}}</td>
                          <td>{{$record->ration_given_quantity}}</td>
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
