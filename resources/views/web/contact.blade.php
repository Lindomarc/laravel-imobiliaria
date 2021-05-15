@extends('web.layout.master')
@section('content')
    <div class="main_contact bg-light py-5  text-center ">
        <div class="container">
            <h1 class="text-front font-weight-bold">Entre em Contato Conosco</h1>
            <p class="mb-0">Quer conversar com um corretor exclusivo e ter o atentimento diferenciado em busca do seu imóvel dos sonhos?</p>
            <p class="">Preencha o formulário abaixo e vamos direcionalo para alguem que atende a sua necessidade!</p>
            <div class="row justify-content-center">

                <form action="{{ route('web.sendEmail', null, false) }}" method="post" class="bg-white m-5 p-3">
                    @csrf
                    <h2 class="text-muted text-left"><i class="icon-envelope"></i>Envie um e-mail</h2>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Insira seu nome">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Insira seu melhor e-mail">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" name="phone" placeholder="Insira seu telefone com DDD...">
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Escreva sua mensagem" class="form-control"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-front">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="main_contact_type py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-md-4">
                    <h2 class="text-muted"><i class="icon-envelope"></i>Por Email</h2>
                    <p>Nossos atendentes irão entrar em contato com você assim que possível</p>
                    <p class="pt-2"><a href="mailto:contato@exemple.com" target="_blank" class="text-front">contato@exemple.com</a></p>
                </div>
                <div class="col-12 col-md-4">
                    <h2 class="text-muted"><i class="icon-phone"></i>Por Telefone</h2>
                    <p>Estamos disponíveis nos números abaixo no horário comercial.</p>
                    <p class="pt-2 text-front">+55 (99) 9999-9999</p>
                </div>
                <div class="col-12 col-md-4">
                    <h2 class="text-muted"><i class="icon-share-alt"></i>Por Email</h2>
                    <p class="pt-2">fique por dentro de tudo o que a gente compartilha em redes sociais!</p>
                    <div>
                        <a href="#" class="btn btn-front icon-facebook icon-notext"></a>
                        <a href="#" class="btn btn-front icon-twitter icon-notext"></a>
                        <a href="#" class="btn btn-front icon-instagram icon-notext"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
