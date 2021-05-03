@extends('web.layout.master')
@section('content')
    <div class="main_property">
        <div class="main_property_header bg-light py-5">
            <div class="container">
                <h1 class="text-front font-weight-bold">{{ $property->title }}</h1>
                <p class="mb-0">{{ $property->type_text }} - {{ $property->neighborhood }}</p>
            </div>
        </div>
        <div class="main_property_content py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8">

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                            <ol class="carousel-indicators">
                                @if ($property->covers)
                                    @foreach($property->covers as $key => $cover)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $cover->cover?'active':''}}"></li>
                                    @endforeach
                                @endif
                            </ol>
                            @if ($property->covers)
                                <div class="carousel-inner">
                                    @foreach($property->covers as $key => $cover)
                                        <div class="carousel-item {{ $cover->cover?'active':'' }}">
                                            <img src="{{ asset($cover->url) }}" class="d-block w-100" alt="...">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span> </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span> </a>
                        </div>
                        <div class="main_property_content_price text-muted">
                            <p class="small">IPTU: R$ {{ $property->tribute??'0,00'  }} | Condominio: R$ {{ $property->condominium??'0,00' }}</p>
                            <p class="text-muted font-weight-bold">Valor do imóvel: R$ {{ $property->sale_price  }}</p>
                        </div>
                        <div class="main_property_content_description">
                            <h2 class="text-front font-weight-bold">Conheça mais o imóvel</h2>
                            <div>{!!  $property->description !!}</div>
                        </div>
                        <div class="main_property_content_features">
                            <h2 class="text-front font-weight-bold">Características</h2>
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td>Dormitórios</td>
                                    <td>{{ $property->bedrooms }}</td>
                                </tr>
                                <tr>
                                    <td>Banheiros</td>
                                    <td>{{ $property->bathrooms }}</td>
                                </tr>
                                <tr>
                                    <td>Suítes</td>
                                    <td>{{ $property->suites }}</td>
                                </tr>
                                <tr>
                                    <td>Salas</td>
                                    <td>{{ $property->rooms }}</td>
                                </tr>
                                <tr>
                                    <td>Garagem</td>
                                    <td>{{ $property->garage }}</td>
                                </tr>
                                <tr>
                                    <td>Garagem Coberta</td>
                                    <td>{{ $property->garage_covered }}</td>
                                </tr>
                                <tr>
                                    <td>Área Total</td>
                                    <td>{{ $property->area_total }} m²</td>
                                </tr>
                                <tr>
                                    <td>Área ùtil</td>
                                    <td>{{ $property->area_util }} m²</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="main_property_content_structure pt-5">
                            <h2 class="text-front font-weight-bold">Estrutura</h2>
                            <div class="row">
                                @if($property->air_conditioning == true)
                                    <span class="main_property_structure_item icon-check">Ar Condicionado</span>
                                @endif

                                @if($property->bar == true)
                                    <span class="main_property_structure_item icon-check">Bar</span>
                                @endif

                                @if($property->library == true)
                                    <span class="main_property_structure_item icon-check">Biblioteca</span>
                                @endif

                                @if($property->barbecue_grill == true)
                                    <span class="main_property_structure_item icon-check">Churrasqueira</span>
                                @endif

                                @if($property->american_kitchen == true)
                                    <span class="main_property_structure_item icon-check">Cozinha Americana</span>
                                @endif

                                @if($property->fitted_kitchen == true)
                                    <span class="main_property_structure_item icon-check">Cozinha Planejada</span>
                                @endif

                                @if($property->pantry == true)
                                    <span class="main_property_structure_item icon-check">Despensa</span>
                                @endif

                                @if($property->edicule == true)
                                    <span class="main_property_structure_item icon-check">Edicula</span>
                                @endif

                                @if($property->office == true)
                                    <span class="main_property_structure_item icon-check">Escritório</span>
                                @endif

                                @if($property->bathtub == true)
                                    <span class="main_property_structure_item icon-check">Banheira</span>
                                @endif

                                @if($property->fireplace == true)
                                    <span class="main_property_structure_item icon-check">Lareira</span>
                                @endif

                                @if($property->lavatory == true)
                                    <span class="main_property_structure_item icon-check">Lavabo</span>
                                @endif

                                @if($property->furnished == true)
                                    <span class="main_property_structure_item icon-check">Mobiliado</span>
                                @endif

                                @if($property->pool == true)
                                    <span class="main_property_structure_item icon-check">Piscina</span>
                                @endif

                                @if($property->steam_room == true)
                                    <span class="main_property_structure_item icon-check">Sauna</span>
                                @endif

                                @if($property->view_of_the_sea == true)
                                    <span class="main_property_structure_item icon-check">Vista para o Mar</span>
                                @endif
                            </div>
                        </div>
                        <div class="main_property_content_location py-5">
                            <h2 class="text-front font-weight-bold">Localização</h2>
                            <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $property->street }},{{ $property->number }},{{ $property->city }},{{ $property->state }}&zoom=15&size=600x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284&key=AIzaSyDOwuKhLZFsnVd_Bay2q6iecmzr3NgXjGo">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <a href="" class="btn btn-outline-success btn-lg btn-block icon-whatsapp">Converse com um Corretor</a>
                        <div class="main_property_contact">
                            <form action="" class="bg-light">
                                <h2 class="text-white bg-front">Entre em contato</h2>
                                <div class="form-group">
                                    <label for="">Seu nome:</label>
                                    <input type="text" class="form-control" placeholder="Informe seu nome completo">
                                </div>
                                <div class="form-group">
                                    <label for="">Seu telefone:</label>
                                    <input type="text" class="form-control" placeholder="Informe seu telefone com DDD">
                                </div>
                                <div class="form-group">
                                    <label for="">Seu nome:</label>
                                    <input type="text" class="form-control" placeholder="Informe seu melhor e-mail">
                                </div>
                                <div class="form-group">
                                    <label for="">Sua mensagem</label>
                                    <textarea name="" id="" rows="5" class="form-control">Quero ter mais informações sobre esse imóvel, Residencial, Casa, Campeche,Florianópolis! (#01)</textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-front btn-block form-control">Enviar</button>
                                    <p class="text-front font-weight-bold text-center py-4">{{ getenv('APP_PHONE')??'' }}</p>
                                </div>
                            </form>
                        </div>
                        <div class="main_property_share">
                            <a href="#" class="btn btn-info icon-facebook icon-notext">Facebook</a>
                            <a href="#" class="btn btn-info icon-twitter icon-notext">Twitter</a>
                            <a href="#" class="btn btn-info icon-instagram icon-notext">instagram</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
