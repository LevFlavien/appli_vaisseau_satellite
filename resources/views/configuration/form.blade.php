@extends('layouts.app')

@section('content')
    <div id="textForm" class="container">
        <div class="card">
            <div class="card-block">

                {!! BootForm::open(['model' => $configuration ?? new App\Configuration(), 'store' => 'configuration.save']) !!}

                    {!! BootForm::text('amiral_address'); !!}
                    {!! BootForm::radios('active', null, [true => 'Active',  false => 'Inactive']) !!}
                    {!! BootForm::submit('Valider') !!}

                {!! BootForm::close() !!}

                <a href="{!! route('home') !!}"><button class="btn btn-primary">Retour</button></a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/js/textForm.js"></script>
@endpush
