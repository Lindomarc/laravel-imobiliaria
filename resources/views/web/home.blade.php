@extends('web.layout.master')

@section('content')
    <div class="main_slide d-none d-md-block">
        <div class="container" style="height: 100%">
            <div class="row  align-items-center " style="height: 100%">
                <div class="col-8">
                    <p class="main_slide_content">Encontre o <b>imóvel ideal</b> para você e
                        <b>sua família</b> morar na praia!</p>
                    <a href="#" class="btn btn-front">Quero Alugar</a>
                    <a href="#" class="btn btn-front">Quero Comprar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main_filter">
        <div class="container my-5">
            <div class="row">
                <form action="" class="form-inline w-100">
                    <div class="form-group col-12 col-sm-6 col-lg-3">
                        <label for="search" class="mb-2"><b>Comprar ou Alugar?</b></label>
                        <select class="selectpicker" id="search" name="filter_search" title="Escolha..." data-action="{{ route('component.main-filter.search') }}" data-index="1">
                            <option value="buy">Comprar</option>
                            <option value="rent">Alugar</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-6 col-lg-3">
                        <label for="category" class="mb-2"><b>O que você quer?</b></label>
                        <select class="selectpicker" id="category" name="filter_category" title="Escolha..." data-action="{{ route('component.main-filter.category') }}" data-index="2">
                            <option value="">Imóvel Residencial</option>
                            <option value="">Comercial/Industrial</option>
                            <option value="">Terreno</option>
                        </select>
                    </div>

                    <div class="form-group col-12 col-sm-6 mt-sm-2 mt col-lg-3 mt-lg-0">
                        <label for="type" class="mb-2 d-block"><b>Qual o tipo do imóvel?</b></label>
                        <select class="selectpicker input-large" id="type" name="filter_type" multiple data-actions-box="true" data-action="{{ route('component.main-filter.type') }}" data-index="3">
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-3 mt-lg-0">
                        <label for="search_locale" class="mb-2"><b>Onde você quer?</b></label>
                        <select class="selectpicker" name="filter_neighborhood" id="neighborhood" title="Escolha..." multiple data-actions-box="true" data-action="{{ route('component.main-filter.neighborhood') }}" data-index="4">
                        </select>
                    </div>

                    <div class="col-12 mt-3 form_advanced" style="display: none;">

                        <div class="row">
                            <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-3 mt-lg-0">
                                <label for="bedrooms" class="mb-2"><b>Quartos</b></label>
                                <select class="selectpicker" name="filter_bedrooms" id="bedrooms" title="Escolha..." data-action="{{ route('component.main-filter.bedrooms') }}" data-index="5">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4+</option>
                                </select>
                            </div>

                            <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-3 mt-lg-0">
                                <label for="bedrooms" class="mb-2"><b>Suítes</b></label>
                                <select class="selectpicker" name="filter_suites" id="suites" title="Escolha..." data-index="6">
                                    <option value="">0</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4+</option>
                                </select>
                            </div>

                            <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-3 mt-lg-0">
                                <label for="bedrooms" class="mb-2"><b>Banheiros</b></label>
                                <select class="selectpicker" name="filter_bathrooms" id="bathrooms" title="Escolha..." data-index="7">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4+</option>
                                </select>
                            </div>

                            <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-3 mt-lg-0">
                                <label for="bedrooms" class="mb-2"><b>Garagem</b></label>
                                <select class="selectpicker" name="filter_garage" id="garage" title="Escolha..." data-index="8">
                                    <option value="">0</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4+</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-6 mt-lg-0">
                                <label for="bedrooms" class="mb-2"><b>Preço Base</b></label>
                                <select class="selectpicker" name="filter_base" id="base" title="Escolha..." data-index="9">
                                    <option value="">A partir de R$ 100.000,00</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4+</option>
                                </select>
                            </div>

                            <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-6 mt-lg-0">
                                <label for="bedrooms" class="mb-2"><b>Preço Limite</b></label>
                                <select class="selectpicker" name="filter_limit" id="limit" title="Escolha..." data-index="10">
                                    <option value="">Até R$ 1.000.000,00</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4+</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 mt-3">
                        <a href="" class="text-front open_filter">Filtro avançado &downarrow;</a>
                    </div>

                    <div class="col-6 text-right mt-3 button_search">
                        <button class="btn btn-front icon-search">Pesquisar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section class="main_list_group">
        <div class="bg-light py-5">
            <div class="container">
                <div class="p-4 border-bottom border-front">
                    <h1 class="text-center">Ambiente no seu <span class="text-front">estilo</span></h1>
                    <p class="text-center text-muted h4">Encontre um imóvel com a experiência que você quer viver</p>
                </div>
                <div class="main_list_group_items">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <article class=" main_list_group_item pt-4">
                                <a href="#">
                                    <div class="d-flex align-items-center justify-content-center" style="background: url('/assets/images/home/cobertura_oto_1.jpg') no-repeat; background-size: cover;">
                                        <h2>Cobertura</h2>
                                    </div>
                                </a>
                            </article>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <article class=" main_list_group_item pt-4">
                                <a href="#">
                                    <div class="d-flex align-items-center justify-content-center" style="background: url('/assets/images/home/alto_padrao_1.jpg') no-repeat; background-size: cover;">
                                        <h2>Alto Padrão</h2>
                                    </div>
                                </a>
                            </article>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <article class=" main_list_group_item pt-4">
                                <a href="#">
                                    <div class="d-flex align-items-center justify-content-center" style="background: url('/assets/images/home/de_frente_pro_mar_original.jpg') no-repeat; background-size: cover;">
                                        <h2>De frente para o Mar</h2>
                                    </div>
                                </a>
                            </article>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <article class=" main_list_group_item pt-4">
                                <a href="#">
                                    <div class="d-flex align-items-center justify-content-center" style="background: url('/assets/images/home/condominio_fechado_1.jpg') no-repeat; background-size: cover;">
                                        <h2>Condomínio Fechado</h2>
                                    </div>
                                </a>
                            </article>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <article class=" main_list_group_item pt-4">
                                <a href="#">
                                    <div class="d-flex align-items-center justify-content-center" style="background: url('/assets/images/home/compacto_1.jpg') no-repeat; background-size: cover;">
                                        <h2>Compacto</h2>
                                    </div>
                                </a>
                            </article>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <article class=" main_list_group_item pt-4">
                                <a href="#">
                                    <div class="d-flex align-items-center justify-content-center" style="background: url('/assets/images/home/sala_comercial_original.jpg') no-repeat; background-size: cover;">
                                        <h2>Lojas e Salas</h2>
                                    </div>
                                </a>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main_properties">
        <div class="py-5">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center border-bottom border-front mb-5">
                    <h1 class="text-front">À Venda</h1>
                    <a href="#" class="text-front">Ver mais</a>
                </div>
                <div class="row">
                    @if (!!$propertiesForSales)
                        @foreach($propertiesForSales as $property)
                            <div class="mb-4 col-12 col-md-6 col-lg-4">
                                <article>
                                    <div class="card main_properties_item">
                                        <div class="img-responsive-16by9">
                                            <a href="{{route('web.buyProperty',$property->slug)}}"> <img src="{{ $property->cover }}" class="card-img-top" alt="">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h2>
                                                <a href="{{ url($property->slug) }}" class="text-front">{{ $property->title }}</a>
                                            </h2>
                                            <p class="main_properties_item_category">{{ $property->list_category[$property->category] }}</p>
                                            <p class="main_properties_item_type">{{ $property->type_text }} - {{ $property->neighborhood }}
                                                <i class="icon-location-arrow"></i></p>
                                            <p class="main_properties_item_price text-front">{{ $property->sale_price }}</p>
                                            <a href="#" class="btn btn-front btn-block">Ver imóvel</a>
                                        </div>
                                        <div class="card-footer align-items-center  text-center text-muted d-flex">
                                            <div class="col-4 main_properties_item_features">
                                                <img src="{{ asset('assets/images/icons/bed.png') }}" class="img-fluid" alt="">
                                                <p>{{ $property->bedrooms }}</p>
                                            </div>
                                            <div class="col-4 main_properties_item_features">
                                                <img src="{{ asset('assets/images/icons/garage.png') }}" class="img-fluid" alt="">
                                                <p>{{ $property->garage }}</p>
                                            </div>
                                            <div class="col-4 main_properties_item_features">
                                                <img src="{{ asset('assets/images/icons/util-area.png') }}" class="img-fluid" alt="">
                                                <p>{{ $property->area_util }} m²</p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="main_properties">
        <div class="bg-light py-5">
            <div class="container ">
                <div class="d-flex justify-content-between align-items-center border-bottom border-front mb-5">
                    <h1 class="text-front">Para Alugar</h1>
                    <a href="#" class="text-front">Ver mais</a>
                </div>
                <div class="row">
                    @if (!!$propertiesForRents)
                        @foreach($propertiesForRents as $property)
                            <div class="mb-4 col-12 col-md-6 col-lg-4">
                                <article>
                                    <div class="card main_properties_item">
                                        <div class="img-responsive-16by9">
                                            <a href="#"> <img src="{{ $property->cover }}" class="card-img-top" alt="">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h2>
                                                <a href="{{ url($property->slug) }}" class="text-front">{{ $property->title }}</a>
                                            </h2>
                                            <p class="main_properties_item_category">{{ $property->list_category[$property->category] }}</p>
                                            <p class="main_properties_item_type">{{ $property->type_text }} - {{ $property->neighborhood }}
                                                <i class="icon-location-arrow"></i></p>
                                            <p class="main_properties_item_price text-front">{{ $property->rent_price }}</p>
                                            <a href="#" class="btn btn-front btn-block">Ver imóvel</a>
                                        </div>
                                        <div class="card-footer align-items-center  text-center text-muted d-flex">
                                            <div class="col-4 main_properties_item_features">
                                                <img src="{{ asset('assets/images/icons/bed.png') }}" class="img-fluid" alt="">
                                                <p>{{ $property->bedrooms }}</p>
                                            </div>
                                            <div class="col-4 main_properties_item_features">
                                                <img src="{{ asset('assets/images/icons/garage.png') }}" class="img-fluid" alt="">
                                                <p>{{ $property->garage }}</p>
                                            </div>
                                            <div class="col-4 main_properties_item_features">
                                                <img src="{{ asset('assets/images/icons/util-area.png') }}" class="img-fluid" alt="">
                                                <p>{{ $property->area_util }} m²</p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
