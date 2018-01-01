@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="page-header">
      <h1>Register No. 1 - Family Details Register  <small>(FDR)</small></h1>
    </div>

    <div class="row">
      <div class="col-md-9">
        <p>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>FamilyID</th>
                <th>HOF Name</th>
                <th>Category</th>
                <th>Address</th>
                <th>Village Town Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($families as $family)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$family->id}}</td>
                  <td>{{$family->hof_name}}</td>
                  <td>{{$family->category->category_name}}</td>
                  <td>{{$family->address}}</td>
                  <td>{{$family->village_town_name}}</td>
                  <td><a href="#" class="btn btn-sm btn-warning">Edit</a>
                    <a href="{{route('familydetail.showMembers',['family_id' => $family->id])}}" class="btn btn-sm btn-info">Members</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </p>
      </div>

      <div class="col-md-3">
          <a href="{{url('familydetail/create')}}" class="btn btn-lg btn-primary pull-right"name="button">Add New Family</a>
      </div>
    </div>
</div>
@endsection
