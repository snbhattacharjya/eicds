@extends('layouts.app')

@section('content')
{!! Charts::styles() !!}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Food Distribution Monthly Progress Report</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! $charts['monthly_progress']->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $charts['monthly_progress']->script() !!}

@endsection
