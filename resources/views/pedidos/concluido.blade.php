@extends('master')

@section("body")

<div class="card-display border-bottom-orange" >
    <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Pagamento - {{$message['titulo']}}</h2>
    <div class="card-body  p-3">
        <div>
            <h2 class="text-center">{{$message['corpo']}}</h2>
        </div>
        <div>
        </div>
    </div>
</div>

@endsection

