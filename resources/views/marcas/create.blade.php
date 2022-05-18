@extends('master')

@section('body')
    <div class="pt-5">
        <div class="card-display border-bottom-orange col-lg-5 col-md-7 col-sm-8 col-12 mx-auto">
            <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Adicionar Marca</h2>
            <div class="card-body">
                <form class="" action="/marcas" method="POST">
                    @csrf
                    <div class="p-2">
                        <div class="form-floating">
                            @if($errors->has('nm_marca'))
                            <input aria-describedby="invalid-feedback" class="form-control is-invalid" type="text" name="nm_marca" id="nm_marca" placeholder="Nome da Marca" value="{{(old('nm_marca'))}}">
                            <div class="invalid-feedback">
                                {{ $errors->first('nm_marca') }}
                            </div>
                            @else
                            <input class="form-control" type="text" name="nm_marca" id="nm_marca" placeholder="Nome da Marca" value="{{(old('nm_marca'))}}">
                            @endif
                            <label for="nm_marca">Nome da Marca<b class="text-danger">*</b></label>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="form-floating">
                            <div class="card p-2">
                                <label for="ck_categoria_marca">Categoria da Marca<b class="text-danger">*</b></label>
                                <div class="row p-3 justify-content-between">
                                <input class="form-check btn-check" id="marca_peca" type="radio" name="ck_categoria_marca" value="P">
                                    <label class="btn btn-outline-success my-2 col-5" for="marca_peca">Peça</label>
                                <input class="form-check btn-check" id="marca_carro" type="radio" name="ck_categoria_marca" value="C">
                                    <label class="btn btn-outline-success my-2 col-5" for="marca_carro">Carro</label>
                                <input class="form-check btn-check" id="marca_ambas" type="radio" name="ck_categoria_marca" value="A">
                                    <label class="btn btn-outline-success my-2 col-5" for="marca_ambas">Ambas</label>
                                </div>
                            </div>
                            @if($errors->has('ck_categoria_marca'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ck_categoria_marca') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="form-floating">
                            @if($errors->has('ds_marca'))
                            <textarea aria-describedby="invalid-feedback" class="form-control is-invalid" name="ds_marca" id="ds_marca" maxlength="350" placeholder="Descrição da Marca" value="{{old('ds_marca')}}"></textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('ds_marca') }}
                            </div>
                            @else
                            <textarea class="form-control" name="ds_marca" id="ds_marca" maxlength="350" placeholder="Descrição da Marca" value="{{old('ds_marca')}}"></textarea>
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
