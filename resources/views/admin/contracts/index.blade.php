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
                        <li><a href="{{ route('admin.contracts.index') }}">Contratos</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                    </ul>
                </nav>

                <a href="{{ route('admin.contracts.create') }}" class="btn btn-orange icon-file-text ml-1">Criar Contrato</a>
                <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>
            </div>
        </header>
        @include('admin.contracts.filter')
        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <table id="dataTable" class="nowrap hover stripe" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Locador</th>
                        <th>Locatário</th>
                        <th>Negócio</th>
                        <th>Início</th>
                        <th>Vigência</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contracts as $contract)
                        <tr>
                            <td>
                                <a href="{{ route('admin.contracts.edit', $contract->id) }}" class="text-orange">{{ $contract->id }}</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit',$contract->owner->id ) }}" class="text-orange" target="_blank">
                                {{ $contract->owner->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit',$contract->acquirer->id ) }}" class="text-orange" target="_blank">
                                {{ $contract->acquirer->name }}
                                </a>
                            </td>
                            <td>{{ $contract->sale?'Venda':'Locação' }}</td>
                            <td>{{ $contract->start_at }}</td>
                            <td>{{ $contract->dateline }}</td>
                            <td>
                                <a href="{{ route('admin.contracts.edit', $contract->id) }}" class="btn btn-small btn-green">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
