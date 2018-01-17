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
</div>
@endsection
