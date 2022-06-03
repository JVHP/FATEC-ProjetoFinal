@extends('master')

@section('body')
@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Dashboard"], 
    ["link"=>"/pecas", "nm_pag" => "Peças"],
    ["link"=>"", "nm_pag" => "Visualizar Peça - ".$peca->nm_peca.""],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
<div class="pt-5">
    <div class="card-display border-bottom-orange col-12 mx-auto">
        <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Visualizar Peça - {{$peca->nm_peca}}</h2>
        <div class="p-2 card-title mb-0">
        </div>
        <div class="card-body">
            <form action="/pecas/{{$peca->id}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="row col-12">
                    <div class="col-lg-4 col-12 my-auto">
                        <div class="p-2">
                            <div class="text-center">
                                <img id="imgPeca"
                                    src="{{ $peca->foto ? 'data:image/webp;base64,' . stream_get_contents($peca->foto) : URL::asset('images/default.webp') }}"
                                    alt="Imagem" width="200" height="200" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12 p-2">
                                <input type="hidden" name="id_peca" value="{{ $peca->id }}">
                                <div class="form-floating">
                                    <input disabled class="form-control" type="text" name="nm_peca" id="nm_peca"
                                        placeholder="Nome Peça" value="{{$peca->nm_peca}}">
                                    <label for="nm_peca">Nome Peça</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 p-2">
                                <div class="form-floating">
                                    <input disabled class="form-select" aria-placeholder="Marca" id="id_marca" 
                                    type="text" value="{{$peca->marca()->first()->nm_marca}}" placeholder="Marca">
                                    <label for="id_marca">Marca</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 p-2">
                                <div class="form-floating">
                                    <input disabled class="form-control" type="number" step="0.01" name="vl_peca"
                                        id="vl_peca" placeholder="Valor"
                                        value="{{$peca->vl_peca}}">
                                    <label for="vl_peca">Valor</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 p-2">
                                <div class="form-floating">
                                    <input disabled class="form-control" type="number" name="qt_estoque" id="qt_estoque"
                                        placeholder="Estoque"
                                        value="{{ $peca->qt_estoque }}">
                                    <label for="qt_estoque">Estoque</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 p-2">
                                <div class="form-floating">
                                    <input disabled class="form-control" type="text" name="id_tipo" id="id_tipo"
                                        placeholder="Estoque"
                                        value="{{ $tipoPeca->nm_tipo }}">
                                    <label for="id_tipo_peca">Tipo peça</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 p-2">
                                <div class="form-floating">
                                    <textarea disabled class="form-control" maxlength="500" style="height: 12.6rem" name="ds_peca" id="ds_peca">{{$peca->ds_peca}}</textarea>
                                    <label for="ds_peca">Descrição da peça</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 p-2">
                                <div class="card p-2" style="height: 12.6rem; background: #e9ecef;">
                                    <label for="carros">Carros Compatíveis</label>
                                    <div class="form-floating">
                                        <select disabled aria-placeholder="Carros Compatíveis" style="height: 10rem;" id="carros"
                                            class="form-select p-0" name="" multiple
                                            aria-label="multiple select example">
                                            @forelse($carros as $xx)
                                            <option class="" selected>{{$xx->nm_carro}}</option>
                                            @empty
                                            <option class="" selected>Compatibilidade Universal</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-end p-2">
                        <a href="/pecas"><button type="button" class="btn btn-primary">Voltar</button></a>
                        <input type="submit" class="btn btn-danger" value="Deletar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection