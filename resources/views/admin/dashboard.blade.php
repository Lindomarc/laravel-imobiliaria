@extends('admin.layout.master')
@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Dashboard</h2>
            </header>

            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="control radius">
                        <h4 class="icon-users">Clientes</h4>
                        <p><b>Locadores:</b> {{ $lessors }}</p>
                        <p><b>Locatários:</b> {{ $lessees }}</p>
                        <p><b>Time:</b> {{ $team }}</p>
                    </article>

                    <article class="blog radius">
                        <h4 class="icon-home">Imóveis</h4>
                        <p><b>Disponíveis:</b> {{ $propertyAvailable }}</p>
                        <p><b>Locados:</b> {{ $propertyUnavailable }}</p>
                        <p><b>Total:</b> {{ $propertyTotal }}</p>
                    </article>

                    <article class="users radius">
                        <h4 class="icon-file-text">Contratos</h4>
                        <p><b>Pendentes:</b> {{ $contractsPending }}</p>
                        <p><b>Ativos:</b> {{ $contractsActive }}</p>
                        <p><b>Cancelados:</b> {{ $contractsCanceled }}</p>
                        <p><b>Total:</b> {{ $contractsTotal }}</p>

                    </article>
                </section>
            </div>
        </section>

        <section class="dash_content_app" style="margin-top: 40px;">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Últimos Contratos Cadastrados</h2>
            </header>

            <div class="dash_content_app_box">
                <div class="dash_content_app_box_stage">
                    <table id="dataTable" class="nowrap hover stripe" width="100" style="width: 100% !important;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Locador</th>
                            <th>Locatário</th>
                            <th>Negócio</th>
                            <th>Início</th>
                            <th>Vigência</th>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="dash_content_app" style="margin-top: 40px;">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Últimos Imóveis Cadastrados</h2>
            </header>

            <div class="dash_content_app_box">
                <div class="dash_content_app_box_stage">
                    <div class="realty_list">
                            @foreach($properties as $item)

                                <div class="realty_list_item mb-1">
                                    <div class="realty_list_item_actions_stats">
                                        <img src="{{ $item->default_cover }}" alt="">
                                        <ul>
                                            <li>Venda: R$ {{ $item->sale_price }}</li>
                                            <li>Aluguel: R$ {{$item->rent_price }}</li>
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
                                            <a href="{{ route('admin.properties.show',['property'=> $item->id]) }}" class="btn btn-blue icon-eye">Visualizar Imóvel</a>
                                            <a href="{{ route('admin.properties.edit',['property'=> $item->id]) }}" class="btn btn-green icon-pencil-square-o">Editar Imóvel</a>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
