@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><a href="{!! route('configuration') !!}">Register</a></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($vaisseaux as $vaisseau)
                                    <tr>
                                        <td>{!! $vaisseau->id !!}</td>
                                        <td>{!! $vaisseau->id !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
