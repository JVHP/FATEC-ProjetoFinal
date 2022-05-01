@extends('master')

@section("body")
<div class="col-lg-5 col-md-7 col-sm-8 col-12 mx-auto pt-5 pb-5">
    <div class="card">
        <div class="card-title">
            <h1 class="text-center">Parabéns! Seu Pedido foi Finalizado</h1>
        </div>
        <div class="card-body">
            <h3 class="text-center">Agora é só pagar seu "PIX", ou copiar o link no seu navegador!</h3>
        </div>
        <img class="mx-auto" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http://{{$_SERVER['HTTP_HOST']}}/pedido/pagar/concluir/{{$pedido->id}}" title="Link to Google.com" width="300px" />
        <p class="mx-auto">
            http://{{$_SERVER['HTTP_HOST']}}/pedido/pagar/concluir/{{$pedido->id}}
        </p>

    </div>
</div>
@endsection