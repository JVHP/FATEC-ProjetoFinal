@extends('master')

@section('body')
    <div class="col-12 pt-5" style="height: 100vh;">
        <div class="card-display border-bottom-orange">
            <h1
                class="rounded bg-primary-dark border-bottom-orange text-white p-2">
                Cadastro
            </h1>
            <div class="card-body">
                {{-- <div class="card-title mb-0">
                </div> --}}
                <form class="" action="/usuarios" name="cadastro" method="POST">
                    <div class="row col-12 mx-auto justify-content-center">
                        <div class="row col-lg-8 col-12 justify-content-lg-between justify-content-center">
                            @csrf
                            <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                                <div class="form-floating p-1">
                                    @if (isset($errors) && $errors->has('nm_usuario'))
                                        <input class="form-control is-invalid" id="nome" maxlength="255" name="nm_usuario"
                                            placeholder="Nome"
                                            value="{{ old('nm_usuario') != null ? old('nm_usuario') : (isset($_GET['nm_usuario']) ? $_GET['nm_usuario'] : old('nm_usuario')) }}" />
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nm_usuario') }}
                                        </div>
                                    @else
                                        <input class="form-control" id="nome" maxlength="255" name="nm_usuario"
                                            placeholder="Nome"
                                            value="{{ old('nm_usuario') != null
                                                ? old('nm_usuario')
                                                : (isset($_GET['nm_usuario'])
                                                    ? $_GET['nm_usuario']
                                                    : old('nm_usuario')) }}" />
                                    @endif
                                    <label for="nome">Nome<b class="text-danger">*</b></label>
                                </div>
                            </div>
    
                            <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                                <div class="form-floating p-1">
                                    @if (isset($errors) && $errors->has('email'))
                                        <input type="email" class="form-control is-invalid" maxlength="255" id="email"
                                            name="email" placeholder="E-mail"
                                            value="{{ old('email') != null ? old('email') : (isset($_GET['emailC']) ? $_GET['emailC'] : old('email')) }}" />
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @else
                                        <input type="email" class="form-control" maxlength="255" id="email" name="email"
                                            placeholder="E-mail"
                                            value="{{ old('email') != null ? old('email') : (isset($_GET['emailC']) ? $_GET['emailC'] : old('email')) }}" />
                                    @endif
                                    <label for="email">E-mail<b class="text-danger">*</b></label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                                <div class="form-floating p-1">
                                    @if (isset($errors) && $errors->has('dt_nasc'))
                                        <input class="form-control is-invalid" type="date" min="1900-01-01"
                                            max="{{ date('yyyy-mm-dd') }}" id="idade" name="dt_nasc" placeholder="Idade"
                                            value="{{ old('dt_nasc') != null ? old('dt_nasc') : (isset($_GET['dt_nasc']) ? $_GET['dt_nasc'] : old('dt_nasc')) }}" />
                                        <div class="invalid-feedback">
                                            {{ $errors->first('dt_nasc') }}
                                        </div>
                                    @else
                                        <input class="form-control" type="date" min="1900-01-01"
                                            max="{{ date('yyyy-mm-dd') }}" id="idade" name="dt_nasc"
                                            placeholder="Data de nascimento"
                                            value="{{ old('dt_nasc') != null ? old('dt_nasc') : (isset($_GET['dt_nasc']) ? $_GET['dt_nasc'] : old('dt_nasc')) }}" />
                                    @endif
                                    <label for="idade">Data de nascimento<b class="text-danger">*</b></label>
                                </div>
                            </div>
    
                            <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                                <div class="form-floating p-1">
                                    @if (isset($errors) && $errors->has('cep'))
                                        <input type="text" class="form-control is-invalid" id="endereco" minlength="8"
                                            maxlength="8" name="cep" placeholder="Endereço"
                                            value="{{ old('cep') != null ? old('cep') : (isset($_GET['cep']) ? $_GET['cep'] : old('cep')) }}" />
                                        <div class="invalid-feedback">
                                            {{ $errors->first('cep') }}
                                        </div>
                                    @else
                                        <input type="text" class="form-control" id="endereco" minlength="8" maxlength="8"
                                            name="cep" placeholder="CEP"
                                            value="{{ old('cep') != null ? old('cep') : (isset($_GET['cep']) ? $_GET['cep'] : old('cep')) }}" />
                                    @endif
                                    <label for="endereco">CEP<b class="text-danger">*</b></label>
                                </div>
                            </div>
    
                            <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                                <div class="form-floating p-1">
                                    @if (isset($errors) && $errors->has('cd_password'))
                                        <input type="password" class="form-control is-invalid" id="senha" name="cd_password"
                                            placeholder="Senha" value="{{ old('cd_password') }}" />
                                        <div class="invalid-feedback">
                                            {{ $errors->first('cd_password') }}
                                        </div>
                                    @else
                                        <input type="password" class="form-control" id="senha" name="cd_password"
                                            placeholder="Senha" value="{{ old('cd_password') }}" />
                                    @endif
                                    <label for="senha">Senha<b class="text-danger">*</b></label>
                                </div>
                            </div>
    
                            <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                                <div class="form-floating p-1">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" placeholder="Confirmar senha" required
                                        autocomplete="new-password">
                                    <label for="password-confirm">{{ __('Confirmar senha') }}<b class="text-danger">*</b></label>
                                </div>
                            </div>    
                            
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 col-12 ms-auto">
                            <div class="p-1">
                                <div class="card p-1 overflow-auto" style="max-height: 190px">
                                    <div class="card-title">Selecione seu(s) carro(s)</div>
                                    <div class="accordion" id="accordionExample">
                                        @foreach ($carros as $carros_ano)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $carros_ano[0]->ano }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $carros_ano[0]->ano }}" aria-expanded="false"
                                                        aria-controls="collapse{{ $carros_ano[0]->ano }}">
                                                        {{ $carros_ano[0]->ano }}
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $carros_ano[0]->ano }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="heading{{ $carros_ano[0]->ano }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body row col-12">
                                                @foreach ($carros_ano as $carro)
                                                            <div class="col-auto m-2">
                                                                <input class="form-check btn-check"  type="checkbox" id="btn-check{{ $carro->id }}" name="carros[]" value="{{ $carro->id }}" id="">
                                                                <label class="btn btn-outline-success" for="btn-check{{ $carro->id }}" for="">
                                                                    {{ $carro->nm_carro }}
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                            </div>
                                        @endforeach
        
        
        
        
                                    </div>
                                </div>
                            </div>
                            @if (isset($errors) && $errors->has('carros'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('carros') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-end p-3">
                        <button type="submit" for="cadastro" class="btn btn-primary"> Cadastrar </button>
                    </div>
                </form>

                {{-- <form class="row col-12 justify-content-center" action="/usuarios" name="cadastro" method="POST">
                    @csrf
                    <div class="row col-6 justify-content-center">
                        <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('nm_usuario'))
                                    <input class="form-control is-invalid" id="nome" maxlength="255" name="nm_usuario" placeholder="Nome"
                                        value="{{ old('nm_usuario') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nm_usuario') }}
                                    </div>
                                @else
                                    <input class="form-control" id="nome" maxlength="255" name="nm_usuario" placeholder="Nome"
                                        value="{{ isset($_GET['nm_usuario']) ? $_GET['nm_usuario'] : old('nm_usuario') }}" />
                                @endif
                                <label for="nome">Nome</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('email'))
                                    <input type="email" class="form-control is-invalid" maxlength="255" id="email" name="email"
                                        placeholder="E-mail"
                                        value="{{ isset($_GET['emailC']) ? $_GET['emailC'] : old('email') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('emailC') }}
                                    </div>
                                @else
                                    <input type="email" class="form-control" maxlength="255" id="email" name="email" placeholder="E-mail"
                                        value="{{ isset($_GET['emailC']) ? $_GET['emailC'] : old('email') }}" />
                                @endif
                                <label for="email">E-mail</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('cd_password'))
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

                        <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" placeholder="Confirmar senha" required
                                    autocomplete="new-password">
                                <label for="password-confirm">{{ __('Confirmar senha') }}</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('dt_nasc'))
                                    <input class="form-control is-invalid" type="date" min="1900-01-01" max="{{date("yyyy-mm-dd")}}" id="idade" name="dt_nasc" placeholder="Idade"
                                        value="{{ old('dt_nasc') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('dt_nasc') }}
                                    </div>
                                @else
                                    <input class="form-control" type="date" min="1900-01-01" max="{{date("yyyy-mm-dd")}}" id="idade" name="dt_nasc"
                                        placeholder="Data de nascimento"
                                        value="{{ isset($_GET['dt_nasc']) ? $_GET['dt_nasc'] : old('dt_nasc') }}" />
                                @endif
                                <label for="idade">Data de nascimento</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('cep'))
                                    <input type="number" class="form-control is-invalid" id="endereco" minlength="8" maxlength="8" name="cep"
                                        placeholder="Endereço" value="{{ old('cep') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('cep') }}
                                    </div>
                                @else
                                    <input type="number" class="form-control" id="endereco" minlength="8" maxlength="8" name="cep" placeholder="CEP"
                                        value="{{ isset($_GET['cep']) ? $_GET['cep'] : old('cep') }}" />
                                @endif
                                <label for="endereco">CEP</label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row col-6 justify-content-center">
                        <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('nm_usuario'))
                                    <input class="form-control is-invalid" id="nome" maxlength="255" name="nm_usuario" placeholder="Nome"
                                        value="{{ old('nm_usuario') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nm_usuario') }}
                                    </div>
                                @else
                                    <input class="form-control" id="nome" maxlength="255" name="nm_usuario" placeholder="Nome"
                                        value="{{ isset($_GET['nm_usuario']) ? $_GET['nm_usuario'] : old('nm_usuario') }}" />
                                @endif
                                <label for="nome">Nome</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('email'))
                                    <input type="email" class="form-control is-invalid" maxlength="255" id="email" name="email"
                                        placeholder="E-mail"
                                        value="{{ isset($_GET['emailC']) ? $_GET['emailC'] : old('email') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('emailC') }}
                                    </div>
                                @else
                                    <input type="email" class="form-control" maxlength="255" id="email" name="email" placeholder="E-mail"
                                        value="{{ isset($_GET['emailC']) ? $_GET['emailC'] : old('email') }}" />
                                @endif
                                <label for="email">E-mail</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('cd_password'))
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

                        <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" placeholder="Confirmar senha" required
                                    autocomplete="new-password">
                                <label for="password-confirm">{{ __('Confirmar senha') }}</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('dt_nasc'))
                                    <input class="form-control is-invalid" type="date" min="1900-01-01" max="{{date("yyyy-mm-dd")}}" id="idade" name="dt_nasc" placeholder="Idade"
                                        value="{{ old('dt_nasc') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('dt_nasc') }}
                                    </div>
                                @else
                                    <input class="form-control" type="date" min="1900-01-01" max="{{date("yyyy-mm-dd")}}" id="idade" name="dt_nasc"
                                        placeholder="Data de nascimento"
                                        value="{{ isset($_GET['dt_nasc']) ? $_GET['dt_nasc'] : old('dt_nasc') }}" />
                                @endif
                                <label for="idade">Data de nascimento</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-9 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('cep'))
                                    <input type="number" class="form-control is-invalid" id="endereco" minlength="8" maxlength="8" name="cep"
                                        placeholder="Endereço" value="{{ old('cep') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('cep') }}
                                    </div>
                                @else
                                    <input type="number" class="form-control" id="endereco" minlength="8" maxlength="8" name="cep" placeholder="CEP"
                                        value="{{ isset($_GET['cep']) ? $_GET['cep'] : old('cep') }}" />
                                @endif
                                <label for="endereco">CEP</label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-end p-3">
                        <button type="submit" for="cadastro" class="btn btn-primary"> Cadastrar </button>
                    </div>
                </form> --}}
            </div>
        </div>
    @endsection
