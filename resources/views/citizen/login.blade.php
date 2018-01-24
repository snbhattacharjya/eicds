@extends('layouts.citizen')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Citizen Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('citizen.login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('aadhaar') ? ' has-error' : '' }}">
                            <label for="aadhaar" class="col-md-4 control-label">Aadhaar No</label>

                            <div class="col-md-6">
                                <input id="aadhaar" type="text" class="form-control" name="aadhaar" value="{{ old('aadhaar') }}" required autofocus>

                                @if ($errors->has('aadhaar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aadhaar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} otp">
                            <label for="password" class="col-md-4 control-label">OTP</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group otp">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }} otp">
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
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary otp">
                                    Login
                                </button>
                                <button type="button" class="btn btn-primary" id="generate-otp">
                                    Generate OTP
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
  <script type="text/javascript">
    $(function(){
      $('.otp').hide();
    });
    $('#generate-otp').on('click',function(){
      if($('#aadhaar').val().length > 0){
        var aadhaar = $('#aadhaar').val();
        $.ajax({
            mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
            url: "{{url('/api/citizen/login/otp')}}",
            type: "POST",
            data: {
                aadhaar: aadhaar
            },
            success: function(data) {
                var result=JSON.parse(JSON.stringify(data));
                if(result.password != 'error'){
                  $('#generate-otp').hide();
                  $('.otp').show();
                  //$('#aadhaar').prop('disabled',true);
                  alert(result.password);
                }
                else{
                  alert('Invalid Aadhaar!!!');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            },
            dataType: "json",
            async: false
        });

      }
      else{
        alert('Aadhaar Field Empty!!!');
      }

    });
  </script>
@endsection
