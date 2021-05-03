<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bootstrap Builder</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap_custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}"/>
    @hasSection('css_block')
        @yield('css_block')
    @endif
</head>
<body>
<header class="main_header">
    <div class="header_bar bg-front">
        <div class="container">
            <div class="row justify-content-around">
                <div class="d-none d-lg-flex col-lg-4  justify-content-center align-items-center p-2 text-white">
                    <i class="icon-location-arrow"></i>
                    <p class="my-auto ml-3">Rua Lorem Ipsum, 00 <br/> Cidade/PR</p>
                </div>
                <div class="d-none d-md-flex col-md-6 col-lg-4 justify-content-center align-items-center p-2 text-white">
                    <i class="icon-clock-o"></i>
                    <p class="my-auto ml-3">Seg/Sex: 9:00 - 18:00<br/> Sáb/Dom: Plantão</p>
                </div>
                <div class="d-flex  col-4 col-md-6 col-lg-4 justify-content-center align-items-center p-2 text-white">
                    <i class="icon-envelope"></i>
                    <p class="my-auto ml-3">lorem@exemple.com <br/> +55 (41) 9 9999-9999</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light my-3">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ route('web.home') }}">
                    <h1 class="text-hide">Imobiliária</h1>
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" class="d-inline-block" style="width: 280px">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('web.home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-front" href="javascript:void(0)">Destaque</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('web.rent') }}">Alugar</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('web.buy') }}">Comprar</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('web.contact') }}">Contato</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

@yield('content')

<section>
    <article class="main_optin bg-dark text-white py-5">
        <div class="container">
            <div class="row mx-auto" style="max-width: 600px">
                <div class="col-12">
                    <h1>Quer ficar por dentro das novidades?</h1>
                    <p>Deixe o seu nome e seu melhor e-mail nos campos abaixo e nós vamos le informar os melhores negócios todos os lançamentos do sul da ilha </p>
                    <form action="">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Digite o seu nome" size="50">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Digite o seu email" size="50">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-front">Me avise!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </article>
</section>

<section class="main_footer bg-light" style="background: url('assets/images/footer.png') repeat-x bottom center; background-size: 10%">
    <div class="container  pt-5" style="padding-bottom: 120px">
        <div class="row justify-content-around text-muted">
            <div class="col-12 col-sm-6 col-md-3 col-lg-3 ">
                <h1 class=pb-3">Navegue <span class="text-front">aqui</span></h1>
                <ul>
                    <li><a href="{{ route('web.home') }}">Home</a></li>
                    <li><a href="#" class="text-front">Destaque</a></li>
                    <li><a href="#">{{ route('web.rent') }}Alugar</a></li>
                    <li><a href="#">{{ route('web.buy') }}</a></li>
                    <li><a href="{{ route('web.contact') }}">Contato</a></li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-md-9 col-lg-6">
                <h1 class=pb-3">Nos <span class="text-front">Conheça!</span></h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto dolorum itaque odio ratione vel. Suscipit? </p>

                <h1 class="pb-3">Quer <span class="text-front">Investir?</span></h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab et magni numquam quae quidem? Quibusdam. </p>

            </div>
            <div class="col-12 col-lg-3 text-center mt-5">
                <a href="#" class="btn btn-front icon-facebook icon-notext"></a>
                <a href="#" class="btn btn-front icon-twitter icon-notext"></a>
                <a href="#" class="btn btn-front icon-instagram icon-notext"></a>
            </div>
        </div>
    </div>
</section>

<div class="main_copyright bg-front text-white text-center">
    <div class="container py-5">
        <p class="mb-0">Imobiliária | CRECI 1234 | Rua lorem Ipsum, 0 - Cidade/Estado</p>
        <p class="mb-0">todos os Direitos Reservados ®</p>
    </div>
</div>


<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-select-defaults-pt_BR.min.js') }}"></script>


@hasSection('js_block')
    @yield('js_block')
@endif

</body>
</html>
