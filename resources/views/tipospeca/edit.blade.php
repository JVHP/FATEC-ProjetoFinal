@extends('master')

@section('body')
@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Dashboard"], 
    ["link"=>"/tipospeca", "nm_pag" => "Tipos de Peça"],
    ["link"=>"", "nm_pag" => "Editar Tipo de Peça"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
<div class="">
    <div class="card-display border-bottom-orange col-lg-5 col-md-7 col-sm-8 col-12 mx-auto">
        <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12" >Editar Tipo de Peça</h2>
        <div class="card-body">
            @if(isset($message))
                <div class="alert alert-danger">{{$message}}</div>
            @endif
            <form class="" action="/tipospeca/{{$tipo->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="p-2">                    
                    <div class="form-floating">
                        @if($errors->has('nm_tipo'))
                        <input aria-describedby="invalid-feedback" class="form-control is-invalid" type="text" name="nm_tipo" id="nm_tipo" placeholder="Nome Peça" value="{{(empty(old('nm_tipo'))) ? $tipo->nm_tipo : (old('nm_tipo'))}}">
                        <div class="invalid-feedback">
                            {{ $errors->first('nm_tipo') }}
                        </div>
                        @else
                        <input class="form-control" type="text" name="nm_tipo" id="nm_tipo" placeholder="Nome do Tipo de Carro" value="{{(empty(old('nm_tipo'))) ? $tipo->nm_tipo : (old('nm_tipo'))}}">
                        @endif
                        <label for="nm_tipo">Nome do Tipo de Peça</label>
                        
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
                                    @if($cmp->id == $tipo->id_empresa)
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
                    <div class="form-check form-switch">
                        @if($tipo->ck_ativo == 1)
                        <input class="form-check-input" name="ck_ativo" type="checkbox" value="on" checked role="switch" id="flexSwitchCheck">
                        @else
                        <input class="form-check-input" name="ck_ativo" type="checkbox" value="" role="switch" id="flexSwitchCheck">
                        @endif
                        <label class="form-check-label" for="flexSwitchCheck">Ativo</label>
                    </div>
                </div>
                
                <div class="p-2 text-end">
                    <input class="btn btn-success" type="submit" value="Salvar">
                    <a href="/tipospeca">
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