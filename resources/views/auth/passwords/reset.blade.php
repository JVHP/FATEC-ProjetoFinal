@extends('master')

@section('body')
    @php
    $paginas = collect([['link' => '/', 'nm_pag' => 'Dashboard'], ['link' => '/login', 'nm_pag' => 'Autenticação'], ['link' => '', 'nm_pag' => 'Redefinir senha']])->collect();
    @endphp

    <x-breadcrumb :paginas="$paginas" />

    <div class="card-display border-bottom-orange pb-2">
        <h2 class="rounded border-bottom-orange bg-primary-dark text-white p-2 col-12">Redefinir senha
        </h2>

        <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-floating m-2">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="E-mail"
                        class="form-control">
                    <label for="">E-mail</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating m-2">
                    <input type="password" placeholder="Senha" id="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password">
                    <label for="">Senha</label>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating m-2">
                    <input type="password" placeholder="Confirmar senha" id="password-confirm"
                        class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <label for="">Confirmar senha</label>
                </div>

                <div class="text-end p-2">
                    <button type="submit" class="btn btn-primary">
                        Redefinir senha
                    </button>
                </div>

            </form>
        </div>
    </div>
    </div>
    </div>
@endsection
