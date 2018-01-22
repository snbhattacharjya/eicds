@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-danger">
              <div class="panel-heading">New Supplementary Food Type </div>
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('supplementaryfoodtype.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('type_name') ? ' has-error' : '' }}">
                        <label for="type_name" class="col-md-3 control-label">Food Type Name</label>

                        <div class="col-md-6">
                            <input id="type_name" type="text" class="form-control" name="type_name" value="{{ old('type_name') }}" required autofocus>

                            @if ($errors->has('type_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
              </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-success">
            <div class="panel-heading">Supplementary Food Types</div>
            <div class="panel-body">
              <table class="table table-bordered table-condensed table-striped">
                <thead>
                  <tr class="bg-primary">
                    <th>#</th>
                    <th>Food Type ID</th>
                    <th>Food Type Name</th>
                    <th>Supported By</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($food_types as $food_type)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$food_type['id']}}</td>
                      <td>{{$food_type['type_name']}}</td>
                      <td>
                        @if ($food_type['type'] == 'Central')
                          {{$food_type['type']}}
                        @else
                          {{$food_type['type']}} ({{$food_type['supported_by']}})
                        @endif
                      </td>
                      <td><a href="#" class="btn btn-sm btn-info">select</a.</td>
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
