@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Painel') }} -
                    {{ __('Você está logado!') }}</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-6">Teste 1</div>
                        <div class="col-6">Teste 2</div>
                    </div>


                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card-header">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">Teste 1</div>
                            <div class="col-6">Teste 2</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
