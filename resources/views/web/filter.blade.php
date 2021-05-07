@extends('web.layout.master')

@section('content')
    <div class="main_filter bg-light py-5">
        <div class="container">
            <section class="row">
                <div class="col-12">
                    <h2 class="text-front icon-filter mb-5">Filtro</h2>
                </div>
                <div class="col-12 col-md-4 ml-3 ml-sm-0">

                    <form action="{{ route('web.filter') }}"  class="w-100 p-3 bg-white mb-5" type="post">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="search" class="mb-2 text-front">Comprar ou Alugar?</label>
                                <select class="selectpicker" id="search" name="filter_trade" title="Escolha..." data-action="{{ route('component.main-filter.search') }}" data-index="1" required>
                                    <option value="sale">Comprar</option>
                                    <option value="rent">Alugar</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="category" class="mb-2 text-front">O que você quer?</label>
                                <select class="selectpicker" id="category" name="filter_category" title="Escolha..." data-action="{{ route('component.main-filter.category') }}" data-index="2">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="type" class="mb-2 text-front">Qual o tipo do imóvel?</label>
                                <select class="selectpicker input-large" id="type" name="filter_type" multiple data-actions-box="true" data-action="{{ route('component.main-filter.type') }}" data-index="3">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="neighborhood" class="mb-2 text-front">Onde você quer?</label>
                                <select class="selectpicker" name="filter_neighborhood" id="neighborhood" title="Escolha..." multiple data-actions-box="true" data-action="{{ route('component.main-filter.neighborhood') }}" data-index="4">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-front">Quartos</label>
                                <select class="selectpicker" name="filter_bedrooms" id="bedrooms" title="Escolha..." data-action="{{ route('component.main-filter.bedrooms') }}" data-index="5">
                                    <option disabled>Selecione o filtro anterior</option>

                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="suites" class="mb-2 text-front">Suítes</label>
                                <select class="selectpicker" name="filter_suites" id="suites" title="Escolha..." data-action="{{ route('component.main-filter.suites') }}" data-index="6">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bathrooms" class="mb-2 text-front">Banheiros</label>
                                <select class="selectpicker" name="filter_bathrooms" id="bathrooms" title="Escolha..." data-action="{{ route('component.main-filter.bathrooms') }}"  data-index="7">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="garage" class="mb-2 text-front">Garagem</label>
                                <select class="selectpicker" name="filter_garage" id="garage" title="Escolha..." data-action="{{ route('component.main-filter.garage') }}" data-index="8">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="price_base" class="mb-2 text-front">Preço Base</label>
                                <select class="selectpicker" name="filter_price_base" id="price_base" title="Escolha..." data-action="{{ route('component.main-filter.priceBase') }}" data-index="9">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="limit" class="mb-2 text-front">Preço Limite</label>
                                <select class="selectpicker" name="filter_limit" id="limit" title="Escolha..."  data-action="{{ route('component.main-filter.priceLimit') }}"  data-index="10">
                                    <option disabled>Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="col-12 text-right mt-3 button_search">
                                <button class="btn btn-front icon-search">Pesquisar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-8">

                    <div class="row">
                        @if (!!$properties)
                            @foreach($properties as $property)
                                <div class="mb-4 col-12 col-lg-6">
                                    <article>
                                        <div class="card main_properties_item">
                                            <div class="img-responsive-16by9">
                                                <a href="{{route('web.'.session('trade').'Property',$property->slug)}}">
                                                    <img src="{{ $property->cover }}" class="card-img-top" alt=""> </a>
                                            </div>
                                            <div class="card-body">
                                                <h2>
                                                    <a href="{{route('web.'.session('trade').'Property',$property->slug)}}" class="text-front">{{ $property->title }}</a>
                                                </h2>
                                                <p class="main_properties_item_category">{{ $property->list_category[$property->category] }}</p>
                                                <p class="main_properties_item_type">
                                                    {{ $property->type_text }} - {{ $property->neighborhood }}
                                                    <i class="icon-location-arrow"></i></p>
                                                <p class="main_properties_item_price text-front">{{ $property->sale_price }}</p>
                                                <a href="{{route('web.'.session('trade').'Property',$property->slug)}} " class="btn btn-front btn-block">Ver imóvel</a>
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
            </section>
        </div>
    </div>
@endsection
