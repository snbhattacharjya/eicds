@extends('layouts.app')

@section('content')
{!! Charts::styles() !!}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Population Report</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! $chart->html() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">Category Report</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! $pie_chart->html() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">Gender Report</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! $donut_chart->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $pie_chart->script() !!}
{!! $donut_chart->script() !!}

@endsection
