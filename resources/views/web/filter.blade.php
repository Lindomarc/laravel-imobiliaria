@extends('web.layout.master')

@section('content')
    <div class="main_filter bg-light py-5">
        <div class="container">
            <section class="row">
                <div class="col-12">
                    <h2 class="text-front icon-filter mb-5">Filtro</h2>
                </div>
                <div class="col-12 col-md-4 ml-3 ml-sm-0">
                    <form action="" class="bg-white p-3 w-100 mb-5 row">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="search" class="mb-2 text-front">Comprar ou Alugar</label>
                                <select name="search" id="search" class="selectpicker" title="Escolha...">
                                    <option value="">Comprar</option>
                                    <option value="">Alugar</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label for="search2" class="mb-2 text-front">Comprar ou Alugar</label>
                                <select name="search" id="search2" class="selectpicker" title="Escolha...">
                                    <option value="">Comprar</option>
                                    <option value="">Alugar</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label for="search3" class="mb-2 text-front">Comprar ou Alugar</label>
                                <select name="search" id="search3" class="selectpicker" title="Escolha..." multiple data-actions-box="true">
                                    <option value="">Comprar</option>
                                    <option value="">Alugar</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label for="search4" class="mb-2 text-front">Comprar ou Alugar</label>
                                <select name="search" id="search4" class="selectpicker" title="Escolha...">
                                    <option value="">Comprar</option>
                                    <option value="">Alugar</option>
                                </select>
                            </div>
                            <div class="col-12 mt-3 text-right">
                                <button class="btn btn-front icon-search">Pesquisar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-8">

                    <div class="row">
                        <div class="mb-4 col-12 col-lg-6">
                            <article>
                                <div class="card main_properties_item">
                                    <div class="img-responsive-16by9">
                                        <a href="#">
                                            <img src="assets/images/properties/1/5a3571ab-4d76-466f-8246-eff8cb98cedd.jpg" class="card-img-top" alt="">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h2><a href="/?app=property#" class="text-front">Linda Casa no Campeche com vista para o Mar</a></h2>
                                        <p class="main_properties_item_category">Imóvel Residencial</p>
                                        <p class="main_properties_item_type">Apartamento - Campeche
                                            <i class="icon-location-arrow"></i></p>
                                        <p class="main_properties_item_price text-front">R$ 400.000,00</p>
                                        <a href="?app=property#" class="btn btn-front btn-block">Ver imóvel</a>
                                    </div>
                                    <div class="card-footer align-items-center  text-center text-muted d-flex">
                                        <div class="col-4 main_properties_item_features">
                                            <img src="assets/images/icons/bed.png" class="img-fluid" alt="">
                                            <p>1</p>
                                        </div>
                                        <div class="col-4 main_properties_item_features">
                                            <img src="assets/images/icons/garage.png" class="img-fluid" alt="">
                                            <p>4</p>
                                        </div>
                                        <div class="col-4 main_properties_item_features">
                                            <img src="assets/images/icons/util-area.png" class="img-fluid" alt="">
                                            <p>180 m²</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="mb-4 col-12 col-lg-6">
                            <article>
                                <div class="card main_properties_item">
                                    <div class="img-responsive-16by9">
                                        <a href="/?app=property#">
                                            <img src="assets/images/properties/1/e321729b-63b1-437b-84c3-5da24e047fb3.jpg" class="card-img-top" alt="">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h2><a href="#" class="text-front">Linda Casa no Campeche com vista para o Mar</a></h2>
                                        <p class="main_properties_item_category">Imóvel Residencial</p>
                                        <p class="main_properties_item_type">Apartamento - Campeche
                                            <i class="icon-location-arrow"></i></p>
                                        <p class="main_properties_item_price text-front">R$ 400.000,00</p>
                                        <a href="/?app=property#" class="btn btn-front btn-block">Ver imóvel</a>
                                    </div>
                                    <div class="card-footer align-items-center  text-center text-muted d-flex">
                                        <div class="col-4 main_properties_item_features">
                                            <img src="assets/images/icons/bed.png" class="img-fluid" alt="">
                                            <p>1</p>
                                        </div>
                                        <div class="col-4 main_properties_item_features">
                                            <img src="assets/images/icons/garage.png" class="img-fluid" alt="">
                                            <p>4</p>
                                        </div>
                                        <div class="col-4 main_properties_item_features">
                                            <img src="assets/images/icons/util-area.png" class="img-fluid" alt="">
                                            <p>180 m²</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="mb-4 col-12 col-lg-6">
                            <article>
                                <div class="card main_properties_item">
                                    <div class="img-responsive-16by9">
                                        <a href="/?app=property#">
                                            <img src="assets/images/properties/3/1c7275a0-c84e-4f25-9247-9b56664eb294.jpg" class="card-img-top" alt="">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h2><a href="#" class="text-front">Linda Casa no Campeche com vista para o Mar</a></h2>
                                        <p class="main_properties_item_category">Imóvel Residencial</p>
                                        <p class="main_properties_item_type">Apartamento - Campeche
                                            <i class="icon-location-arrow"></i></p>
                                        <p class="main_properties_item_price text-front">R$ 200.000,00</p>
                                        <a href="/?app=property#" class="btn btn-front btn-block">Ver imóvel</a>
                                    </div>
                                    <div class="card-footer align-items-center  text-center text-muted d-flex">
                                        <div class="col-4 main_properties_item_features">
                                            <img src="assets/images/icons/bed.png" class="img-fluid" alt="">
                                            <p>1</p>
                                        </div>
                                        <div class="col-4 main_properties_item_features">
                                            <img src="assets/images/icons/garage.png" class="img-fluid" alt="">
                                            <p>4</p>
                                        </div>
                                        <div class="col-4 main_properties_item_features">
                                            <img src="assets/images/icons/util-area.png" class="img-fluid" alt="">
                                            <p>180 m²</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="mb-4 col-12 col-lg-6">
                            <article>
                                <div class="card main_properties_item">
                                    <div class="img-responsive-16by9">
                                        <a href="#">
                                            <img src="assets/images/properties/3/1c7275a0-c84e-4f25-9247-9b56664eb294.jpg" class="card-img-top" alt="">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h2><a href="#" class="text-front">Linda Casa no Campeche com vista para o Mar</a></h2>
                                        <p class="main_properties_item_category">Imóvel Residencial</p>
                                        <p class="main_properties_item_type">Apartamento - Campeche
                                            <i class="icon-location-arrow"></i></p>
                                        <p class="main_properties_item_price text-front">R$ 200.000,00</p>
                                        <a href="#" class="btn btn-front btn-block">Ver imóvel</a>
                                    </div>
                                    <div class="card-footer align-items-center  text-center text-muted d-flex">
                                        <div class="col-4 main_properties_item_features">
                                            <img src="assets/images/icons/bed.png" class="img-fluid" alt="">
                                            <p>1</p>
                                        </div>
                                        <div class="col-4 main_properties_item_features">
                                            <img src="assets/images/icons/garage.png" class="img-fluid" alt="">
                                            <p>4</p>
                                        </div>
                                        <div class="col-4 main_properties_item_features">
                                            <img src="assets/images/icons/util-area.png" class="img-fluid" alt="">
                                            <p>180 m²</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
