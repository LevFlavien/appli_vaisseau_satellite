@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Vaisseau satellite : token</div>

                    <div class="panel-body">

                        @if ($token)

                            <p>Dernier token : {!! $token->token ?? 'No token yet' !!}</p>
                            <p>Reçu le : {!! $token->updated_at !!}</p>

                        @else

                            <p>Pas de token reçu.</p>

                        @endif

                        <p>Date de dernière communication : </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
