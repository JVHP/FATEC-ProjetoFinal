@extends('master')

@section('body')
@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Dashboard"], 
    ["link"=>"/marcas", "nm_pag" => "Marcas"],
    ["link"=>"", "nm_pag" => "Editar Marca"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
    <div class="">
        <div class="card-display border-bottom-orange col-lg-5 col-md-7 col-sm-8 col-12 mx-auto">
            <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Editar Marca</h2>
            <div class="card-body">
                @if(isset($message))
                <div class="alert alert-danger">{{$message}}</div>
                @endif
                <form class="" action="/marcas/{{$marca->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-2">
                        <div class="form-floating">
                            @if($errors->has('nm_marca'))
                            <input aria-describedby="invalid-feedback" class="form-control is-invalid" type="text" name="nm_marca" id="nm_marca" placeholder="Nome da Marca" value="{{(empty(old('nm_marca'))) ? $marca->nm_marca : (old('nm_marca'))}}">
                            <div class="invalid-feedback">
                                {{ $errors->first('nm_marca') }}
                            </div>
                            @else
                            <input class="form-control" type="text" name="nm_marca" id="nm_marca" placeholder="Nome da Marca" value="{{(empty(old('nm_marca'))) ? $marca->nm_marca : (old('nm_marca'))}}">
                            @endif
                            <label for="nm_marca">Nome da Marca<b class="text-danger">*</b></label>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="form-floating">
                            <div class="card p-2">
                                <label for="ck_categoria_marca">Categoria da Marca<b class="text-danger">*</b></label>
                                <div class="row p-3 justify-content-between">
                                @if($marca->ck_categoria_marca == 'P')
                                <input class="form-check btn-check" id="marca_peca" checked="true" type="radio" name="ck_categoria_marca" value="P">
                                    <label class="btn btn-outline-success my-2 col-5" for="marca_peca">Peça</label>
                                @else
                                <input class="form-check btn-check" id="marca_peca" type="radio" name="ck_categoria_marca" value="P">
                                    <label class="btn btn-outline-success my-2 col-5" for="marca_peca">Peça</label>
                                @endif
                                @if($marca->ck_categoria_marca == 'C')
                                <input class="form-check btn-check" id="marca_carro" checked="true" type="radio" name="ck_categoria_marca" value="C">
                                    <label class="btn btn-outline-success my-2 col-5" for="marca_carro">Carro</label>
                                @else
                                <input class="form-check btn-check" id="marca_carro" type="radio" name="ck_categoria_marca" value="C">
                                    <label class="btn btn-outline-success my-2 col-5" for="marca_carro">Carro</label>
                                @endif 
                                </div>
                                @if($marca->ck_categoria_marca == 'A')
                                <input class="form-check btn-check" id="marca_carro" checked="true" type="radio" name="ck_categoria_marca" value="A">
                                    <label class="btn btn-outline-success my-2 col-5" for="marca_carro">Ambas</label>
                                @else
                                <input class="form-check btn-check" id="marca_ambas" type="radio" name="ck_categoria_marca" value="A">
                                    <label class="btn btn-outline-success my-2 col-5" for="marca_ambas">Ambas</label>
                                @endif 
                                </div>
                            </div>
                            @if($errors->has('ck_categoria_marca'))
                            <div class="text-danger">
                                {{ $errors->first('ck_categoria_marca') }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="p-2">
                        <div class="form-floating">
                            @if ($errors->has('id_empresa'))
                                <select aria-placeholder="Filial" id="id_empresa" class="form-select is-invalid"
                                    name="id_marca" value="{{ old('id_empresa') }}">
                                    <option value="" selected="{{ old('id_empresa') != null ? false : true }}"
                                        disabled>Selecione...</option>
                                    @foreach ($empresas as $cmp)
                                        @if ($cmp->id == old('id_empresa'))
                                            <option selected value="{{ $cmp->id }}">{{ $cmp->razao_social }}
                                            </option>
                                        @else
                                            <option value="{{ $cmp->id }}">{{ $cmp->razao_social }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_empresa') }}
                                </div>
                            @else
                                <select aria-placeholder="Filial" id="id_empresa" class="form-select"
                                    name="id_empresa">
                                    <option value="" selected disabled>Selecione...</option>
                                    @foreach ($empresas as $cmp)
                                        @if($cmp->id == $marca->id_empresa)
                                        <option value="{{ $cmp->id }}" selected>{{ $cmp->razao_social }}</option>
                                        @else
                                        <option value="{{ $cmp->id }}" >{{ $cmp->razao_social }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                            <label for="id_marca">Filial</label>
                        </div>
                    </div>

                    <div class="p-2">
                        <div class="form-floating">
                            @if($errors->has('ds_marca'))
                            <textarea aria-describedby="invalid-feedback" class="form-control is-invalid" name="ds_marca" id="ds_marca" maxlength="350" style="height: 160px;" placeholder="Descrição da Marca">{{(empty(old('ds_marca'))) ? $marca->ds_marca : (old('ds_marca'))}}</textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('ds_marca') }}
                            </div>
                            @else
                            <textarea class="form-control" name="ds_marca" id="ds_marca" maxlength="350" style="height: 160px;" placeholder="Descrição da Marca">{{empty(old('ds_marca')) ? $marca->ds_marca : old('ds_marca')}}</textarea>
                            @endif
                            <label for="ds_marca">Descrição da Marca</label>
                        </div>
                    </div>
                    <div class="p-2">
                        <input class="btn btn-success" type="submit" value="Salvar">
                        <a href="/marcas">
                            <button class="btn btn-danger" type="button">
                                Voltar
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection