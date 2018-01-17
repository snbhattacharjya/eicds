@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-danger">
              <div class="panel-heading">New Preschool Activity </div>
              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('medicalprocedure.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('procedure_name') ? ' has-error' : '' }}">
                        <label for="procedure_name" class="col-md-4 control-label">Procedure Name</label>

                        <div class="col-md-6">
                            <input id="procedure_name" type="text" class="form-control" name="procedure_name" value="{{ old('procedure_name') }}" required autofocus>

                            @if ($errors->has('procedure_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('procedure_name') }}</strong>
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