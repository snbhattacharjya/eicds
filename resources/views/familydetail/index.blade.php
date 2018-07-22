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
              <tr class="bg-info">
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
                  <td>
                    <a href="{{route('familydetail.showMembers',['family_id' => $family->id])}}" class="btn btn-sm btn-warning">Members</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </p>
      </div>

      <div class="col-md-3 well">
        <ul class="nav nav-pills nav-stacked">
          <li role="presentation"><a href="{{url('familydetail/create')}}"><label class="text-danger"><i class="fa fa-plus-square"></i> New Family</label></a></li>
          <li role="presentation"><a href="{{url('familydetail/search')}}"><label class="text-success"><i class="fa fa-external-link"></i> Import Family</label></a></li>
          <li role="presentation"><a href="{{url('familydetail/member/newfamily')}}"><label class="text-primary"><i class="fa fa-external-link"></i> Import Member as New Family</label></a></li>
          <li role="presentation"><a href="{{url('familydetail/member/mergefamily')}}"><label class="text-primary"><i class="fa fa-external-link"></i> Merge Families</label></a></li>
        </ul>
      </div>
    </div>
</div>
@endsection
