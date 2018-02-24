@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Vaisseau satellite : Configuration</div>

                    <div class="panel-body">

                        {!! BootForm::inline(['model' => $configuration ?? new App\Configuration(), 'store' => 'configuration.save', 'update' => 'configuration.save']) !!}

                            <fieldset>
                                {!! BootForm::text('amiral_address'); !!}
                            </fieldset>
                            <fieldset>
                                {!! BootForm::radios('active', null, [1 => 'Active',  0 => 'Inactive']) !!}
                            </fieldset>
                            {!! BootForm::submit('Valider') !!}

                        {!! BootForm::close() !!}

                        <a href="{!! route('home') !!}"><button class="btn btn-primary">Retour</button></a>

                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/js/textForm.js"></script>
@endpush
