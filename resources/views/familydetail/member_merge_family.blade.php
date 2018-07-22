@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="page-header">
      <h1>Register No. 1 - Family Details Register  <small>(FDR)</small></h1>
    </div>

    <div class="row">
      <div class="col-md-9">
        <form class="form-horizontal" method="POST" action="{{ route('familydetail.showMemberMergeFamily') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('aadhaar_from') ? ' has-error' : '' }}">
                <label for="aadhaar_from" class="col-md-6 control-label">Aadhaar of Family Head (From)</label>

                <div class="col-md-4">
                    <input id="aadhaar_from" type="text" class="form-control" name="aadhaar_from" value="{{ old('aadhaar_from') }}" required autofocus>

                    @if ($errors->has('aadhaar_from'))
                        <span class="help-block">
                            <strong>{{ $errors->first('aadhaar_from') }}</strong>
                        </span>
                    @endif
                </div>

            </div>
            <div class="form-group{{ $errors->has('aadhaar_to') ? ' has-error' : '' }}">
                <label for="aadhaar_to" class="col-md-6 control-label">Aadhaar of Family Head (To)</label>

                <div class="col-md-4">
                    <input id="aadhaar_to" type="text" class="form-control" name="aadhaar_to" value="{{ old('aadhaar_to') }}" required autofocus>

                    @if ($errors->has('aadhaar_to'))
                        <span class="help-block">
                            <strong>{{ $errors->first('aadhaar_to') }}</strong>
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

    @if (isset($member))
      <div class="row">
        <div class="col-md-9">
          <table class="table table-bordered">
            <thead>
              <tr class="bg-info">
                <th>FamilyID</th>
                <th>HOF Name</th>
                <th>Category</th>
                <th>Address</th>
                <th>Village Town Name</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>{{$member->family->id}}</td>
                  <td>{{$member->family->hof_name}}</td>
                  <td>{{$member->family->category->category_name}}</td>
                  <td>{{$member->family->address}}</td>
                  <td>{{$member->family->village_town_name}}</td>
                  <td>
                    <div class="input-group">
                      <form class="form-horizontal" method="POST" action="{{ route('familydetail.import') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{$member->family->id}}" id="family_id" name="family_id">
                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks...">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="submit">Import</button>
                        </span>
                      </form>
                    </div><!-- /input-group -->

                  </td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    @endif
</div>
@endsection
