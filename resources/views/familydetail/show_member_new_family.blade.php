@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="page-header">
      <h1>Register No. 1 - Family Details Register  <small>(FDR)</small></h1>
    </div>
      <div class="row">
        <div class="col-md-9">
          <table class="table table-bordered">
            <thead>
              <tr class="bg-info">
                <th>FamilyID</th>
                <th>Member Name</th>
                <th>HOF Name</th>
                <th>Category</th>
                <th>Address</th>
                <th>Village Town Name</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>{{$member->family->id}}</td>
                  <td>{{$member->name}}</td>
                  <td>{{$member->family->hof_name}}</td>
                  <td>{{$member->family->category->category_name}}</td>
                  <td>{{$member->family->address}}</td>
                  <td>{{$member->family->village_town_name}}</td>
                </tr>
            </tbody>
          </table>

          <form class="form-horizontal" method="POST" action="{{ route('familydetail.showMemberNewFamily') }}">
              {{ csrf_field() }}
          <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
              <label for="remarks" class="col-md-6 control-label">Remarks</label>

              <div class="col-md-4">
                  <input id="remarks" type="text" class="form-control" name="remarks" value="{{ old('remarks') }}" required autofocus>
                  <input id="otp" type="hidden" name="otp" value="{{ old('otp') }}">
                  @if ($errors->has('remarks'))
                      <span class="help-block">
                          <strong>{{ $errors->first('remarks') }}</strong>
                      </span>
                  @endif
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary otp">
                    Search
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
@endsection

@section('scripts')
  <script type="text/javascript">
    $(function(){alert();
      $('.otp').hide();
    });
    $('#generate-otp').on('click',function(){
      if($('#remarks').val().length > 0){
        var remarks = $('#remarks').val();
        $.ajax({
            mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
            url: "{{url('/api/generate-otp')}}",
            type: "GET",
            data: {
                remarks: remarks
            },
            success: function(data) {
                var result=JSON.parse(JSON.stringify(data));
                if(result.otp != 'error'){
                  $('#generate-otp').hide();
                  $('.otp').show();
                  $('#otp').val(result.otp);
                  console.log(result.otp);
                }
                else{
                  alert('Invalid otp!!!');
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
        alert('Remarks Field Empty!!!');
      }

    });
  </script>
@endsection
