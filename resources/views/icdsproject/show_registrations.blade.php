@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="page-header">
          <h1>External Citizen Registration  <small>(Allocation to AWC)</small></h1>
        </div>
          <table class="table table-bordered">
            <thead>
              <tr class="bg-info">
                <th>#</th>
                <th>Aadhaar No</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($external_citizens as $external_citizen)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$external_citizen->aadhaar}}</td>
                  <td>{{$external_citizen->name}}</td>
                  <td>{{$external_citizen->mobile}}</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-warning">Select</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        
      </div>
    </div>
</div>
@endsection
