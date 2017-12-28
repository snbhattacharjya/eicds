@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <div class="page-header">
      <h1>Register No. 1 - Family Details Register  <small>(Member Details)</small></h1>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">All Family Members </div>
            <div class="panel-body">
              <table class="table table-bordered">
                <thead>
                  <tr class="bg-primary">
                    <th>#</th>
                    <th>Member Name</th>
                    <th>Relation</th>
                    <th>Age</th>
                    <th>Beneficiary Type</th>
                    <th>Disability</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($members as $member)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$member->name}}</td>
                      <td>{{$member->relation}}</td>
                      <td>
                        @if (date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y > 0)
                          {{date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y.' yr'}}
                        @else
                          {{date_diff(date_create($member->dob), date_create(date("Y-m-d")))->m.' mon'}}
                        @endif
                      </td>
                      <td>{{$member->target->target_name}}</td>
                      <td>{{$member->disability->disability_type_name}}</td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-danger btn-sm">Select Action</button>
                          <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href="#">View</a></li>
                            <li><a href="#">Migration</a></li>
                            <li><a href="#">Mark as HOF</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Add New Member</div>

            <div class="panel-body">
              <form class="form-horizontal" method="POST" action="{{ route('member.store') }}">
                  {{ csrf_field() }}
                  <input type="hidden" value="{{$family_id}}" id="family_id" name="family_id">
                  <div class="form-group{{ $errors->has('member_name') ? ' has-error' : '' }}">
                      <label for="member_name" class="col-md-5 control-label">Member Name</label>

                      <div class="col-md-7">
                          <input id="member_name" type="text" class="form-control" name="member_name" value="{{ old('member_name') }}" required autofocus>

                          @if ($errors->has('member_name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('member_name') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('relation') ? ' has-error' : '' }}">
                      <label for="relation" class="col-md-5 control-label">Relation with HOF</label>

                      <div class="col-md-7">
                          <input id="relation" type="text" class="form-control" name="relation" value="{{ old('relation') }}" required autofocus>

                          @if ($errors->has('relation'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('relation') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                      <label for="gender" class="col-md-5 control-label">Gender</label>

                      <div class="col-md-7">
                          <select id="gender" class="form-control" name="gender" value="{{ old('gender') }}" required>
                            <option value="">--Select--</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                          </select>
                          @if ($errors->has('gender'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('gender') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                      <label for="dob" class="col-md-5 control-label">Date of Birth</label>

                      <div class="col-md-7">
                          <input id="dob" type="text" class="form-control" name="dob" value="{{ old('dob') }}" required autofocus>

                          @if ($errors->has('dob'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('dob') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('aadhaar') ? ' has-error' : '' }}">
                      <label for="aadhaar" class="col-md-5 control-label">Aadhaar No</label>

                      <div class="col-md-7">
                          <input id="aadhaar" type="text" class="form-control" name="aadhaar" value="{{ old('aadhaar') }}" required autofocus>

                          @if ($errors->has('aadhaar'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('aadhaar') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                      <label for="mobile" class="col-md-5 control-label">Mobile No</label>

                      <div class="col-md-7">
                          <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required autofocus>

                          @if ($errors->has('mobile'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('mobile') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('anganwadi_resident') ? ' has-error' : '' }}">
                      <label for="anganwadi_resident" class="col-md-5 control-label">Resident under AWC</label>

                      <div class="col-md-7">
                          <select id="anganwadi_resident" class="form-control" name="anganwadi_resident" required>
                            <option value="">--Select--</option>
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                          </select>
                          @if ($errors->has('anganwadi_resident'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('anganwadi_resident') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : '' }}">
                      <label for="marital_status" class="col-md-5 control-label">Marital Status</label>

                      <div class="col-md-7">
                          <select id="marital_status" class="form-control" name="marital_status" value="{{ old('marital_status') }}" required>
                            <option value="">--Select--</option>
                            <option value="Married">Married</option>
                            <option value="Unmarried">Unmarried</option>
                          </select>
                          @if ($errors->has('marital_status'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('marital_status') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('target_id') ? ' has-error' : '' }}">
                      <label for="target_id" class="col-md-5 control-label">Target Type</label>

                      <div class="col-md-7">
                          <select id="target_id" class="form-control" name="target_id" value="{{ old('target_id') }}" required>
                            <option value="">--Select--</option>
                            @foreach ($targets as $target)
                              <option value="{{$target->id}}">{{$target->target_name}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('target_id'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('target_id') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('disability_id') ? ' has-error' : '' }}">
                      <label for="disability_id" class="col-md-5 control-label">Disability Type</label>

                      <div class="col-md-7">
                          <select id="disability_id" class="form-control" name="disability_id" value="{{ old('disability_id') }}" required>
                            <option value="">--Select--</option>
                            @foreach ($disabilities as $disability)
                              <option value="{{$disability->id}}">{{$disability->disability_type_name}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('disability_id'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('disability_id') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-primary btn-block">
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
