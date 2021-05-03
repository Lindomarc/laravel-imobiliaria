@extends('admin.layout.master')
@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-search">Cadastrar Novo Imóvel</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.properties.index') }}">Imóveis</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="#" class="text-orange">Cadastrar Imóvel</a></li>
                    </ul>
                </nav>

                <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>
            </div>
        </header>

        @include('admin.properties.filter')

        <div class="dash_content_app_box">

            <div class="nav">
                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#structure" class="nav_tabs_item_link">Estrutura</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#images" class="nav_tabs_item_link">Imagens</a>
                    </li>
                </ul>

                <form action="{{ route('admin.properties.store') }}" method="post" class="app_form" enctype="multipart/form-data">
                    @csrf
                    <div class="nav_tabs_content">
                        <div id="data">
                            <div class="label_gc">
                                <span class="legend">Finalidade:</span>
                                <label class="label">
                                    <input type="checkbox" name="sale" {{ (!!old('sale'))?'checked':'' }}>
                                    <span>Venda</span>
                                </label>
                                <label class="label">
                                    <input type="checkbox" name="rent" {{ (!!old('rent'))?'checked':'' }}>
                                    <span>Locação</span>
                                </label>
                                <label class="label">
                                    <input type="checkbox" name="status" {{ (!!old('status'))?'checked': '' }}>
                                    <span>Disponível</span>
                                </label>
                            </div>
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Categoria:</span>
                                    <select name="category" class="select2">
                                        <option>&nbsp;</option>
                                        @foreach($list_category as $key => $category)
                                            <option value="{{ $key }}" {{ old('category') == $key?'selected':'' }} >{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label class="label"> <span class="legend">Tipo:</span>
                                    <select name="type" class="select2">
                                        <option>&nbsp;</option>
                                        @foreach($list_type as $key => $items)
                                            <optgroup label="{{ $key }}">
                                                @foreach($items as $key => $item)
                                                    <option value="{{ $key }}" {{ old('type') == $key?'selected':'' }}>{{ $item }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </label>
                            </div>

                            <label class="label"> <span class="legend">Proprietário:</span>
                                <select name="user_id" class="select2">
                                <option>&nbsp;</option>
                                @foreach($users as $user)
                                        <option value="{{ $user->id }}"  {{ old('user_id') == $user->id?'selected':'' }}>{{ $user->name }} ({{ $user->document }})</option>
                                    @endforeach
                                </select> </label>

                            <div class="app_collapse">
                                <div class="app_collapse_header mt-2 collapse">
                                    <h3>Precificação e Valores</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Valor de Venda:</span>
                                            <input type="tel" name="sale_price" class="mask-money" value="{{ old('sale_price') }}"/> </label>

                                        <label class="label"> <span class="legend">Valor de Locação:</span>
                                            <input type="tel" name="rent_price" class="mask-money" value="{{ old('rent_price') }}"/> </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">IPTU:</span>
                                            <input type="tel" name="tribute" class="mask-money" value="{{ old('tribute') }}"/> </label>

                                        <label class="label"> <span class="legend">Condomínio:</span>
                                            <input type="tel" name="condominium" class="mask-money" value="{{ old('condominium') }}"/> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="app_collapse">
                                <div class="app_collapse_header mt-2 collapse">
                                    <h3>Características</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <label class="label"> <span class="legend">Descrição do Imóvel:</span>
                                        <textarea name="description" cols="30" rows="10" class="mce">{{ old('description') }}</textarea>
                                    </label>

                                    <div class="label_g4">
                                        <label class="label"> <span class="legend">Dormitórios:</span>
                                            <input type="text" name="bedrooms" placeholder="Quantidade de Dormitórios" value="{{ old('bedrooms') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Suítes:</span>
                                            <input type="text" name="suites" placeholder="Quantidade de Suítes" value="{{ old('suites') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Banheiros:</span>
                                            <input type="text" name="bathrooms" placeholder="Quantidade de Banheiros" value="{{ old('bathrooms') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Salas:</span>
                                            <input type="text" name="rooms" placeholder="Quantidade de Salas" value="{{ old('rooms') }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g4">
                                        <label class="label"> <span class="legend">Garagem:</span>
                                            <input type="text" name="garage" placeholder="Quantidade de Garagem" value="{{ old('garage') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Garagem Coberta:</span>
                                            <input type="text" name="garage_covered" placeholder="Quantidade de Garagem Coberta" value="{{ old('garage_covered') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Área Total:</span>
                                            <input type="text" name="area_total" placeholder="Quantidade de M&sup2;" value="{{ old('area_total') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Área Útil:</span>
                                            <input type="text" name="area_util" placeholder="Quantidade de M&sup2;" value="{{ old('area_util') }}"/>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="app_collapse">
                                <div class="app_collapse_header mt-2 collapse">
                                    <h3>Endereço</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">CEP:</span>
                                            <input type="text" name="zipcode" class="zip_code_search" placeholder="Digite o CEP" value="{{ old('zipcode') }}"/>
                                        </label>
                                    </div>

                                    <label class="label"> <span class="legend">Endereço:</span>
                                        <input type="text" name="street" class="street" placeholder="Endereço Completo" value="{{ old('street') }}"/>
                                    </label>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Número:</span>
                                            <input type="text" name="number" placeholder="Número do Endereço" value="{{ old('number') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Complemento:</span>
                                            <input type="text" name="complement" placeholder="Completo (Opcional)" value="{{ old('complement') }}"/>
                                        </label>
                                    </div>

                                    <label class="label"> <span class="legend">Bairro:</span>
                                        <input type="text" name="neighborhood" class="neighborhood" placeholder="Bairro" value="{{ old('neighborhood') }}"/>
                                    </label>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Estado:</span>
                                            <input type="text" name="state" class="state" placeholder="Estado" value="{{ old('state') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Cidade:</span>
                                            <input type="text" name="city" class="city" placeholder="Cidade" value="{{ old('city') }}"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="structure" class="d-none">
                            <h3 class="mb-2">Estrutura</h3>
                            <div class="label_g5">
                                <div>
                                    <label class="label">
                                        <input type="checkbox" name="air_conditioning" {{ (!!old('air_conditioning'))?'checked':'' }}><span>Ar Condicionado</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="label"> <input type="checkbox" name="bar"  {{ (!!old('bar'))?'checked':'' }}><span>Bar</span> </label>
                                </div>
                                <div>
                                    <label class="label"> <input type="checkbox" name="library" {{ (!!old('library'))?'checked':'' }}><span>Biblioteca</span>
                                    </label>
                                </div>

                                <div>
                                    <label class="label">
                                        <input type="checkbox" name="barbecue_grill" {{ (!!old('barbecue_grill'))?'checked':'' }}><span>Churrasqueira</span> </label>
                                </div>

                                <div>
                                    <label class="label">
                                        <input type="checkbox" name="american_kitchen" {{ (!!old('american_kitchen'))?'checked':'' }}><span>Cozinha Americana</span>
                                    </label>
                                </div>

                                <div>
                                    <label class="label">
                                        <input type="checkbox" name="fitted_kitchen" {{ (!!old('fitted_kitchen'))?'checked':'' }}><span>Cozinha Planejada</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="label"> <input type="checkbox" name="pantry" {{ (!!old('pantry'))?'checked':'' }}><span>Despensa</span>
                                    </label>
                                </div>

                                <div>
                                    <label class="label"> <input type="checkbox" name="edicule" {{ (!!old('edicule'))?'checked':'' }}><span>Edícula</span>
                                    </label>
                                </div>

                                <div>
                                    <label class="label"> <input type="checkbox" name="office" {{ (!!old('office'))?'checked':'' }}><span>Escritório</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="label"> <input type="checkbox" name="bathtub" {{ (!!old('bathtub'))?'checked':'' }}><span>Banheira</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="label"> <input type="checkbox" name="fireplace" {{ (!!old('fireplace'))?'checked':'' }}><span>Lareira</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="label"> <input type="checkbox" name="lavatory" {{ (!!old('lavatory'))?'checked':'' }}><span>Lavabo</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="label"> <input type="checkbox" name="furnished" {{ (!!old('furnished'))?'checked':'' }}><span>Mobiliado</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="label"> <input type="checkbox" name="pool" {{ (!!old('pool'))?'checked':'' }}><span>Piscina</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="label"> <input type="checkbox" name="steam_room" {{ (!!old('steam_room'))?'checked':'' }}><span>Sauna</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="label">
                                        <input type="checkbox" name="view_of_the_sea" {{ (!!old('view_of_the_sea'))?'checked':'' }}><span>Vista para o Mar</span>
                                    </label>
                                </div>
                            </div>
                            <h3 class="mt-2 mb-1">Informações do Site</h3>

                            <label class="label">
                                <span class="legend">Título: <a href="" target="_blank" class="text-orange icon-link" style=" margin-left: 10px; font-size: 0.875em;">Link</a></span>
                                <input type="text" name="title" value="{{ old('title') ?? '' }}"> </label>

                            <label class="label"> <span class="legend">Headline:</span>
                                <input type="text" name="headline" value="{{ old('headline') ?? '' }}">
                            </label>

                            <div class="label_g2">
                                <label class="label"> <span class="legend">Experiência</span>
                                    <select name="experience" class="select2">
                                        <option value="Cobertura" {{ (old('experience') == 'Cobertura' ? 'selected' : ('')) }}>Cobertura</option>
                                        <option value="Alto Padrão" {{ (old('experience') == 'Alto Padrão' ? 'selected' : ( '')) }}>Alto Padrão</option>
                                        <option value="De Frente para o Mar" {{ (old('experience') == 'De Frente para o Mar' ? 'selected' : ('')) }}>De Frente para o Mar</option>
                                        <option value="Condomínio Fechado" {{ (old('experience') == 'Condomínio Fechado' ? 'selected' : ('')) }}>Condomínio Fechado</option>
                                        <option value="Compacto" {{ (old('experience') == 'Compacto' ? 'selected' : ('')) }}>Compacto</option>
                                        <option value="Lojas e Salas" {{ (old('experience') == 'Lojas e Salas' ? 'selected' : ('')) }}>Lojas e Salas</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div id="images" class="d-none">
                            <label class="label"> <span class="legend">Imagens</span>
                                <input type="file" name="files[]" multiple> </label>

                            <div class="content_image"></div>
                        </div>
                    </div>

                    <div class="text-right mt-2">
                        <button class="btn btn-large btn-green icon-check-square-o">Criar Imóvel</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('js_block')
    <script>
        $(function () {
            $('input[name="files[]"]').change(function (files) {

                $('.content_image').text('');

                $.each(files.target.files, function (key, value) {
                    let reader = new FileReader();
                    reader.onload = function (value) {
                        $('.content_image').append(
                            `<div class="property_image_item">
                                <div class="embed radius" style="background-image: url(${value.target.result}); background-size: cover; background-position: center center;">
                                </div>
                            </div>`
                        );
                    };
                    reader.readAsDataURL(value);
                });
            });
        });
    </script>
@endsection
