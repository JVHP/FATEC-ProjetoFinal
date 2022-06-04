<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
    <nav style="--bs-breadcrumb-divider: '>';"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($paginas as $pag => $val)
                @if($loop->index < sizeOf($paginas) - 1)
                    <li class="breadcrumb-item"><a class="text-white" href="{{$val['link']}}">{{$val['nm_pag']}}</a></li>
                @else
                    <li class="breadcrumb-item active" style="color: #FF4C29" aria-current="page">{{$val['nm_pag']}}</li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>