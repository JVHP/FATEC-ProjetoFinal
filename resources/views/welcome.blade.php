@extends('master')

{{-- @section('banner')
    <div class="banner col-lg-12 col-md-12 col-sm-12 col-12" style=""></div>

    <h1 class="col-12 text-center mx-auto fw-bold text-white titulo-banner">
        iTURBO
    </h1>
@endsection --}}

@section('body')
    @guest
        <div class="row col-12 card-display mx-auto border-bottom-orange">
            <div class="col-md-6 col-12 p-3">
                <div class="">
                    <div class="" id="banner_empresa">
                        <div class="p-2">
                            <h4>
                                Com iTURBO você pode criar seu e-commerce de auto-peças virtual e só se preocupar com as vendas!
                            </h4>
                        </div>
                        <img class="img-fluid" src="{{ URL::asset('icons/undraw_shopping_re_hdd9.svg') }}" alt="...">
                    </div>

                    <div class="hidden" id="banner_usuario">
                        <div class="p-2">{{-- 
                            <h4>
                                Crie sua conta e utilize para comprar com todos nossos parceiros!
                            </h4> --}}
                        </div>
                        <img class="img-fluid" src="{{ URL::asset('icons/undraw_creation_process_re_kqa9.svg') }}"
                            alt="...">
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12 card-display p-3">

                <div class="row col-12 m-0">
                    {{-- <div class="col-6 d-flex justify-content-center">
                        <input onclick="trocarExibicao('usr')" class="form-check btn-check" id="btn_usuario" name="btnEscolha"
                            checked type="radio">
                        <label class="btn btn-outline-primary my-2 col-5 my-auto" for="btn_usuario">Cadastro de Usuário</label>
                    </div> --}}
                    {{-- <div class="col-6 d-flex justify-content-center">
                        <input onclick="trocarExibicao('cmp')" class="form-check btn-check" id="btn_empresa" name="btnEscolha" type="radio">
                        <label class="btn btn-outline-primary my-2 col-5 my-auto" for="btn_empresa">Cadastro de Empresa</label>
                    </div> --}}
                </div>


                <h4 class="text-center">
                    Começe agora seu negócio de auto-peças online.
                </h4>
                <div class="mt-5">
                    <form action="{{ route('usuarios.create') }}" name="usuarios.create" class=""
                        id="form_usuario">
                        <div class="col-12">
                            <div class="col-lg-9 col-md-9 col-sm-12 col-12 mx-auto">
                                {{-- <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2">
                                Cadastro
                            </h1> --}}
                                <div class="form-floating p-1">
                                    @if ($errors->has('nm_usuario'))
                                        <input class="form-control is-invalid" id="nome" maxlength="255" name="nm_usuario"
                                            placeholder="Nome" value="{{ old('nm_usuario') }}" />
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nm_usuario') }}
                                        </div>
                                    @else
                                        <input class="form-control" id="nome" maxlength="255" name="nm_usuario"
                                            placeholder="Nome" value="{{ old('nm_usuario') }}" />
                                    @endif
                                    <label for="nome">Nome</label>
                                </div>
                                <div class="form-floating p-1">
                                    @if ($errors->has('emailC'))
                                        <input type="email" class="form-control is-invalid" maxlength="255" id="emailC"
                                            name="emailC" placeholder="E-mail" value="{{ old('emailC') }}" />
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
                                        <input class="form-control is-invalid" min="1900-01-01" max="{{ date('yyyy-mm-dd') }}"
                                            id="dt_nasc" name="dt_nasc" placeholder="Data de nascimento"
                                            value="{{ old('dt_nasc') }}" />
                                        <div class="invalid-feedback">
                                            {{ $errors->first('dt_nasc') }}
                                        </div>
                                    @else
                                        <input class="form-control" type="date" min="1900-01-01"
                                            max="{{ date('yyyy-mm-dd') }}" id="dt_nasc" name="dt_nasc"
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
                                        <input class="form-control" id="cep" minlength="8" maxlength="8" name="cep"
                                            placeholder="CEP" value="{{ old('cep') }}" />
                                    @endif
                                    <label for="cep">CEP</label>
                                </div>
                                <div class="col-12 text-end p-1">
                                    <input type="submit" class="col-12 btn btn-primary" value="Cadastre-se" />
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="text-center">
                        <p class="m-0 p-0">OU</p>
                    </div>

                    <div class=" text-center">
                        <button onclick="irParaLogin()" class="btn btn-success rounded" type="button">Se já tiver conta, faça o login</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endguest
@endsection
