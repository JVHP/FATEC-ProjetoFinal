@extends('master')

@section('body')
    @php
    $paginas = collect([
        ['link' => '/', 'nm_pag' => 'Dashboard'], 
        ['link' => '', 'nm_pag' => 'Autenticação']
    ])->collect();
    @endphp

    <x-breadcrumb :paginas="$paginas" />
    
        <div class="card-display border-bottom-orange pb-2">
            <h2 class="rounded border-bottom-orange bg-primary-dark text-white p-2 col-12">Verificação de email necessária
            </h2>

            <div class="card m-2">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Um novo link de verificação foi enviado para seu email.') }}
                    </div>
                @endif
                <div class="row col-12 justify-content-center">
                   
                    <div class="col-md-4 col-12">
                        <img class="img-fluid" src="{{ URL::asset('icons/undraw_secure_login_pdn4.svg') }}" alt=""
                            style="">
                    </div>
                    <div class="col-md-8 col-12 my-auto">
                        <p class="d-inline" style="text-size: 20px">
                            Antes de continuar, por favor cheque sua caixa de entrada e clique em "Verificar email"
                            <br>
                            Se você ainda não recebeu o email,
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('Clique aqui para reenviar o email de verificação!') }}</button>
                        </form>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    
@endsection
