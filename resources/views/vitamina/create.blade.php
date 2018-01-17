@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-success">
              <div class="panel-heading">New Vitamin A Dose Record</div>

              <div class="panel-body">
                <dl class="dl-horizontal well">
                  <dt>Member:</dt>
                  <dd>{{$member->name}}</dd>
                  <dt>Gender:</dt>
                  <dd>{{$member->gender}}</dd>
                  <dt>Beneficiary Type:</dt>
                  <dd>{{$member->target->target_name}}</dd>
                  <dt>Date of Birth:</dt>
                  <dd>{{date_format(date_create($member->dob),'d/m/Y')}}</dd>
                  <dt>Age:</dt>
                  <dd>
                    @if (date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y > 0)
                      {{date_diff(date_create($member->dob), date_create(date("Y-m-d")))->y.' yr'}}
                    @else
                      {{date_diff(date_create($member->dob), date_create(date("Y-m-d")))->m.' mon'}}
                    @endif
                  </dd>
                  <dt>Residence under AWC:</dt>
                  <dd>
                    @if ($member->anganwadi_resident)
                      {{'Permanant'}}
                    @else
                      {{'Temporary'}}
                    @endif
                  </dd>
                </dl>
                <form class="form-horizontal" method="POST" action="{{ route('vitamina.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="member_id" name="member_id" value="{{$member->id}}">

                    <div class="form-group{{ $errors->has('dose_id') ? ' has-error' : '' }}">
                        <label for="dose_id" class="col-md-4 control-label">Vitamin A Dose Name</label>

                        <div class="col-md-6">
                            <select id="dose_id" type="text" class="form-control" name="dose_id" required autofocus>
                              <option value="">--Select--</option>
                              @foreach ($doses as $dose)
                                <option value="{{$dose->id}}">{{$dose->dose_name}}</option>
                              @endforeach
                            </select>

                            @if ($errors->has('dose_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dose_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('due_date') ? ' has-error' : '' }}">
                        <label for="due_date" class="col-md-4 control-label">Due Date</label>

                        <div class="col-md-6">
                            <input id="due_date" type="text" class="form-control" name="due_date" value="{{ old('due_date') }}" required>

                            @if ($errors->has('due_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('due_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('admin_date') ? ' has-error' : '' }}">
                        <label for="admin_date" class="col-md-4 control-label">Admin Date</label>

                        <div class="col-md-6">
                            <input id="admin_date" type="text" class="form-control" name="admin_date" value="{{ old('admin_date') }}" required>

                            @if ($errors->has('admin_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('admin_date') }}</strong>
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
