@extends('master')

@section('body')
<div class="col-12 pt-5" style="height: 100vh;">
    <div class="card-display border-bottom-orange">
        <div class="row col-12 mx-auto">
            
            <div class="card-body col-lg-5 col-md-5 col-sm-12 col-12">
            <div class=" col-lg-6 col-md-6 col-sm-12 col-12 card-title mb-0">
                    <h1 class=" rounded bg-primary-dark border-bottom-orange text-white p-2 col-lg-7 col-md-7 col-sm-12 col-12" >Login</h1>
                    <!-- <hr class="p-1 m-0 bg-primary col-lg-3 col-md-3 col-sm-12 col-md-6" style="opacity: 100%; padding-top: 0"> -->
                </div>
                <form method="POST" name="login" action="{{ route('login') }}">
                    @csrf
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        <div class="form-floating p-1">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-Mail" autofocus>
                            <label for="email" class="">{{ __('E-Mail') }}</label>


                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-floating p-1">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Senha">
                            <label for="password" class="">{{ __('Senha') }}</label>


                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="ps-2 pb-2 form-group">
                            <div class="col-md-6 text-start">
                                @if (Route::has('password.request'))
                                <a class=" btn-link" href="{{ route('password.request') }}">
                                    {{ __('Esqueceu a senha?') }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-12 row mb-0 text-end">
                            <div class="form-check col-auto ps-4 ms-5 text-center">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Lembrar Acesso') }}
                                </label>
                            </div>

                            <div class="col-md-6 ps-5 ms-2 text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body col-lg-5 col-md-5 col-sm-12 col-12">
                <div class=" col-lg-6 col-md-6 col-sm-12 col-12 card-title mb-0">
                    <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-lg-9 col-md-9 col-sm-12 col-12" >Cadastro</h1>
                    <!-- <hr class="p-1 m-0 bg-primary col-lg-3 col-md-3 col-sm-12 col-md-6" style="opacity: 100%; padding-top: 0"> -->
                </div>
                <form action="/usuarios" name="cadastro" method="POST">
                    @csrf
                    <div class="col-12">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if($errors->has('nm_usuario'))
                                <input class="form-control is-invalid" id="nome" name="nm_usuario" placeholder="Nome" value="{{(old('nm_usuario'))}}" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('nm_usuario') }}
                                </div>
                                @else
                                <input class="form-control" id="nome" name="nm_usuario" placeholder="Nome" value="{{(old('nm_usuario'))}}" />
                                @endif
                                <label for="nome">Nome</label>
                            </div>
                            <div class="form-floating p-1">
                                @if($errors->has('emailC'))
                                <input type="email" class="form-control is-invalid" id="emailC" name="emailC" placeholder="E-mail" value="{{(old('emailC'))}}" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('emailC') }}
                                </div>
                                @else
                                <input type="email" class="form-control" id="emailC" name="emailC" placeholder="E-mail" value="{{(old('emailC'))}}" />
                                @endif
                                <label for="email">E-mail</label>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if($errors->has('cd_password'))
                                <input type="password" class="form-control is-invalid" id="senha" name="cd_password" placeholder="Senha" value="{{(old('cd_password'))}}" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('cd_password') }}
                                </div>
                                @else
                                <input type="password" class="form-control" id="senha" name="cd_password" placeholder="Senha" value="{{(old('cd_password'))}}" />
                                @endif
                                <label for="senha">Senha</label>
                            </div>
                            <div class="form-floating p-1">
                                @if($errors->has('cd_idade'))
                                <input class="form-control is-invalid" id="idade" name="cd_idade" placeholder="Idade" value="{{(old('cd_idade'))}}" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('cd_idade') }}
                                </div>
                                @else
                                <input class="form-control" id="idade" name="cd_idade" placeholder="Idade" value="{{(old('cd_idade'))}}" />
                                @endif
                                <label for="idade">Idade</label>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if($errors->has('ds_endereco'))
                                <input class="form-control is-invalid" id="endereco" name="ds_endereco" placeholder="Endereço" value="{{(old('ds_endereco'))}}" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('ds_endereco') }}
                                </div>
                                @else
                                <input class="form-control" id="endereco" name="ds_endereco" placeholder="Endereço" value="{{(old('ds_endereco'))}}" />
                                @endif
                                <label for="endereco">Endereço</label>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12 text-end p-3">
                            <input type="submit" class="btn btn-primary" value="Cadastrar" />
                            <!-- <a href="/">
                                <button type="button" class="btn btn-danger">Voltar</button>
                            </a> -->
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection