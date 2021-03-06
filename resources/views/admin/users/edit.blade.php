@extends('admin.layout.master')
@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-user-plus">Novo Cliente</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.users.index') }}">Clientes</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.users.create') }}" class="text-orange">Novo Cliente</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="dash_content_app_box">
            <div class="nav">
                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#complementary" class="nav_tabs_item_link">Dados Complementares</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#realties" class="nav_tabs_item_link">Imóveis</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#management" class="nav_tabs_item_link">Administrativo</a>
                    </li>
                </ul>

                <form class="app_form" action="{{ route('admin.users.update',$user->id, false) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="nav_tabs_content">
                        <div id="data">
                            <div class="label_gc">
                                <span class="legend">Perfil:</span> <label class="label">
                                    <input type="checkbox" name="lessor" {{ !!old('lessor')?'checked':(!!$user->lessor?'checked':'') }}><span>Locatário</span>
                                </label>

                                <label class="label">
                                    <input type="checkbox" name="lessee" {{ !!old('lessee')?'checked': (!!$user->lessee?'checked':'') }}><span>Locador</span>
                                </label>
                            </div>

                            <label class="label"> <span class="legend">*Nome:</span>
                                <input type="text" name="name" placeholder="Nome Completo" value="{{ old('name')??$user->name }}"/>
                            </label>
                            <div class="label_g2">
                                <label class="label"> <span class="legend">*Genero:</span> <select name="genre">
                                        <option></option>
                                        <option value="m" {{ old('genre')==='m'? 'selected' : ($user->genre === 'm' ? 'selected' : '') }}>Masculino</option>
                                        <option value="f" {{ old('genre')==='f'? 'selected' : ($user->genre === 'f' ? 'selected' : '') }}>Feminino</option>
                                    </select> </label>

                                <label class="label"> <span class="legend">*CPF:</span>
                                    <input type="tel" class="mask-doc" name="document" placeholder="CPF do Cliente" value="{{ old('document') ?? $user->document }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label"> <span class="legend">*RG:</span>
                                    <input type="text" name="document_secondary" placeholder="RG do Cliente" value="{{ old('document_secondary') ?? $user->document_secondary }}"/>
                                </label>

                                <label class="label"> <span class="legend">Órgão Expedidor:</span>
                                    <input type="text" name="document_secondary_complement" placeholder="Expedição" value="{{ old('document_secondary_complement') ?? $user->document_secondary_complement }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label"> <span class="legend">*Data de Nascimento:</span>
                                    <input type="tel" name="date_of_birth" class="mask-date" placeholder="Data de Nascimento" value="{{ old('date_of_birth') ?? $user->date_of_birth  }}"/>
                                </label>

                                <label class="label"> <span class="legend">*Naturalidade:</span>
                                    <input type="text" name="place_of_birth" placeholder="Cidade de Nascimento" value="{{ old('place_of_birth')?? $user->place_of_birth }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label"> <span class="legend">*Estado Civil:</span>
                                    <select name="civil_status">
                                        @foreach($list_civil_status as $optgroups => $propertys)
                                            <optgroup label="{{ $optgroups }}">
                                                @foreach($propertys as $key => $civil_status)
                                                    <option value="{{ $key }}" {{ old('civil_status') == $key ? 'selected' : ($user->civil_status == $key? 'selected' : '') }}>{{ $civil_status }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select> </label>

                                <label class="label"> <span class="legend">Foto</span> <input type="file" name="cover">
                                </label>
                            </div>

                            <div class="app_collapse mt-2">
                                <div class="app_collapse_header collapse">
                                    <h3>Renda</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">*Profissão:</span>
                                            <input type="text" name="occupation" placeholder="Profissão do Cliente" value="{{ old('occupation') ?? $user->occupation }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">*Renda:</span>
                                            <input type="tel" name="income" class="mask-money" placeholder="Valores em Reais" value="{{ old('income') ?? $user->income }}"/>
                                        </label>
                                    </div>

                                    <label class="label"> <span class="legend">*Empresa:</span>
                                        <input type="text" name="company_work" placeholder="Contratante" value="{{ old('company_work') ?? $user->company_work }}"/>
                                    </label>
                                </div>
                            </div>

                            <div class="app_collapse mt-2">
                                <div class="app_collapse_header collapse">
                                    <h3>Endereço</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">*CEP:</span>
                                            <input type="tel" name="zipcode" class="mask-zipcode zip_code_search" placeholder="Digite o CEP" value="{{ old('zipcode') ?? $user->zipcode }}"/>
                                        </label>
                                    </div>

                                    <label class="label"> <span class="legend">*Endereço:</span>
                                        <input type="text" name="street" class="street" placeholder="Endereço Completo" value="{{ old('street') ?? $user->street }}"/>
                                    </label>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">*Número:</span>
                                            <input type="text" name="number" placeholder="Número do Endereço" value="{{ old('number') ?? $user->number }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Complemento:</span>
                                            <input type="text" name="complement" placeholder="Completo (Opcional)" value="{{ old('complement') ?? $user->complement }}"/>
                                        </label>
                                    </div>

                                    <label class="label"> <span class="legend">*Bairro:</span>
                                        <input type="text" name="neighborhood" class="neighborhood" placeholder="Bairro" value="{{ old('neighborhood') ?? $user->neighborhood }}"/>
                                    </label>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">*Estado:</span>
                                            <input type="text" name="state" class="state" placeholder="Estado" value="{{ old('state') ?? $user->state }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">*Cidade:</span>
                                            <input type="text" name="city" class="city" placeholder="Cidade" value="{{ old('city') ?? $user->city }}"/>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="app_collapse mt-2">
                                <div class="app_collapse_header collapse">
                                    <h3>Contato</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Residencial:</span>
                                            <input type="tel" name="telephone" class="mask-phone" placeholder="Número do Telefonce com DDD" value="{{ old('telephone') ?? $user->telephone }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">*Celular:</span>
                                            <input type="tel" name="cell" class="mask-cell" placeholder="Número do Telefonce com DDD" value="{{ old('cell') ?? $user->cell }}"/>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="app_collapse mt-2">
                                <div class="app_collapse_header collapse">
                                    <h3>Acesso</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">*E-mail:</span>
                                            <input type="email" name="email" placeholder="Melhor e-mail" value="{{ old('email') ?? $user->email }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Senha:</span>
                                            <input type="password" name="password" placeholder="Senha de acesso" value=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="complementary" class="d-none">
                            <div class="app_collapse">
                                <div class="app_collapse_header collapse">
                                    <h3>Cônjuge</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none content_spouse">

                                    <label class="label"> <span class="legend">Tipo de Comunhão:</span>
                                        <select name="type_of_communion" class="select2">
                                            @foreach($list_type_of_communion as $key => $type_of_communion){
                                            <option value="{{ $key }}" {{ old('type_of_communion')== $key ? 'selected' :
                                            ($user->type_of_communion == $key? 'selected':'')}}>
                                                {{ $type_of_communion }}
                                            </option>
                                            @endforeach
                                        </select> </label>

                                    <label class="label"> <span class="legend">Nome:</span>
                                        <input type="text" name="spouse_name" placeholder="Nome do Cônjuge" value="{{ old('spouse_name') ?? $user->spouse_name }}"/>
                                    </label>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Genero:</span>
                                            <select name="spouse_genre">
                                                <option value="m">Masculino</option>
                                                <option value="f">Feminino</option>
                                            </select> </label>

                                        <label class="label"> <span class="legend">CPF:</span>
                                            <input type="text" class="mask-doc" name="spouse_document" placeholder="CPF do Cliente" value="{{ old('spouse_document') ?? $user->spouse_document }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">RG:</span>
                                            <input type="text" name="spouse_document_secondary" placeholder="RG do Cliente" value="{{ old('spouse_document_secondary') ?? $user->spouse_document_secondary }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Órgão Expedidor:</span>
                                            <input type="text" name="spouse_document_secondary_complement" placeholder="Expedição" value="{{ old('spouse_document_secondary_complement')?? $user->spouse_document_secondary_complement }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Data de Nascimento:</span>
                                            <input type="tel" class="mask-date" name="spouse_date_of_birth" placeholder="Data de Nascimento" value="{{ old('spouse_date_of_birth')??$user->spouse_date_of_birth }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Naturalidade:</span>
                                            <input type="text" name="spouse_place_of_birth" placeholder="Cidade de Nascimento" value="{{ old('spouse_place_of_birth')?? $user->spouse_place_of_birth }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Profissão:</span>
                                            <input type="text" name="spouse_occupation" placeholder="Profissão do Cliente" value="{{ old('spouse_occupation')??$user->spouse_occupation }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Renda:</span>
                                            <input type="text" class="mask-money" name="spouse_income" placeholder="Valores em Reais" value="{{ old('spouse_income')??$user->spouse_income }}"/>
                                        </label>
                                    </div>

                                    <label class="label"> <span class="legend">Empresa:</span>
                                        <input type="text" name="spouse_company_work" placeholder="Contratante" value="{{ old('spouse_company_work') ?? $user->spouse_company_work }}"/>
                                    </label>
                                </div>
                            </div>

                            <div class="app_collapse mt-2">
                                <div class="app_collapse_header collapse">
                                    <h3>Empresa</h3>
                                    <span class="icon-minus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content">

                                    <div class="companies_list">
                                        @if (!!$user->companies()->count())
                                            @foreach($user->companies()->get() as $company)

                                                <div class="companies_list_item mb-2">
                                                    <p><b>Razão Social:</b> {{ $company->social_name }}</p>
                                                    <p><b>Nome Fantasia:</b> {{ $company->alias_name }}</p>
                                                    <p>
                                                        <b>CNPJ:</b> {{ $company->document_company }} -
                                                        <b>Inscrição Estadual:</b>{{ $company->document_company_secondary }}
                                                    </p>
                                                    <p>
                                                        <b>Endereço:</b> {{ $company->street }}, {{ $company->number }} {{ $company->complement }}
                                                    </p>
                                                    <p><b>CEP:</b> {{ $company->zipcode }}
                                                        <b>Bairro:</b> {{ $company->neighborhood }}
                                                        <b>Cidade/Estado:</b> {{ $company->city }}/ {{ $company->state}}
                                                    </p>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="no-content mb-2">Não foram encontrados registros!</div>
                                        @endif
                                    </div>

                                    <p class="text-right">
                                        <a href="{{ route('admin.companies.create',['user'=>$user->id]) }}" class="btn btn-green icon-building-o">Cadastrar Nova Empresa</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div id="realties" class="d-none">
                            <div class="app_collapse">
                                <div class="app_collapse_header collapse">
                                    <h3>Locador</h3>
                                    <span class="icon-minus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content">
                                    <div id="realties">
                                        <div class="realty_list">
                                            @if (!!$user->properties()->get())
                                                @foreach($user->properties()->get() as $property)

                                                    <div class="realty_list_item mb-1">
                                                        <div class="realty_list_item_actions_stats">
                                                            <img src="{{ $property->default_cover }}" alt="">
                                                            <ul>
                                                                <li>Venda: R$ {{ fixDouble($property->sale_price,'br') }}</li>
                                                                <li>Aluguel: R$ {{ fixDouble($property->rent_price,'br') }}</li>
                                                            </ul>
                                                        </div>

                                                        <div class="realty_list_item_content">
                                                            <h4>{{ $list_category[$property->category] }} - {{ $list_type_simple[$property->type] }}</h4>

                                                            <div class="realty_list_item_card">
                                                                <div class="realty_list_item_card_image">
                                                                    <span class="icon-realty-location"></span>
                                                                </div>
                                                                <div class="realty_list_item_card_content">
                                                                    <span class="realty_list_item_description_title">Bairro:</span>
                                                                    <span class="realty_list_item_description_content">{{ $property->neighborhood }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="realty_list_item_card">
                                                                <div class="realty_list_item_card_image">
                                                                    <span class="icon-realty-util-area"></span>
                                                                </div>
                                                                <div class="realty_list_item_card_content">
                                                                    <span class="realty_list_item_description_title">Área Útil:</span>
                                                                    <span class="realty_list_item_description_content">{{ $property->area_util }}m&sup2;</span>
                                                                </div>
                                                            </div>

                                                            <div class="realty_list_item_card">
                                                                <div class="realty_list_item_card_image">
                                                                    <span class="icon-realty-bed"></span>
                                                                </div>
                                                                <div class="realty_list_item_card_content">
                                                                    <span class="realty_list_item_description_title">Dormitórios:</span>
                                                                    <span class="realty_list_item_description_content">{{ $property->bedrooms + $property->suites }} Quartos<br>
                                                                    @if (!!$property->suites)
                                                                            <span>Sendo {{ $property->suites }} suítes</span></span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="realty_list_item_card">
                                                                <div class="realty_list_item_card_image">
                                                                    <span class="icon-realty-garage"></span>
                                                                </div>
                                                                <div class="realty_list_item_card_content">
                                                                    <span class="realty_list_item_description_title">Garagem:</span>
                                                                    <span class="realty_list_item_description_content">{{ $property->garage }} Vagas<br>
                                                                    @if(!!$property->garage_covered)
                                                                            <span>Sendo {{ $property->garage_covered }} cobertas</span>
                                                                        @endif
                                                                </span>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="realty_list_item_actions">
                                                            <ul>
                                                                <li class="icon-eye">{{ $property->views }} Visualizações</li>
                                                            </ul>
                                                            <div>
                                                                @if ($property->sale)
                                                                    <a href="{{ route('web.saleProperty',['slug'=> $property->slug], false) }}" class="btn btn-blue icon-eye" target="_blank">Visualizar Imóvel (Comprar)</a>
                                                                @endif
                                                                @if ($property->rent)
                                                                    <a href="{{ route('web.rentProperty',['slug'=> $property->slug], false) }}" class="btn btn-blue icon-eye" target="_blank">Visualizar Imóvel (Alugar)</a>
                                                                @endif
                                                                <a href="{{ route('admin.properties.edit',['property'=> $property->id], false) }}" class="btn btn-green icon-pencil-square-o">Editar Imóvel</a>
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
                            </div>

                            <div class="app_collapse mt-3">
                                <div class="app_collapse_header collapse">
                                    <h3>Locatário</h3>
                                    <span class="icon-minus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content">
                                    <div id="realties">
                                        <div class="realty_list">
                                            @if (!!$user->contractsAsAcquierer()->count())

                                                @foreach($user->contractsAsAcquierer()->get() as $contract)

                                                    @if ($property = $contract->property()->first())

                                                        <div class="realty_list_item mb-1">
                                                            <div class="realty_list_item_actions_stats">
                                                                <img src="{{ $property->default_cover }}" alt="">
                                                                <ul>
                                                                    <li>Venda: R$ {{ fixDouble($property->sale_price,'br') }}</li>
                                                                    <li>Aluguel: R$ {{ fixDouble($property->rent_price,'br') }}</li>
                                                                </ul>
                                                            </div>

                                                            <div class="realty_list_item_content">

                                                                <h4>{{ $property->category_text }} - {{ $property->type_text }}</h4>

                                                                <div class="realty_list_item_card">
                                                                    <div class="realty_list_item_card_image">
                                                                        <span class="icon-realty-location"></span>
                                                                    </div>
                                                                    <div class="realty_list_item_card_content">
                                                                        <span class="realty_list_item_description_title">Bairro:</span>
                                                                        <span class="realty_list_item_description_content">{{ $property->neighborhood }}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="realty_list_item_card">
                                                                    <div class="realty_list_item_card_image">
                                                                        <span class="icon-realty-util-area"></span>
                                                                    </div>
                                                                    <div class="realty_list_item_card_content">
                                                                        <span class="realty_list_item_description_title">Área Útil:</span>
                                                                        <span class="realty_list_item_description_content">{{ $property->area_util }}m&sup2;</span>
                                                                    </div>
                                                                </div>

                                                                <div class="realty_list_item_card">
                                                                    <div class="realty_list_item_card_image">
                                                                        <span class="icon-realty-bed"></span>
                                                                    </div>
                                                                    <div class="realty_list_item_card_content">
                                                                        <span class="realty_list_item_description_title">Dormitórios:</span>
                                                                        <span class="realty_list_item_description_content">{{ $property->bedrooms + $property->suites }} Quartos<br>
                                                                    @if (!!$property->suites)
                                                                                <span>Sendo {{ $property->suites }} suítes</span></span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="realty_list_item_card">
                                                                    <div class="realty_list_item_card_image">
                                                                        <span class="icon-realty-garage"></span>
                                                                    </div>
                                                                    <div class="realty_list_item_card_content">
                                                                        <span class="realty_list_item_description_title">Garagem:</span>
                                                                        <span class="realty_list_item_description_content">{{ $property->garage }} Vagas<br>
                                                                    @if(!!$property->garage_covered)
                                                                                <span>Sendo {{ $property->garage_covered }} cobertas</span>
                                                                            @endif
                                                                </span>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="realty_list_item_actions">
                                                                <ul>
                                                                    <li class="icon-eye">{{ $property->views }} Visualizações</li>
                                                                </ul>
                                                                <div>
                                                                    @if ($property->sale)
                                                                        <a href="{{ route('web.saleProperty',['slug'=> $property->slug], false) }}" class="btn btn-blue icon-eye" target="_blank">Visualizar Imóvel (Comprar)</a>
                                                                    @endif
                                                                    @if ($property->rent)
                                                                        <a href="{{ route('web.rentProperty',['slug'=> $property->slug], false) }}" class="btn btn-blue icon-eye" target="_blank">Visualizar Imóvel (Alugar)</a>
                                                                    @endif
                                                                    <a href="{{ route('admin.properties.edit',['property'=> $property->id], false) }}" class="btn btn-green icon-pencil-square-o">Editar Imóvel</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @endif

                                                @endforeach
                                            @else
                                                <div class="no-content">Não foram encontrados registros!</div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="management" class="d-none">
                            <div class="label_gc">
                                <span class="legend">Conceder:</span> <label class="label">
                                    <input type="checkbox" name="admin" {{ !!old('admin')? 'checked' : (!!$user->admin ? 'checked' : '') }}><span>Administrativo</span>
                                </label>

                                <label class="label">
                                    <input type="checkbox" name="client" {{ !!old('client')? 'checked' : (!!$user->client ? 'checked' : '') }}><span>Cliente</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-2">
                        <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
