<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
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