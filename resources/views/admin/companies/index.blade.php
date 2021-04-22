@extends('admin.layout.master')
@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-search">Filtro</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.users.index') }}">Clientes</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.companies.index') }}">Empresas</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="" class="text-orange">Filtro</a></li>
                    </ul>
                </nav>

                <a href="{{ route('admin.companies.create') }}" class="btn btn-orange icon-building-o ml-1">Criar Empresa</a>
                <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>
            </div>
        </header>

        @include('admin.companies.filter')

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <table id="dataTable" class="nowrap hover stripe" width="100" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>Razão Social</th>
                        <th>Nome Fantasia</th>
                        <th>CNPJ</th>
                        <th>IE</th>
                        <th>Responsável</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>
                                <a href="{{ route('admin.companies.edit',$result->id) }}" class="text-orange">{{ $result->social_name }}</a>
                            </td>
                            <td>{{ $result->social_name }}</td>
                            <td>{{ mask($result->document_company,'##.###.###/####-##') }}</td>
                            <td>{{ $result->document_company_secondary }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit',$result->user_id) }}" class="text-orange">{{ $result->user()->first()['name']  }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
