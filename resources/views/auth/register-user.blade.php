@extends('master')

@section('body')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 card-title mb-0">
                    <h1
                        class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-lg-9 col-md-9 col-sm-12 col-12">
                        Cadastro
                    </h1>
                </div>

                <form class="col-12" action="/usuarios" name="cadastro" method="POST">
                    <div class="row justify-content-center">
                    @csrf
                    {{$errors}}
                        <div class="col-lg-4 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if ($errors->has('nm_usuario'))
                                    <input class="form-control is-invalid" id="nome" name="nm_usuario" placeholder="Nome"
                                        value="{{ old('nm_usuario') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nm_usuario') }}
                                    </div>
                                @else
                                    <input class="form-control" id="nome" name="nm_usuario" placeholder="Nome"
                                        value="{{ isset($_GET['nm_usuario']) ? $_GET['nm_usuario'] : '' }}" />
                                @endif
                                <label for="nome">Nome</label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if ($errors->has('email'))
                                    <input type="email" class="form-control is-invalid" id="email" name="email"
                                        placeholder="E-mail"
                                        value="{{ isset($_GET['emailC']) ? $_GET['emailC'] : old('nm_usuario') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('emailC') }}
                                    </div>
                                @else
                                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"
                                        value="{{ isset($_GET['emailC']) ? $_GET['emailC'] : old('nm_usuario') }}" />
                                @endif
                                <label for="email">E-mail</label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if ($errors->has('cd_password'))
                                    <input type="password" class="form-control is-invalid" id="senha" name="cd_password"
                                        placeholder="Senha" value="{{ old('cd_password') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('cd_password') }}
                                    </div>
                                @else
                                    <input type="password" class="form-control" id="senha" name="cd_password"
                                        placeholder="Senha"
                                        value="{{ old('cd_password') }}" />
                                @endif
                                <label for="senha">Senha</label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" placeholder="Confirmar senha" required
                                    autocomplete="new-password">
                                <label for="password-confirm">{{ __('Confirmar senha') }}</label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if ($errors->has('dt_nasc'))
                                    <input class="form-control is-invalid" type="date" id="idade" name="dt_nasc" placeholder="Idade"
                                        value="{{ old('dt_nasc') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('dt_nasc') }}
                                    </div>
                                @else
                                    <input class="form-control" type="date" id="idade" name="dt_nasc"
                                        placeholder="Data de nascimento"
                                        value="{{ isset($_GET['dt_nasc']) ? $_GET['dt_nasc'] : old('dt_nasc') }}" />
                                @endif
                                <label for="idade">Data de nascimento</label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if ($errors->has('cep'))
                                    <input type="number" class="form-control is-invalid" id="endereco" name="cep"
                                        placeholder="Endereço" value="{{ old('cep') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('cep') }}
                                    </div>
                                @else
                                    <input type="number" class="form-control" id="endereco" name="cep" placeholder="CEP"
                                        value="{{ isset($_GET['cep']) ? $_GET['cep'] : old('cep') }}" />
                                @endif
                                <label for="endereco">CEP</label>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-end p-3">
                            <button type="submit" for="cadastro" class="btn btn-primary"> Cadastrar </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
