@extends('master')

@section('body')
    @php
    $paginas = collect([['link' => '/', 'nm_pag' => 'Dashboard'], ['link' => '/login', 'nm_pag' => 'Autenticação'], ['link' => '', 'nm_pag' => 'Esqueci a senha']])->collect();
    @endphp

    <x-breadcrumb :paginas="$paginas" />
    <div class="col-12" style="height: 100vh;">
        <div class="card-display border-bottom-orange">
            <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2">
                Esqueci a senha
            </h1>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="col-6 mx-auto">
                        <div class="input-group form-floating mb-3">
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="E-mail" aria-label="Example text with button addon"
                                aria-describedby="button-addon1" name="email" id="email" required autocomplete="email">
                                <label for="email">E-mail</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                            <button class="btn btn-primary" type="submit" id="button-addon1">Enviar solicitação</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
