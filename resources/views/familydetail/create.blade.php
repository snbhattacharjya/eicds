@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default">
              <div class="panel-heading">New Family Registration</div>

              <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('familydetail.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('hof_name') ? ' has-error' : '' }}">
                        <label for="hof_name" class="col-md-4 control-label">HOF Name</label>

                        <div class="col-md-6">
                            <input id="hof_name" type="text" class="form-control" name="hof_name" value="{{ old('hof_name') }}" required autofocus>

                            @if ($errors->has('hof_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hof_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                        <label for="gender" class="col-md-4 control-label">Gender</label>

                        <div class="col-md-6">
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
                        <label for="dob" class="col-md-4 control-label">Date of Birth</label>

                        <div class="col-md-6">
                            <input id="dob" type="text" class="form-control" name="dob" value="{{ old('dob') }}" required autofocus>

                            @if ($errors->has('dob'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

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

                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                        <label for="mobile" class="col-md-4 control-label">Mobile No</label>

                        <div class="col-md-6">
                            <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required autofocus>

                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('anganwadi_resident') ? ' has-error' : '' }}">
                        <label for="anganwadi_resident" class="col-md-4 control-label">Resident under AWC</label>

                        <div class="col-md-6">
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
                        <label for="marital_status" class="col-md-4 control-label">Marital Status</label>

                        <div class="col-md-6">
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
                        <label for="target_id" class="col-md-4 control-label">Target Type</label>

                        <div class="col-md-6">
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
                        <label for="disability_id" class="col-md-4 control-label">Disability Type</label>

                        <div class="col-md-6">
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
                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label for="category_id" class="col-md-4 control-label">Category</label>

                        <div class="col-md-6">
                            <select id="category_id" class="form-control" name="category_id" value="{{ old('category_id') }}" required>
                              <option value="">--Select--</option>
                              @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('minority') ? ' has-error' : '' }}">
                        <label for="minority" class="col-md-4 control-label">Minority</label>

                        <div class="col-md-6">
                            <select id="minority" class="form-control" name="minority" value="{{ old('minority') }}" required>
                              <option value="">--Select--</option>
                              <option value="Y">YES</option>
                              <option value="N">NO</option>
                            </select>
                            @if ($errors->has('minority'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('minority') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('bpl') ? ' has-error' : '' }}">
                        <label for="bpl" class="col-md-4 control-label">BPL Status</label>

                        <div class="col-md-6">
                            <select id="bpl" class="form-control" name="bpl" value="{{ old('bpl') }}" required>
                              <option value="">--Select--</option>
                              <option value="Y">YES</option>
                              <option value="N">NO</option>
                            </select>
                            @if ($errors->has('bpl'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bpl') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address" class="col-md-4 control-label">Address</label>

                        <div class="col-md-6">
                            <textarea id="address" type="address" class="form-control" name="address" required>{{ old('address')}}</textarea>

                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('village_town_name') ? ' has-error' : '' }}">
                        <label for="village_town_name" class="col-md-4 control-label">Village Town Name</label>

                        <div class="col-md-6">
                            <input id="village_town_name" type="text" class="form-control" name="village_town_name" value="{{ old('village_town_name') }}" required autofocus>

                            @if ($errors->has('village_town_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('village_town_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('pincode') ? ' has-error' : '' }}">
                        <label for="pincode" class="col-md-4 control-label">Pincode</label>

                        <div class="col-md-6">
                            <input id="pincode" type="text" class="form-control" name="pincode" value="{{ old('pincode') }}" required autofocus>

                            @if ($errors->has('pincode'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pincode') }}</strong>
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
