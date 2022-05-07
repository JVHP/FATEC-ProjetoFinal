@extends('master')

@section('body')
<div class="col-12 pt-5" style="height: 100vh;">
    <div class="card-display border-bottom-orange col-5 mx-auto">
        <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12" >Editar Usuário</h1>
        <div class="card-title p-2 mb-0">
            <!-- <hr class="p-1 m-0 bg-primary col-lg-5 col-md-3 col-sm-12 col-md-6" style="opacity: 100%; padding-top: 0"> -->
        </div>
        <form action="/usuarios/{{$usuario->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="col-12">
                    <div class="col-12">
                        <div class="form-floating p-1">
                            @if($errors->has('nm_usuario'))
                            <input class="form-control is-invalid" id="nome" name="nm_usuario" maxlength="255" placeholder="Nome" value="{{(empty(old('nm_usuario'))) ? $usuario->nm_usuario : (old('nm_usuario'))}}"/>
                            <div class="invalid-feedback">
                            {{ $errors->first('nm_usuario') }}
                            </div>
                            @else
                            <input class="form-control" id="nome" name="nm_usuario" maxlength="255" placeholder="Nome" value="{{(empty(old('nm_usuario'))) ? $usuario->nm_usuario : (old('nm_usuario'))}}"/>
                            @endif
                            <label for="nome">Nome</label>
                        </div>
                        <div class="form-floating p-1">
                            @if($errors->has('email'))
                            <input type="email" class="form-control is-invalid" id="email" maxlength="255" name="email" placeholder="E-mail" value="{{(empty(old('email'))) ? $usuario->email : (old('email'))}}"/>
                            <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                            </div>
                            @else
                            <input type="email" class="form-control" id="email" name="email" maxlength="255" placeholder="E-mail" value="{{(empty(old('email'))) ? $usuario->email : (old('email'))}}"/>
                            @endif
                            <label for="email">E-mail</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating p-1">
                            @if($errors->has('dt_nasc'))
                            <input class="form-control is-invalid" type="date" id="dt_nasc" name="dt_nasc"  min="1900-01-01" max="{{date("yyyy-mm-dd")}}" placeholder="Data de nascimento" value="{{(empty(old('dt_nasc'))) ? $usuario->dt_nasc : (old('dt_nasc'))}}"/>
                            <div class="invalid-feedback">
                            {{ $errors->first('dt_nasc') }}
                            </div>
                            @else
                            <input class="form-control" type="date" id="dt_nasc" min="1900-01-01" max="{{date("yyyy-mm-dd")}}" name="dt_nasc" placeholder="Data de nascimento" value="{{(empty(old('dt_nasc'))) ? $usuario->dt_nasc : (old('dt_nasc'))}}"/>
                            @endif
                            <label for="dt_nasc">Data de nascimento</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating p-1">
                            @if($errors->has('cep'))
                            <input class="form-control is-invalid" minlength="8" maxlength="8" id="cep" name="cep" placeholder="CEP" value="{{(empty(old('cep'))) ? $usuario->cep: (old('cep'))}}"/>
                            <div class="invalid-feedback">
                            {{ $errors->first('cep') }}
                            </div>
                            @else
                            <input class="form-control" id="cep" minlength="8" maxlength="8" name="cep" placeholder="CEP" value="{{(empty(old('cep'))) ? $usuario->cep: (old('cep'))}}"/>
                            @endif
                            <label for="cep">CEP</label>
                        </div>
                    </div>
                    <div class="col-12 text-end p-3">
                        <input type="submit" class="btn btn-primary" value="Editar"/>
                        <a href="/usuarios">
                            <button type="button" class="btn btn-danger">Voltar</button>
                        </a>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection