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
                        <select name="search" id="search" class="selectpicker" title="Escolha...">
                            <option value="">Comprar</option>
                            <option value="">Alugar</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-6 col-lg-3">
                        <label for="search2" class="mb-2"><b>Comprar ou Alugar?</b></label>
                        <select name="search" id="search2" class="selectpicker" title="Escolha...">
                            <option value="">Comprar</option>
                            <option value="">Alugar</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-6 col-lg-3">
                        <label for="search3" class="mb-2"><b>Comprar ou Alugar?</b></label>
                        <select name="search" id="search3" class="selectpicker" title="Escolha..." multiple data-actions-box="true">
                            <option value="">Comprar</option>
                            <option value="">Alugar</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-6 col-lg-3">
                        <label for="search4" class="mb-2"><b>Comprar ou Alugar?</b></label>
                        <select name="search" id="search4" class="selectpicker" title="Escolha...">
                            <option value="">Comprar</option>
                            <option value="">Alugar</option>
                        </select>
                    </div>
                    <div style="display: none">
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label for="search5" class="mb-2"><b>Comprar ou Alugar?</b></label>
                            <select name="search" id="search5" class="selectpicker" title="Escolha...">
                                <option value="">Comprar</option>
                                <option value="">Alugar</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label for="search6" class="mb-2"><b>Comprar ou Alugar?</b></label>
                            <select name="search" id="search6" class="selectpicker" title="Escolha...">
                                <option value="">Comprar</option>
                                <option value="">Alugar</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label for="search7" class="mb-2"><b>Comprar ou Alugar?</b></label>
                            <select name="search" id="search7" class="selectpicker" title="Escolha...">
                                <option value="">Comprar</option>
                                <option value="">Alugar</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-3">
                            <label for="search8" class="mb-2"><b>Comprar ou Alugar?</b></label>
                            <select name="search" id="search8" class="selectpicker" title="Escolha...">
                                <option value="">Comprar</option>
                                <option value="">Alugar</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        <a href="#" class="text-front">Filtro Avançado &darr;</a>
                    </div>
                    <div class="col-6 mt-3 text-right">
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
