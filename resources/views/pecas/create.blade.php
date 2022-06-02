@extends('master')

@section('body')
    <div class="pt-5">
        <div class="card-display border-bottom-orange col-12 mx-auto">
            <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Adicionar Peça</h2>
            <div class="p-2 card-title mb-0">
                <!-- <hr class="p-1 m-0 bg-primary col-lg-6 col-md-5 col-sm-12 col-md-6" style="opacity: 100%; padding-top: 0"> -->
            </div>
            <div class="card-body">
                <form class="" action="/pecas" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row col-12">
                        <div class="col-lg-4 col-12 my-auto">
                            <div class="p-2">
                                <div class="text-center">
                                    <img id="imgPeca" src="{{ URL::asset('images/default.webp') }}" alt="Imagem" width="200"
                                        height="200" />
                                </div>
                                <label for="fotoTemp">Foto da peça</label>
                                <input
                                    onchange="document.getElementById('imgPeca').src = window.URL.createObjectURL(this.files[0])"
                                    class="form-control" type="file" name="fotoTemp" id="fotoTemp"
                                    placeholder="Foto da peça">
                            </div>
                        </div>
                        <div class="col-lg-8 col-12">
                            <div class="row">
                                <div class="col-lg-4 col-12 p-2">
                                    <div class="form-floating">
                                        @if ($errors->has('nm_peca'))
                                            <input aria-describedby="invalid-feedback" class="form-control is-invalid"
                                                type="text" name="nm_peca" id="nm_peca" placeholder="Nome Peça"
                                                value="{{ old('nm_peca') }}">
                                            <div class="invalid-feedback">
                                                {{ $errors->first('nm_peca') }}
                                            </div>
                                        @else
                                            <input class="form-control" type="text" name="nm_peca" id="nm_peca"
                                                placeholder="Nome Peça" value="{{ old('nm_peca') }}">
                                        @endif
                                        <label for="nm_peca">Nome Peça</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 p-2">
                                    <div class="form-floating">
                                        @if ($errors->has('id_marca'))
                                            <select aria-placeholder="Marca" id="id_marca" class="form-select is-invalid"
                                                name="id_marca" value="{{ old('id_marca') }}">
                                                <option value="" selected="{{ old('id_marca') != null ? false : true }}"
                                                    disabled>Selecione...</option>
                                                @foreach ($marcas as $mrc)
                                                    @if ($mrc->id == old('id_marca'))
                                                        <option selected value="{{ $mrc->id }}">{{ $mrc->nm_marca }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $mrc->id }}">{{ $mrc->nm_marca }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('id_marca') }}
                                            </div>
                                        @else
                                            <select aria-placeholder="Marca" id="id_marca" class="form-select"
                                                name="id_marca">
                                                <option value="" selected disabled>Selecione...</option>
                                                @foreach ($marcas as $mrc)
                                                    <option value="{{ $mrc->id }}">{{ $mrc->nm_marca }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <label for="id_marca">Marca</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 p-2">
                                    <div class="form-floating">
                                        @if ($errors->has('id_empresa'))
                                            <select aria-placeholder="Empresa" id="id_empresa" class="form-select is-invalid"
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
                                            <select aria-placeholder="Empresa" id="id_empresa" class="form-select"
                                                name="id_empresa">
                                                <option value="" selected disabled>Selecione...</option>
                                                @foreach ($empresas as $cmp)
                                                    <option value="{{ $cmp->id }}">{{ $cmp->razao_social }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <label for="id_marca">Empresa</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12  p-2">
                                    <div class="form-floating">
                                        @if ($errors->has('vl_peca'))
                                            <input aria-describedby="invalid-feedback" class="form-control is-invalid"
                                                type="number" step="0.01" name="vl_peca" id="vl_peca" placeholder="Valor"
                                                value="{{ old('vl_peca') }}">
                                            <div class="invalid-feedback">
                                                {{ $errors->first('vl_peca') }}
                                            </div>
                                        @else
                                            <input class="form-control" type="number" step="0.01" name="vl_peca"
                                                id="vl_peca" placeholder="Valor" value="{{ old('vl_peca') }}">
                                        @endif
                                        <label for="vl_peca">Valor</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 p-2">
                                    <div class="form-floating">
                                        @if ($errors->has('qt_estoque'))
                                            <input class="form-control is-invalid" type="number" name="qt_estoque"
                                                id="qt_estoque" placeholder="Estoque" value="{{ old('qt_estoque') }}">
                                            <div class="invalid-feedback">
                                                {{ $errors->first('qt_estoque') }}
                                            </div>
                                        @else
                                            <input class="form-control" type="number" name="qt_estoque" id="qt_estoque"
                                                placeholder="Estoque" value="{{ old('qt_estoque') }}">
                                        @endif
                                        <label for="qt_estoque">Estoque</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 p-2">
                                    <div class="form-floating">
                                        @if ($errors->has('id_tipo_peca'))
                                            <select aria-placeholder="Tipo peça" id="id_tipo_peca"
                                                class="form-select is-invalid" name="id_tipo_peca"
                                                value="{{ old('id_tipo_peca') }}">
                                                <option value=""
                                                    selected="{{ old('id_tipo_peca') != null ? false : true }}" disabled>
                                                    Selecione...</option>
                                                @foreach ($tipos as $tp)
                                                    @if ($tp->id == old('id_tipo_peca'))
                                                        <option selected value="{{ $tp->id }}">{{ $tp->nm_tipo }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $tp->id }}">{{ $tp->nm_tipo }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('id_tipo_peca') }}
                                            </div>
                                        @else
                                            <select aria-placeholder="Tipo peça" id="id_tipo_peca" class="form-select"
                                                name="id_tipo_peca">
                                                <option value="" selected disabled>Selecione...</option>
                                                @foreach ($tipos as $tp)
                                                    <option value="{{ $tp->id }}">{{ $tp->nm_tipo }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <label for="id_tipo_peca">Tipo peça</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 p-2">
                                    <div class="form-floating">
                                        @if ($errors->has('ds_peca'))
                                        <textarea class="form-control is-invalid" maxlength="500" style="height: 12.6rem" name="ds_peca" id="ds_peca">{{old('ds_peca')}}</textarea>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('ds_peca') }}
                                        </div>
                                        @else
                                        <textarea class="form-control" maxlength="500" style="height: 12.6rem" name="ds_peca" id="ds_peca">{{(old('ds_peca'))}}</textarea>
                                        @endif
                                        <label for="ds_peca">Descrição da peça</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 p-2">
                                    <div class="card p-2" style="height: 12.6rem">
                                    <label for="carros">Carros Compatíveis</label>
                                    <div class="form-floating">
                                        <select aria-placeholder="Carros Compatíveis" style="height: 10rem;" id="carros"
                                            class="form-select p-0" name="carros[]" multiple
                                            aria-label="multiple select example">
                                            @foreach ($carros as $c)
                                                <option value="{{ $c->id }}">{{ $c->nm_carro }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 text-end">
                        <input class="btn btn-success" type="submit" value="Salvar">
                        <a href="/pecas">
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
