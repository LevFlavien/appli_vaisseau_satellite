@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Vaisseau satellite</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{!! route('tokens') !!}"><button class="btn btn-primary">Token</button></a>
                    <a href="{!! route('configuration') !!}"><button class="btn btn-primary">Configuration</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
