@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique seu endereço de e-mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('O link de verificação foi enviado para seu e-mail.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, favor checar seu e-mail.') }}
                    {{ __('Não recebeu o e-mail?') }}, <a href="{{ route('verification.resend') }}">{{ __('clique aqui para solicitar outra senha') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
