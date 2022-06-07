@extends('master')

@section('body')
@php
    $paginas = collect([
        ["link"=>"/", "nm_pag" => "Dashboard"], 
        ["link"=>"/filiais", "nm_pag" => "Filiais"],
        ["link"=>"", "nm_pag" => "Editar Filial"],
    ])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />

    <div class="col-12" style="height: 100vh;">
        <div class="card-display border-bottom-orange">
            <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2">
                Editar Filial
            </h1>
            <div class="card-body">
                <form class="" action="/filiais/{{$empresa->id}}" name="edit" method="POST">
                    <div class="row col-12">
                        @method('PATCH')
                        @csrf
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('cnpj'))
                                    <input type="text" class="form-control is-invalid" maxlength="14" id="cnpj" name="cnpj"
                                        placeholder="CNPJ" value="{{ old('cnpj') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('cnpj') }}
                                    </div>
                                @else
                                    <input data-mask-selectonfocus="true"  type="text" class="form-control" maxlength="14" id="cnpj" name="cnpj"
                                        placeholder="CNPJ" value="{{ empty(old('cnpj')) ? $empresa->cnpj : old('cnpj') }}" />
                                @endif
                                <label for="cnpj">CNPJ<b class="text-danger">*</b></label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('razao_social'))
                                    <input type="text" class="form-control is-invalid" maxlength="500" id="razao_social" name="razao_social"
                                        placeholder="Razão Social" value="{{ old('razao_social') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('razao_social') }}
                                    </div>
                                @else
                                    <input type="text" class="form-control" maxlength="500" id="razao_social" name="razao_social"
                                        placeholder="Razão Social" value="{{ empty(old('razao_social')) ? $empresa->razao_social : old('razao_social') }}" />
                                @endif
                                <label for="razao_social">Razão Social<b class="text-danger">*</b></label>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="input-group p-1">
                                @if (isset($errors) && $errors->has('url_customizada'))
                                    <span class="input-group-text" id="basic-addon3">{{env('APP_ENV') != 'local' ? 'https://'.$_SERVER['HTTP_HOST'].'/loja/' : 'http://'.$_SERVER['HTTP_HOST'].'/loja/'}}</span>
                                    <input type="text" class="rounded-end form-control is-invalid" maxlength="20" id="url_customizada" name="url_customizada"
                                        placeholder="Código URL*" aria-describedby="basic-addon3" style="padding: 1rem .75rem;" aria-label="Código URL*" value="{{ old('url_customizada') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('url_customizada') }}
                                    </div>
                                @else
                                    <span class="input-group-text" id="basic-addon3">{{env('APP_ENV') != 'local' ? 'https://'.$_SERVER['HTTP_HOST'].'/loja/' : 'http://'.$_SERVER['HTTP_HOST'].'/loja/'}}</span>
                                    <input type="text" class="rounded-end form-control" maxlength="20" id="url_customizada" name="url_customizada"
                                        placeholder="Código URL*" aria-describedby="basic-addon3"style="padding: 1rem .75rem;" aria-label="Código URL*" value="{{ empty(old('url_customizada')) ? $empresa->url_customizada : old('url_customizada') }}" />
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-end p-3 mx-auto">
                            <a href="/filiais"><button type="button" class="btn btn-danger">Voltar</button></a>
                            <button type="submit" for="cadastro" class="btn btn-success"> Editar </button>
                        </div>
                </form>
            </div>
        </div>
    @endsection

    <script></script>
