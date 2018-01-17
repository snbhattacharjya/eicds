@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-warning">
              <div class="panel-heading">New Vitamin A Dose </div>
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('vitaminadose.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('dose_name') ? ' has-error' : '' }}">
                        <label for="dose_name" class="col-md-4 control-label">Vitamin A Dose Name</label>

                        <div class="col-md-6">
                            <input id="dose_name" type="text" class="form-control" name="dose_name" value="{{ old('dose_name') }}" required autofocus>

                            @if ($errors->has('dose_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dose_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('due_month_from_birth') ? ' has-error' : '' }}">
                        <label for="due_month_from_birth" class="col-md-4 control-label">Vitamin A Dose Due Month from Birth</label>

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
