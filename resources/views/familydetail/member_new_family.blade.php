@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="page-header">
      <h1>Register No. 1 - Family Details Register  <small>(FDR)</small></h1>
    </div>

    <div class="row">
      <div class="col-md-9">
        <form class="form-horizontal" method="POST" action="{{ route('familydetail.showMemberNewFamily') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('aadhaar') ? ' has-error' : '' }}">
                <label for="aadhaar" class="col-md-6 control-label">Aadhaar of Family Member</label>

                <div class="col-md-4">
                    <input id="aadhaar" type="text" class="form-control" name="aadhaar" value="{{ old('aadhaar') }}" required autofocus>

                    @if ($errors->has('aadhaar'))
                        <span class="help-block">
                            <strong>{{ $errors->first('aadhaar') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary">
                      Search
                  </button>
                </div>
            </div>
          </form>
      </div>
    </div>
</div>
@endsection
