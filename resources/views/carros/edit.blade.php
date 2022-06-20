@extends('master')

@section("body")
@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Dashboard"], 
    ["link"=>"/carros", "nm_pag" => "Carros"],
    ["link"=>"", "nm_pag" => "Editar Carro"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
<div class="">
    <script src="/js/creates/carros.js"></script>
    <div class="card-display border-bottom-orange col-lg-5 col-md-7 col-sm-8 col-12 mx-auto">
        <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12" >Editar Carro</h2>
        <div class="pt-3 card-body">
            <form class="" action="/carros/{{$carro->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="p-2">
                    <div class="form-floating">
                        @if($errors->has('nm_carro'))
                        <input aria-describedby="invalid-feedback" class="form-control is-invalid" type="text" name="nm_carro" id="nm_carro" placeholder="Nome do Carro" value="{{(empty(old('nm_carro'))) ? $carro->nm_carro : (old('nm_carro'))}}">
                        <div class="invalid-feedback">
                            {{ $errors->first('nm_carro') }}
                        </div>
                        @else
                        <input class="form-control" type="text" name="nm_carro" id="nm_carro" placeholder="Nome do Carro" value="{{(empty(old('nm_carro'))) ? $carro->nm_carro : (old('nm_carro'))}}">
                        @endif
                        <label for="nm_carro">Nome do Carro<b class="text-danger">*</b></label>
                    </div>
                </div>
                <div class="p-2">
                    <div class="form-floating">
                        @if($errors->has('ano'))
                        <input aria-describedby="invalid-feedback" class="form-control is-invalid" type="number" name="ano" id="ano" placeholder="Ano do Carro" value="{{(empty(old('ano'))) ? $carro->ano : (old('ano'))}}">
                        <div class="invalid-feedback">
                            {{ $errors->first('ano') }}
                        </div>
                        @else
                        <input class="form-control" type="number" name="ano" id="ano" placeholder="Ano do Carro" value="{{(empty(old('ano'))) ? $carro->ano : (old('ano'))}}">
                        @endif
                        <label for="ano">Ano do Carro<b class="text-danger">*</b></label>
                    </div>
                </div>

                <div class="p-2 row col-12">
                    <div class="col-10">
                        <div class="form-floating">
                            @if($errors->has('id_empresa'))
                            <select aria-placeholder="Filial" id="id_empresa" class="form-select is-invalid" name="id_empresa" value="{{old('id_empresa')}}" onchange="limparPesquisa()">
                                <option value="" selected="{{old('id_empresa') != null ? false : true}}" disabled>Selecione...</option>
                                @foreach($empresas as $emp)
                                    @if($emp->id == old('id_empresa'))
                                    <option selected value="{{$emp->id}}">{{$emp->razao_social}}</option>
                                    @else
                                    <option value="{{$emp->id}}">{{$emp->razao_social}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('id_empresa') }}
                            </div>
                            @else
                            <select aria-placeholder="Filial" id="id_empresa" class="form-select" name="id_empresa" onchange="limparPesquisa()">
                                <option value="" selected disabled>Selecione...</option>
                                @foreach($empresas as $emp)
                                    @if($emp->id == $carro->id_empresa)
                                    <option selected value="{{$emp->id}}">{{$emp->razao_social}}</option>
                                    @else
                                    <option value="{{$emp->id}}">{{$emp->razao_social}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @endif
                            <label for="id_empresa">Filial<b class="text-danger">*</b></label>
                        </div>
                    </div>
                    <div class="col-2 my-auto text-end">
                        <button id="btn_empresa" type="button" onclick="pesquisarInfosFilialCarro()" class="btn btn-danger rounded-circle p-2">
                            <img class="m-0 p-0" src="{{URL::asset('/icons/search-white.svg')}}" alt="">
                        </button>
                    </div>
                </div>

                <input type="hidden" id="pesquisado" value="true">

                <div class="p-2">
                    <div class="form-floating">
                        @if($errors->has('id_marca'))
                        <select aria-placeholder="Marca" id="id_marca" class="form-select is-invalid" name="id_marca" value="{{old('id_marca')}}">
                            <option value="" selected="{{old('id_marca') != null ? false : true}}" disabled>Selecione...</option>
                            @foreach($marcas as $mrc)
                            @if($mrc->id == old('id_marca'))
                            <option selected value="{{$mrc->id}}">{{$mrc->nm_marca}}</option>
                            @else
                            <option value="{{$mrc->id}}">{{$mrc->nm_marca}}</option>
                            @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('id_marca') }}
                        </div>
                        @else
                        <select aria-placeholder="Marca" id="id_marca" class="form-select" name="id_marca">
                            <option value="" selected disabled>Selecione...</option>
                            @foreach($marcas as $mrc)
                            @if($mrc->id == $marcaCarro->id)
                            <option selected value="{{$mrc->id}}">{{$mrc->nm_marca}}</option>
                            @else
                            <option value="{{$mrc->id}}">{{$mrc->nm_marca}}</option>
                            @endif
                            @endforeach
                        </select>
                        @endif
                        <label for="id_marca">Marca<b class="text-danger">*</b></label>
                    </div>
                </div>

                <div class="p-2">
                    <div class="form-floating">
                        <select class="form-control" id="id_tipo_carro" name="id_tipo_carro" id="">
                            @foreach($tipo as $x)
                            @if($x->id == $carro->id_tipo_carro)
                            <option value="{{$x->id}}" selected>{{$x->nm_tipo}}</option>
                            @endif
                            <option value="{{$x->id}}">{{$x->nm_tipo}}</option>
                            @endforeach
                        </select>
                        <label for="id_tipo_carro">Categoria do Carro<b class="text-danger">*</b></label>
                    </div>
                </div>
                <div class="p-2">
                    <input class="btn btn-success" type="submit" value="Salvar">
                    <a href="/carros">
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