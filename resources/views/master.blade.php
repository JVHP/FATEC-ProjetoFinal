<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->

    <title>iTURBO</title>

    <script src="https://kit.fontawesome.com/dce65dbbad.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/png" href="{{ URL::asset('images/turbo1.webp') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        import "bootstrap-icons/font/bootstrap-icons.css"
        import * as $ from 'igorescobar/jquery-mask-plugin'

        var offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'))
        var offcanvasList = offcanvasElementList.map(function(offcanvasEl) {
            return new bootstrap.Offcanvas(offcanvasEl)
        })
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <style>
        @import '/css/app-base.css';
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css");
    </style>
</head>

<body class="">
    <!-- NAVBAR-CIMA -->

    <div class="p-3">
        <div class="mx-auto container-xxl">
            <div class="row col-12 m-0">
                <div class="col-lg-1 col-md-1 col-sm-1 col-1 y-auto ps-4 my-auto ">
                    <button class="btn" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                        <img src="{{ URL::asset('icons/menu.svg') }}" alt="">
                    </button>
                </div>

                <div
                    class="col-lg-auto col-md-3 col-sm-4 col-6 pb-3 my-auto text-md-start text-center me-md-auto mx-md-0 mx-auto">
                    <h3 style="cursor: pointer" class="pt-4 fw-bold text-light onhov" onclick="window.location='/'">
                        iTURBO
                    </h3>
                </div>

                <div class="form-group col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 my-auto">
                    <input list="pecasList" oninput="getPecas(event.target.value)" id="inputPeca"
                        class=" card-search rounded-pill form-control" type="text"
                        style="height: 50px; /* border: 2px solid #334756; border-radius: 5px; */"
                        placeholder="Pesquisar...">

                    <datalist id="pecasList" onclick="irParaPeca(event.target.value)">
                    </datalist>
                </div>

                <div class="text-end col-xxl-2-custom col-lg-3 col-md-4 col-12 pt-md-0 pt-3 my-auto mx-md-0 mx-auto ">
                    <div>
                        <div class="card-login rounded-pill">
                            @guest
                                <div class="row col-12 justify-content-center" style="height: 50px;">
                                    @if (Route::has('login'))
                                        <div class="col-4">
                                            <div class="rounded-circle image-circle not-logged">
                                            </div>
                                        </div>
                                        <div class="col-8 my-auto text-start ps-0">
                                            <a class="text-light" href="/login">Faça seu {{ __('login') }} ou
                                                {{ __('cadastre-se') }}</a>
                                        </div>
                                    @endif

                                    @if (Route::has('register'))
                                        {{-- <div class="col-5 my-auto">
                                            <a class="text-light " href="/cadastrar">{{ __('Cadastrar') }}</a>
                                        </div> --}}
                                    @endif
                                </div>
                            @else
                                <div class="row ">
                                    <div class="col-md-3 col-sm-1 col-2 me-md-2 me-3 ">
                                        <a href="/dashboard">
                                            <div class="rounded-circle image-circle logged">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-8 text-start ps-0 text-truncate">
                                        <div class="col-12">
                                            <a class="text-light py-1 my-2" href="/dashboard">
                                                <label for="" class="text-light">
                                                    Bem vindo {{ Auth::user()->firstName() }}!
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-12 text-start">
                                            <a href="{{ route('informacoes') }}" class="text-light py-1 me-1 my-2">
                                                <img src="{{ URL::asset('icons/settings.svg') }}" alt="">
                                            </a>
                                            <a href="{{ route('dashboard') }}" class="text-light py-1 me-2 my-2">
                                                <img src="{{ URL::asset('icons/shopping-cart.svg') }}" alt="">
                                            </a>
                                            <a href="{{ route('logout') }}" class="text-light py-1 my-2"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <img src="{{ URL::asset('icons/log-out.svg') }}" alt="">
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MENU LATERAL -->

    <div class="offcanvas offcanvas-start bg-primary-dark-opaque" data-bs-scroll="true" tabindex="-1"
        id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header pt-3">
            <h5 class="offcanvas-title text-white" id="offcanvasWithBothOptionsLabel">Menu</h5>
            <button type="button" class="btn-close  btn-close-white text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <!-- <p>Aqui vão ficar as listas de item por categoria</p> -->
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @guest
                @else
                    @if (Auth::user()->isAdministrator())
                        <div class="accordion-item" style="border-radius: none; border: none">
                            <h2 class="accordion-header" id="flush-headingUsuarios">
                                <button class="accordion-button collapsed bg-orange" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseUsuarios" aria-expanded="false"
                                    aria-controls="flush-collapseUsuarios">
                                    Usuários
                                </button>
                            </h2>
                            <div id="flush-collapseUsuarios" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingUsuarios" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body p-0">
                                    <a href="/usuarios">
                                        <button
                                            class="accordion-button accordion-button-remove-i bg-primary-dark collapsed ps-5 text-white">
                                            Gerenciar Usuários
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" style="border-radius: none; border: none">
                            <h2 class="accordion-header" id="flush-headingMarcas">
                                <button class="accordion-button collapsed bg-orange" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseMarcas" aria-expanded="false"
                                    aria-controls="flush-collapseMarcas">
                                    Marcas
                                </button>
                            </h2>
                            <div id="flush-collapseMarcas" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingMarcas" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body p-0">
                                    <a href="/marcas">
                                        <button
                                            class="accordion-button accordion-button-remove-i bg-primary-dark collapsed ps-5 text-white">
                                            Gerenciar Marcas
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endguest
                <div class="accordion-item" style="border-radius: none; border: none">
                    <h2 class="accordion-header" id="flush-headingPecas">
                        <button class="accordion-button collapsed bg-orange" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapsePecas" aria-expanded="false" aria-controls="flush-collapsePecas">
                            Peças
                        </button>
                    </h2>
                    <div id="flush-collapsePecas" class="accordion-collapse collapse" aria-labelledby="flush-headingPecas"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body p-0">
                            <a href="/pecas/todos">
                                <button
                                    class="accordion-button accordion-button-remove-i bg-primary-dark collapsed ps-5 text-white">
                                    Todas Peças
                                </button>
                            </a>
                            @guest
                            </div>
                        </div>
                    @else
                        @if (!Auth::user()->isAdministrator())
                        <a href="/pecas-usuario">
                            <button
                                class="accordion-button accordion-button-remove-i bg-primary-dark collapsed ps-5 text-white">
                                Peças para seu(s) carro(s)
                            </button>
                        </a>
                        @elseif (Auth::user()->isAdministrator())
                            <a href="/pecas">
                                <button
                                    class="accordion-button accordion-button-remove-i bg-primary-dark collapsed ps-5 text-white">
                                    Gerenciar Peças
                                </button>
                            </a>
                            <a href="/tipospeca">
                                <button
                                    class="accordion-button accordion-button-remove-i bg-primary-dark collapsed ps-5 text-white">
                                    Gerenciar Tipos de Peça
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
            @endguest
        </div>
        @guest
        @else
            @if (Auth::user()->isAdministrator())
                <div class="accordion-item" style="border-radius: 0; border: none">
                    <h2 class="accordion-header" id="flush-headingCarros">
                        <button class="accordion-button collapsed bg-orange " type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseCarros" aria-expanded="false" aria-controls="flush-collapseCarros">
                            Carros
                        </button>
                    </h2>
                    <div id="flush-collapseCarros" class="accordion-collapse collapse" aria-labelledby="flush-headingCarros"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body p-0">
                            <a href="/carros">
                                <button
                                    class="accordion-button accordion-button-remove-i collapsed bg-primary-dark ps-5 text-white">
                                    Gerenciar Carros
                                </button>
                            </a>
                            <a href="/tiposcarro">
                                <button
                                    class="accordion-button accordion-button-remove-i collapsed bg-primary-dark ps-5 text-white">
                                    Gerenciar Tipos de Carro
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endguest
    </div>
    </div>
    </div>

    @yield('banner')
    <div class="container-xxl pt-5">
        @yield('body')
    </div>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="/js/register-user/register-user.js">
</script>
<script src="/js/master/datalist.js">
</script>

<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        autoplayHoverPause: true,
        stagePadding: 50,
        margin: 15,
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 3000,
        nav: false,
        drag: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: false
            },
            600: {
                items: 3,
                nav: false,
                loop: false
            },
            1000: {
                items: 4.25,
                nav: false,
                loop: false
            }
        }
    })

    //Função para tamanho de descrições
    function modificarTamanho(event) {
        let element = event.srcElement;
        element.classList.toggle('text-truncate');
    }

</script>
