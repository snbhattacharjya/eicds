@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-danger">
              <div class="panel-heading">New Preschool Activity </div>
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('preschoolactivity.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('activity_name') ? ' has-error' : '' }}">
                        <label for="activity_name" class="col-md-4 control-label">Acivity Name</label>

                        <div class="col-md-6">
                            <input id="activity_name" type="text" class="form-control" name="activity_name" value="{{ old('activity_name') }}" required autofocus>

                            @if ($errors->has('activity_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('activity_name') }}</strong>
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
