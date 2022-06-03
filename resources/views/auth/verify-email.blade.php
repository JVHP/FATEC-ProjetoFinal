@extends('master')

@section('body')
@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Dashboard"], 
    ["link"=>"", "nm_pag" => "Autenticação"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
    <div class="container">

        <div class="card-display border-bottom-orange pb-2">
            <h2 class="rounded border-bottom-orange bg-primary-dark text-white p-2 col-12">Verificação de email nescessária
            </h2>

            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Um novo link de verificação foi enviado para seu email.') }}
                    </div>
                @endif
                <p class="d-inline">
                    Antes de continuar, por favor cheque sua caixa de entrada e clique em "Verificar email"
                    Se você ainda não recebeu o email,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit"
                            class="btn btn-link p-0 m-0 align-baseline">{{ __('Clique aqui para reenviar o email de verificação') }}</button>.
                    </form>
                </p>
            </div>
        </div>
    </div>
@endsection
