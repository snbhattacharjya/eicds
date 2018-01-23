@extends('layouts.citizen')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Register Citizen for eICDS</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('citizen.register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('aadhaar') ? ' has-error' : '' }}">
                            <label for="aadhaar" class="col-md-4 control-label">Aadhaar No</label>

                            <div class="col-md-6">
                                <input id="aadhaar" type="text" class="form-control" name="aadhaar" value="{{ old('aadhaar') }}" required>

                                @if ($errors->has('aadhaar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aadhaar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">State</label>

                            <div class="col-md-6">
                                <select id="state" class="form-control" name="state" required>
                                  <option value="">--Select--</option>
                                  @foreach ($states as $state)
                                    <option value="{{$state->id}}">{{$state->state_name}}</option>
                                  @endforeach
                                </select>

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">
                            <label for="district" class="col-md-4 control-label">District</label>

                            <div class="col-md-6">
                              <select id="district" class="form-control" name="district" required>

                              </select>
                                @if ($errors->has('district'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('project') ? ' has-error' : '' }}">
                            <label for="project" class="col-md-4 control-label">Icds Project</label>

                            <div class="col-md-6">
                              <select id="project" class="form-control" name="project" required>

                              </select>
                                @if ($errors->has('project'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('project') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label">Mobile</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required>

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                          <div class="col-md-6 col-md-offset-4">
                            <div class="g-recaptcha" data-sitekey="6LdiukAUAAAAAPYwpNR9zazL_Pyufj9VwPmua-q6"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong>Captcha Field Required. </strong>
                                </span>
                            @endif
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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

@section('scripts')
  <script>
    $('#state').on('change',function(){
      var state = $(this).val();
      $.ajax({
          mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
          url: "{{url('/api/districts')}}",
          type: "POST",
          data: {
              state: state
          },
          success: function(data) {
              $('#district').empty();
              var result=JSON.parse(JSON.stringify(data));
              $('#district').append("<option value=''>--Select District--</option>");
              $.each(result,function(i){
                  $('#district').append("<option value='"+result[i].id+"'>"+result[i].district_name+"</option>");
              });
          },
          error: function (jqXHR, textStatus, errorThrown) {
              alert(errorThrown);
          },
          dataType: "json",
          async: false
      });
    });

    $('#district').on('change',function(){
      var district = $(this).val();
      $.ajax({
          mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
          url: "{{url('/api/projects')}}",
          type: "POST",
          data: {
              district: district
          },
          success: function(data) {
              $('#project').empty();
              var result=JSON.parse(JSON.stringify(data));
              $('#project').append("<option value=''>--Select Project--</option>");
              $.each(result,function(i){
                  $('#project').append("<option value='"+result[i].id+"'>"+result[i].project_name+"</option>");
              });
          },
          error: function (jqXHR, textStatus, errorThrown) {
              alert(errorThrown);
          },
          dataType: "json",
          async: false
      });
    });
    </script>
@endsection
