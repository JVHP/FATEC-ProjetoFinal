@extends('master')

@section('body')
    <div class="col-12 pt-5" style="height: 100vh;">
        <div class="card-display border-bottom-orange">
            
            <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2">
                Autenticação
            </h1>
            <div class="row col-12 mx-auto">
                <div class="card-body col-lg-5 col-md-5 col-sm-12 col-12">
                    <div class=" col-lg-6 col-md-6 col-sm-12 col-12 card-title mb-0">
                        <!-- <hr class="p-1 m-0 bg-primary col-lg-3 col-md-3 col-sm-12 col-md-6" style="opacity: 100%; padding-top: 0"> -->
                    </div>
                    <form method="POST" class="" name="login" action="{{ route('login') }}">
                        @csrf
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12 mx-auto">
                            <h1
                                class=" rounded bg-primary-dark border-bottom-orange text-white p-2 ">
                                Login</h1>
                            <div class="form-floating p-1">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="E-Mail" autofocus>
                                <label for="email" class="">{{ __('E-Mail') }}<b class="text-danger">*</b></label>


                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating p-1">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password" placeholder="Senha">
                                <label for="password" class="">{{ __('Senha') }}<b class="text-danger">*</b></label>


                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 p-1">
                                <button type="submit" class="col-12 btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <div class="row mt-2 ps-2 pb-2 form-group">
                                <div class="col-6 text-start">
                                    @if (Route::has('password.request'))
                                        <a class=" btn-link" href="{{ route('password.request') }}">
                                            {{ __('Esqueceu a senha?') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="form-group col-6 row mb-0 text-end">
                                    <div class="form-check col-12 text-start">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Lembrar Acesso') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="card-body col-lg- 6 col-md-6 col-sm-12 col-12">
                    <div class=" col-lg-6 col-md-6 col-sm-12 col-12 card-title mb-0">
                        <!-- <hr class="p-1 m-0 bg-primary col-lg-3 col-md-3 col-sm-12 col-md-6" style="opacity: 100%; padding-top: 0"> -->
                    </div>
                    <form action="{{route('cliente.create')}}" name="cliente.create">
                        <div class="col-12">
                            <div class="col-lg-9 col-md-9 col-sm-12 col-12 mx-auto">
                                <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2">
                                    Cadastro de Usuário
                                </h1>
                                <div class="form-floating p-1">
                                    @if ($errors->has('nm_usuario'))
                                        <input class="form-control is-invalid" id="nome" maxlength="255" name="nm_usuario"
                                            placeholder="Nome" value="{{ old('nm_usuario') }}" />
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nm_usuario') }}
                                        </div>
                                    @else
                                        <input class="form-control" id="nome" maxlength="255" name="nm_usuario" placeholder="Nome"
                                            value="{{ old('nm_usuario') }}" />
                                    @endif
                                    <label for="nome">Nome</label>
                                </div>
                                <div class="form-floating p-1">
                                    @if ($errors->has('emailC'))
                                        <input type="email" class="form-control is-invalid" maxlength="255" id="emailC" name="emailC"
                                            placeholder="E-mail" value="{{ old('emailC') }}" />
                                        <div class="invalid-feedback">
                                            {{ $errors->first('emailC') }}
                                        </div>
                                    @else
                                        <input type="email" class="form-control" maxlength="255" id="emailC" name="emailC"
                                            placeholder="E-mail" value="{{ old('emailC') }}" />
                                    @endif
                                    <label for="email">E-mail</label>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-12 mx-auto">
                                <div class="form-floating p-1">
                                    @if ($errors->has('dt_nasc'))
                                        <input class="form-control is-invalid" min="1900-01-01" max="{{date("yyyy-mm-dd")}}" id="dt_nasc" name="dt_nasc"
                                            placeholder="Data de nascimento" value="{{ old('dt_nasc') }}" />
                                        <div class="invalid-feedback">
                                            {{ $errors->first('dt_nasc') }}
                                        </div>
                                    @else
                                        <input class="form-control" type="date" min="1900-01-01" max="{{date("yyyy-mm-dd")}}" id="dt_nasc" name="dt_nasc"
                                            placeholder="Data de nascimento" value="{{ old('dt_nasc') }}" />
                                    @endif
                                    <label for="dt_nasc">Data de nascimento</label>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-12 mx-auto">
                                <div class="form-floating p-1">
                                    @if ($errors->has('cep'))
                                        <input class="form-control is-invalid" minlength="8" maxlength="8" id="cep" name="cep"
                                            placeholder="CEP" value="{{ old('cep') }}" />
                                        <div class="invalid-feedback">
                                            {{ $errors->first('cep') }}
                                        </div>
                                    @else
                                        <input class="form-control" id="cep" minlength="8" maxlength="8"  name="cep"
                                            placeholder="CEP" value="{{ old('cep') }}" />
                                    @endif
                                    <label for="cep">CEP</label>
                                </div>
                                <div class="col-12 text-end p-1">
                                    <input type="submit" class="col-12 btn btn-primary" value="Cadastrar" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        
    </script>
@endsection