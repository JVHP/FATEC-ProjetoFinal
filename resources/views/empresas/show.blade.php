@extends('master')

@section('body')
    @php
    $paginas = collect([['link' => '/', 'nm_pag' => 'Dashboard'], ['link' => '/filiais', 'nm_pag' => 'Filiais'], ['link' => '', 'nm_pag' => 'Visualizar Filial']])->collect();
    @endphp

    <x-breadcrumb :paginas="$paginas" />

    <div class="col-12" style="height: 100vh;">
        <div class="card-display border-bottom-orange">
            <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2">
                Visualizar Filial
            </h1>
            <div class="p-2">
                <div class="card p-3">
                    <h3>
                        Informações gerais
                    </h3>
                    <div class="row col-12">

                        <dd class="col-md-4 col-12 h5">CNPJ: <p class="fw-bolder">{{ $empresa->cnpj_mascara }}</p>
                        </dd>
                        <dd class="col-md-4 col-12 h5">Razão Social: <p class="fw-bolder">{{ $empresa->razao_social }}</p>
                        </dd>
                        <dd class="col-md-4 col-12 h5 link">Link:
                            <p class="fw-bolder">
                                <a href="{{ $empresa->gerarLink() }}">{{ $empresa->gerarLink() }}</a>
                            </p>
                        </dd>
                    </div>
                </div>
                <div class="card p-3 mt-3">
                    
                    @if ($faturamento->total_pedidos != 0)
                    <h3>
                        Pedidos
                    </h3>
                        <div class="row col-12 justify-content-evenly">
                            <div class="col-md-8 col-12 my-auto text-center">
                                <div class="text-start">
                                    <dl class="">
                                        <dd class="h5">Total em pedidos:
                                            <span class="fw-bolder">
                                                R$ {{ $faturamento->formatarValor($faturamento->total_pedidos) }}
                                            </span>
                                        </dd>
                                        <dd class="h5">Total concluídos: <span class="fw-bolder">
                                                R$ {{ $faturamento->formatarValor($faturamento->total_concluido) }}
                                            </span>
                                        </dd>
                                        <dd class="h5">Total cancelados:
                                            <span class="fw-bolder">
                                                R$ {{ $faturamento->formatarValor($faturamento->total_cancelado) }}</span>
                                        <dd class="h5">Total não concluídos:
                                            <span class="fw-bolder">
                                                R$ {{ $faturamento->formatarValor($faturamento->total_nao_finalizados) }}
                                            </span>
                                        <dd class="h5">Parte do iTURBO:
                                            <span class="fw-bolder">
                                                R$ {{ $faturamento->formatarValor($faturamento->total_iturbo) }}
                                            </span>
                                    </dl>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <canvas id="myChart" width="50px" height="50px"></canvas>

                                <script>
                                    const ctx = document.getElementById('myChart').getContext('2d');
                                    const myChart = new Chart(ctx, {
                                        type: 'doughnut',
                                        data: {
                                            labels: ['Pedidos concluídos', 'Pedidos cancelados',
                                                'Pedidos não concluídos', 'iTURBO'
                                            ],
                                            datasets: [{
                                                label: '# of Votes',
                                                data: [{{ $faturamento->porcentagem_concluido }},
                                                    {{ $faturamento->porcentagem_cancelado }},
                                                    {{ $faturamento->porcentagem_nao_finalizados }},
                                                    15
                                                ],
                                                backgroundColor: [
                                                    'rgba(75, 192, 192)',
                                                    'rgba(255, 99, 132)',
                                                    '#ffc107',
                                                    '#334756',
                                                ],
                                                borderColor: [
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(255, 99, 132, 1)',
                                                    '#ffc107',
                                                    '#334756',
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            plugins: {
                                                title: {
                                                    display: true,
                                                    text: 'Porcentagens'
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>

                        </div>
                    @else
                    <div class="row">
                        <img class="col-md-3 col-12 m-md-3 mx-auto" src="{{URL::asset('icons/undraw_not_found_-60-pq.svg')}}" class="img-fluid" alt="" style="width: 21%">
                        
                        <h1  class="col-md-8 col-12 my-auto">
                            <p class="fs-2 fw-normal">Não foram realizados pedidos para esta filial.</p>
                        </h1>

                    </div>
                    @endif

                </div>
            </div>

        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-end p-3 mx-auto">
            <a href="/filiais"><button type="button" class="btn btn-primary">Voltar</button></a>
            <a href="/filiais/{{ $empresa->id }}/edit"><button type="button" class="btn btn-info">Ir para
                    Edição</button></a>
        </div>
    </div>
@endsection

<script></script>
