@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-danger">
              <div class="panel-heading">New Pregnancy Medical Procedure </div>
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('medicalprocedure.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('procedure_name') ? ' has-error' : '' }}">
                        <label for="procedure_name" class="col-md-3 control-label">Procedure Name</label>

                        <div class="col-md-6">
                            <input id="procedure_name" type="text" class="form-control" name="procedure_name" value="{{ old('procedure_name') }}" required autofocus>

                            @if ($errors->has('procedure_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('procedure_name') }}</strong>
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
            <div class="panel-heading">Pregnancy Medical Procedures</div>
            <div class="panel-body">
              <table class="table table-bordered table-condensed table-striped">
                <thead>
                  <tr class="bg-primary">
                    <th>#</th>
                    <th>Procedure ID</th>
                    <th>Procedure Name</th>
                    <th>Supported By</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($procedures as $procedure)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$procedure['id']}}</td>
                      <td>{{$procedure['procedure_name']}}</td>
                      <td>
                        @if ($procedure['type'] == 'Central')
                          {{$procedure['type']}}
                        @else
                          {{$procedure['type']}} ({{$procedure['supported_by']}})
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
