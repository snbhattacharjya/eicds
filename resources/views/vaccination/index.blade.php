@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-danger">
              <div class="panel-heading">New Vaccine </div>
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('vaccination.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('vaccination_name') ? ' has-error' : '' }}">
                        <label for="vaccination_name" class="col-md-4 control-label">Vaccination Name</label>

                        <div class="col-md-6">
                            <input id="vaccination_name" type="text" class="form-control" name="vaccination_name" value="{{ old('vaccination_name') }}" required autofocus>

                            @if ($errors->has('vaccination_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('vaccination_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('due_month_from_birth') ? ' has-error' : '' }}">
                        <label for="due_month_from_birth" class="col-md-4 control-label">Vaccination Due Month from Birth</label>

                        <div class="col-md-6">
                            <input id="due_month_from_birth" type="text" class="form-control" name="due_month_from_birth" value="{{ old('due_month_from_birth') }}" required autofocus>

                            @if ($errors->has('due_month_from_birth'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('due_month_from_birth') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
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
            <div class="panel-heading">Vaccinations</div>
            <div class="panel-body">
              <table class="table table-bordered table-condensed table-striped">
                <thead>
                  <tr class="bg-primary">
                    <th>#</th>
                    <th>Vaccination ID</th>
                    <th>Vaccination Name</th>
                    <th>Due Month from Birth</th>
                    <th>Supported By</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($vaccinations as $vaccination)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$vaccination['id']}}</td>
                      <td>{{$vaccination['vaccination_name']}}</td>
                      <td>{{$vaccination['due_month_from_birth']}}</td>
                      <td>
                        @if ($vaccination['type'] == 'Central')
                          {{$vaccination['type']}}
                        @else
                          {{$vaccination['type']}} ({{$vaccination['supported_by']}})
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
