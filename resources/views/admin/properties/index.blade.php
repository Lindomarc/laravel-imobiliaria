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
                        <li><a href="{{ route('admin.properties.index') }}">Imóveis</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                    </ul>
                </nav>

                <a href="{{ route('admin.properties.create') }}" class="btn btn-orange icon-home ml-1">Criar Imóvel</a>
                <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>
            </div>
        </header>

        @include('admin.properties.filter')

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <div class="realty_list">
                    @if (!!count($properties))
                        @foreach($properties as $item)

                            <div class="realty_list_item mb-1">
                                <div class="realty_list_item_actions_stats">
                                    <img src="{{ $item->default_cover }}" alt="">
                                    <ul>
                                        @if (!!$item->sale && !!$item->sale_price)
                                            <li>Venda: R$ {{ $item->sale_price }}</li>
                                        @endif
                                        @if (!!$item->rent && !!$item->rent_price)
                                            <li>Aluguel: R$ {{$item->rent_price }}</li>
                                        @endif

                                    </ul>
                                </div>
                                <div class="realty_list_item_content">
                                    <h4>{{ $list_category[$item->category] }} - {{ $list_type_simple[$item->type] }}</h4>

                                    <div class="realty_list_item_card">
                                        <div class="realty_list_item_card_image">
                                            <span class="icon-realty-location"></span>
                                        </div>
                                        <div class="realty_list_item_card_content">
                                            <span class="realty_list_item_description_title">Bairro:</span>
                                            <span class="realty_list_item_description_content">{{ $item->neighborhood }}</span>
                                        </div>
                                    </div>

                                    <div class="realty_list_item_card">
                                        <div class="realty_list_item_card_image">
                                            <span class="icon-realty-util-area"></span>
                                        </div>
                                        <div class="realty_list_item_card_content">
                                            <span class="realty_list_item_description_title">Área Útil:</span>
                                            <span class="realty_list_item_description_content">{{ $item->area_util }}m&sup2;</span>
                                        </div>
                                    </div>

                                    <div class="realty_list_item_card">
                                        <div class="realty_list_item_card_image">
                                            <span class="icon-realty-bed"></span>
                                        </div>
                                        <div class="realty_list_item_card_content">
                                            <span class="realty_list_item_description_title">Domitórios:</span>
                                            <span class="realty_list_item_description_content">{{ $item->bedrooms + $item->suites }} Quartos<br>
                                                                    @if (!!$item->suites)
                                                    <span>Sendo {{ $item->suites }} suítes</span></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="realty_list_item_card">
                                        <div class="realty_list_item_card_image">
                                            <span class="icon-realty-garage"></span>
                                        </div>
                                        <div class="realty_list_item_card_content">
                                            <span class="realty_list_item_description_title">Garagem:</span>
                                            <span class="realty_list_item_description_content">{{ $item->garage }} Vagas<br>
                                                                    @if(!!$item->garage_covered)
                                                    <span>Sendo {{ $item->garage_covered }} cobertas</span>
                                                @endif
                                                                </span>
                                        </div>
                                    </div>

                                </div>

                                <div class="realty_list_item_actions">
                                    <ul>
                                        <li class="icon-eye">{{ $item->views }} Visualizações</li>
                                    </ul>
                                    <div>
                                        @if ($item->sale)
                                            <a href="{{ route('web.saleProperty',['slug'=> $item->slug], false) }}" class="btn btn-blue icon-eye" target="_blank">Visualizar Imóvel (Comprar)</a>
                                        @endif
                                        @if ($item->rent)
                                            <a href="{{ route('web.rentProperty',['slug'=> $item->slug], false) }}" class="btn btn-blue icon-eye" target="_blank">Visualizar Imóvel (Alugar)</a>
                                        @endif
                                        <a href="{{ route('admin.properties.edit',['property'=> $item->id]) }}" class="btn btn-green icon-pencil-square-o">Editar Imóvel</a>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @else
                        <div class="no-content">Não foram encontrados registros!</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
