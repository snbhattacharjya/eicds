@extends('layouts.managelogin')

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">Login Manager</div>

                  <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('managelogin.central') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-lg btn-success btn-block">Login Central User</button>
                          </div>
                        </div>
                    </form>

                    <form class="form-horizontal" method="POST" action="{{ route('managelogin.state') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="state" class="col-md-3 control-label">State</label>

                            <div class="col-md-6">
                                <select id="state" class="form-control" name="state" required>
                                    <option value="">--Select State--</option>
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

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>

                    </form>

                    <form class="form-horizontal" method="POST" action="{{ route('managelogin.district') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-3 control-label">District</label>

                            <div class="col-md-6">
                                <select id="district" class="form-control" name="district" required>

                                </select>
                                @if ($errors->has('district'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>

                    </form>

                    <form class="form-horizontal" method="POST" action="{{ route('managelogin.project') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('project') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-3 control-label">Project</label>

                            <div class="col-md-6">
                                <select id="project" class="form-control" name="project" required>

                                </select>
                                @if ($errors->has('project'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('project') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>

                    </form>

                    <form class="form-horizontal" method="POST" action="{{ route('managelogin.sector') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('sector') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-3 control-label">Sector</label>

                            <div class="col-md-6">
                                <select id="sector" class="form-control" name="sector" required>

                                </select>
                                @if ($errors->has('sector'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sector') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>

                    </form>

                    <form class="form-horizontal" method="POST" action="{{ route('managelogin.centre') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('centre') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-3 control-label">Anganwadi Centre</label>

                            <div class="col-md-6">
                                <select id="center" class="form-control" name="center" required>

                                </select>
                                @if ($errors->has('center'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('center') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>

                    </form>

                    <form class="form-horizontal" method="POST" action="{{ route('managelogin.citizen') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-lg btn-danger btn-block">Login Citizen</button>
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

    $('#project').on('change',function(){
      var project = $(this).val();
      $.ajax({
          mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
          url: "{{url('/api/sectors')}}",
          type: "POST",
          data: {
              project: project
          },
          success: function(data) {
              $('#sector').empty();
              var result=JSON.parse(JSON.stringify(data));
              $('#sector').append("<option value=''>--Select Sector--</option>");
              $.each(result,function(i){
                  $('#sector').append("<option value='"+result[i].id+"'>"+result[i].sector_name+"</option>");
              });
          },
          error: function (jqXHR, textStatus, errorThrown) {
              alert(errorThrown);
          },
          dataType: "json",
          async: false
      });
    });

    $('#sector').on('change',function(){
      var sector = $(this).val();
      $.ajax({
          mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
          url: "{{url('/api/centres')}}",
          type: "POST",
          data: {
              sector: sector
          },
          success: function(data) {
              $('#center').empty();
              var result=JSON.parse(JSON.stringify(data));
              $('#center').append("<option value=''>--Select Anganwadi Centre--</option>");
              $.each(result,function(i){
                  $('#center').append("<option value='"+result[i].id+"'>"+result[i].centre_name+"</option>");
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
