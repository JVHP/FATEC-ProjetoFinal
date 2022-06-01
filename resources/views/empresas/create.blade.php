@extends('master')

@section('body')
    <div class="col-12 pt-5" style="height: 100vh;">
        <div class="card-display border-bottom-orange">
            <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2">
                Cadastro Empresarial
            </h1>
            <div class="card-body">
                {{-- <div class="card-title mb-0">
                </div> --}}
                <form class="" action="/empresas" name="cadastro" method="POST">
                    <div class="row col-12">
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
                                    <input  data-mask="00.00.00" data-mask-selectonfocus="true"  type="text" class="form-control" maxlength="14" id="cnpj" name="cnpj"
                                        placeholder="CNPJ" value="{{ old('cnpj') }}" />
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
                                    <input type="text" class="form-control" maxlength="14" id="razao_social" name="razao_social"
                                        placeholder="Razão Social" value="{{ old('razao_social') }}" />
                                @endif
                                <label for="razao_social">Razão Social<b class="text-danger">*</b></label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="form-floating p-1">
                                @if (isset($errors) && $errors->has('url_customizada'))
                                    <input type="text" class="form-control is-invalid" maxlength="20" id="url_customizada" name="url_customizada"
                                        placeholder="CPF" value="{{ old('url_customizada') }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('url_customizada') }}
                                    </div>
                                @else
                                    <input type="text" class="form-control" maxlength="20" id="url_customizada" name="url_customizada"
                                        placeholder="CPF" value="{{ old('url_customizada') }}" />
                                @endif
                                <label for="url_customizada">Código URL<b class="text-danger">*</b></label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-end p-3 mx-auto">
                            <button type="submit" for="cadastro" class="btn btn-primary"> Cadastrar </button>
                        </div>
                </form>
            </div>
        </div>
    @endsection

    <script></script>
