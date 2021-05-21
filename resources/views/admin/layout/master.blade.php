<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/reset.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/libs.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/boot.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('backend/assets/images/favicon.png') }}"/>

    @hasSection('css_block')
        @yield('css_block')
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>Admin - Site Control</title>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<div class="ajax_response"></div>

@php
    $userName = auth()->user()->name;
    if (!!auth()->user()->cover) {
        $cover = auth()->user()->url_cover;
    } else {
        $cover = '/backend/assets/images/avatar.jpg';
    }
@endphp

<div class="dash">
    <aside class="dash_sidebar">
        <article class="dash_sidebar_user">
            <img class="dash_sidebar_user_thumb" src="{{ url($cover) }}" alt="" title=""/>

            <h1 class="dash_sidebar_user_name">
                <a href="{{ route('admin.users.edit',auth()->user()->id),false }}">{{ $userName }}</a>
            </h1>
        </article>

        <ul class="dash_sidebar_nav">
            <li class="dash_sidebar_nav_item {{ isActive('admin.home') }}">
                <a class="icon-tachometer" href="{{ route('admin.home') }}">Dashboard</a>
            </li>
            <li class="dash_sidebar_nav_item {{ isActive('admin.users') }}{{ isActive('admin.companies') }}">
                <a class="icon-users" href="{{ route('admin.users.index') }}">Clientes</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class="{{ isActive('admin.users.index') }}"><a href="{{ route('admin.users.index') }}">Ver Todos</a></li>
                    <li class="{{ isActive('admin.companies.index') }}"><a href="{{ route('admin.companies.index') }}">Empresas</a></li>
                    <li class="{{ isActive('admin.users.team') }}"><a href="{{ route('admin.users.team') }}">Time</a></li>
                    <li class="{{ isActive('admin.users.create') }}"><a href="{{ route('admin.users.create') }}">Criar Novo</a></li>
                </ul>
            </li>
            <li class="dash_sidebar_nav_item {{ isActive('admin.properties') }}" >
                <a class="icon-home" href="{{ route('admin.properties.index') }}">Imóveis</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class="{{ isActive('admin.properties.index') }}"><a href="{{ route('admin.properties.index') }}">Ver Todos</a></li>
                    <li class="{{ isActive('admin.properties.create') }}"><a href="{{ route('admin.properties.create') }}">Criar Novo</a></li>
                </ul>
            </li>
            <li class="dash_sidebar_nav_item {{ isActive('admin.contracts') }}" >
                <a class="icon-file-text" href="{{ route('admin.contracts.index') }}">Contratos</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class="{{ isActive('admin.contracts.index') }}"><a href="{{ route('admin.contracts.index') }}">Ver Todos</a></li>
                    <li class="{{ isActive('admin.contracts.create') }}"><a href="{{ route('admin.contracts.create') }}">Criar Novo</a></li>
                </ul>
            </li>
            <li class="dash_sidebar_nav_item {{ isActive('admin.contracts') }}" >
                <a class="icon-cogs" href="{{ route('admin.contracts.index') }}">Configurações</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class="{{ isActive('admin.permission.index') }}"><a href="{{ route('admin.permission.index') }}">Permissões</a></li>
                    <li class="{{ isActive('admin.role.index') }}"><a href="{{ route('admin.role.index') }}">Perfis</a></li>
                </ul>
            </li>
            <li class="dash_sidebar_nav_item"><a class="icon-reply" href="{{ route('web.home') }}" target="_blank">Ver Site</a></li>
            <li class="dash_sidebar_nav_item"><a class="icon-sign-out on_mobile" href="{{ route('admin.logout') }}" target="_blank">Sair</a></li>
        </ul>

    </aside>

    <section class="dash_content">

        <div class="dash_userbar">
            <div class="dash_userbar_box">
                <div class="dash_userbar_box_content">
                    <span class="icon-align-justify icon-notext mobile_menu transition btn btn-green"></span>
                    <h1 class="transition">
                        <i class="icon-imob text-orange"></i><a href="">Up<b>Admin</b></a>
                    </h1>
                    <div class="dash_userbar_box_bar no_mobile">
                        <a class="text-red icon-sign-out" href="{{ route('admin.logout') }}">Sair</a>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            @foreach($errors->all() as $message)
                <x-messages-error type="error" :message="$message" class="mt-4"/>
            @endforeach
        @endif

        @if (session()->exists('message'))
            <x-flash-message :message="session()->get('message')" class="mt-4"></x-flash-message>
        @endif

        <div class="dash_content_box">
{{--            @include('flash-message')--}}
            @yield('content')
        </div>
    </section>
</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/libs.js') }}"></script>
<script src="{{ asset('backend/assets/js/scripts.js') }}"></script>

@hasSection('js_block')
    @yield('js_block')
@endif
</body>
</html>
