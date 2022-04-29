@extends('master')

@section('body')
<div class="col-12 pt-5" style="height: 100vh;">
    <div class="card col-5 mx-auto">
        <div class="card-title p-2 mb-0">
            <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-lg-7 col-md-7 col-sm-12 col-12" >Editar Usuário</h1>
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
                            <input class="form-control is-invalid" id="nome" name="nm_usuario" placeholder="Nome" value="{{(empty(old('nm_usuario'))) ? $usuario->nm_usuario : (old('nm_usuario'))}}"/>
                            <div class="invalid-feedback">
                            {{ $errors->first('nm_usuario') }}
                            </div>
                            @else
                            <input class="form-control" id="nome" name="nm_usuario" placeholder="Nome" value="{{(empty(old('nm_usuario'))) ? $usuario->nm_usuario : (old('nm_usuario'))}}"/>
                            @endif
                            <label for="nome">Nome</label>
                        </div>
                        <div class="form-floating p-1">
                            @if($errors->has('email'))
                            <input type="email" class="form-control is-invalid" id="email" name="email" placeholder="E-mail" value="{{(empty(old('email'))) ? $usuario->email : (old('email'))}}"/>
                            <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                            </div>
                            @else
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{(empty(old('email'))) ? $usuario->email : (old('email'))}}"/>
                            @endif
                            <label for="email">E-mail</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating p-1">
                            @if($errors->has('cd_idade'))
                            <input class="form-control is-invalid" id="idade" name="cd_idade" placeholder="Idade" value="{{(empty(old('cd_idade'))) ? $usuario->cd_idade : (old('cd_idade'))}}"/>
                            <div class="invalid-feedback">
                            {{ $errors->first('cd_idade') }}
                            </div>
                            @else
                            <input class="form-control" id="idade" name="cd_idade" placeholder="Idade" value="{{(empty(old('cd_idade'))) ? $usuario->cd_idade : (old('cd_idade'))}}"/>
                            @endif
                            <label for="idade">Idade</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating p-1">
                            @if($errors->has('ds_endereco'))
                            <input class="form-control is-invalid" id="endereco" name="ds_endereco" placeholder="Endereço" value="{{(empty(old('ds_endereco'))) ? $usuario->ds_endereco: (old('ds_endereco'))}}"/>
                            <div class="invalid-feedback">
                            {{ $errors->first('ds_endereco') }}
                            </div>
                            @else
                            <input class="form-control" id="endereco" name="ds_endereco" placeholder="Endereço" value="{{(empty(old('ds_endereco'))) ? $usuario->ds_endereco: (old('ds_endereco'))}}"/>
                            @endif
                            <label for="endereco">Endereço</label>
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