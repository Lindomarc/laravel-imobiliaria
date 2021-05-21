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
                        <li><a href="#" class="text-orange">Novo Cliente</a></li>
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

                <form class="app_form" action="{{ route('admin.users.store',null,false) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="nav_tabs_content">
                        <div id="data">
                            <div class="label_gc">
                                <span class="legend">Perfil:</span> <label class="label">
                                    <input type="checkbox" name="lessor" {{ !!old('lessor')?'checked':'' }}><span>Locatário</span>
                                </label>

                                <label class="label">
                                    <input type="checkbox" name="lessee" {{ !!old('lessee')?'checked':'' }}><span>Locador</span>
                                </label>
                            </div>

                            <label class="label"> <span class="legend">*Nome:</span>
                                <input type="text" name="name" placeholder="Nome Completo" value="{{ old('name') }}"/>
                            </label>
                            <div class="label_g2">
                                <label class="label"> <span class="legend">*Genero:</span> <select name="genre">
                                        <option></option>
                                        <option value="m" {{ old('genre')==='m'? 'selected' : '' }}>Masculino</option>
                                        <option value="f" {{ old('genre')==='f'? 'selected' : '' }}>Feminino</option>
                                    </select> </label>

                                <label class="label"> <span class="legend">*CPF:</span>
                                    <input type="tel" class="mask-doc" name="document" placeholder="CPF do Cliente" value="{{ old('document') }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label"> <span class="legend">*RG:</span>
                                    <input type="text" name="document_secondary" placeholder="RG do Cliente" value="{{ old('document_secondary') }}"/>
                                </label>

                                <label class="label"> <span class="legend">Órgão Expedidor:</span>
                                    <input type="text" name="document_secondary_complement" placeholder="Expedição" value="{{ old('document_secondary_complement') }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label"> <span class="legend">*Data de Nascimento:</span>
                                    <input type="tel" name="date_of_birth" class="mask-date" placeholder="Data de Nascimento" value="{{ old('date_of_birth') }}"/>
                                </label>

                                <label class="label"> <span class="legend">*Naturalidade:</span>
                                    <input type="text" name="place_of_birth" placeholder="Cidade de Nascimento" value="{{ old('place_of_birth') }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label"> <span class="legend">*Estado Civil:</span>
                                    <select name="civil_status">
                                        @foreach($list_civil_status as $optgroups => $items)
                                            <optgroup label="{{ $optgroups }}">
                                                @foreach($items as $key => $civil_status)
                                                    <option value="{{ $key }}" {{ old('civil_status') == $key? 'selected' : '' }}>{{ $civil_status }}</option>
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
                                            <input type="text" name="occupation" placeholder="Profissão do Cliente" value="{{ old('occupation') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">*Renda:</span>
                                            <input type="tel" name="income" class="mask-money" placeholder="Valores em Reais" value="{{ old('income') }}"/>
                                        </label>
                                    </div>

                                    <label class="label"> <span class="legend">*Empresa:</span>
                                        <input type="text" name="company_work" placeholder="Contratante" value="{{ old('company_work') }}"/>
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
                                            <input type="tel" name="zipcode" class="mask-zipcode zip_code_search" placeholder="Digite o CEP" value="{{ old('zipcode') }}"/>
                                        </label>
                                    </div>

                                    <label class="label"> <span class="legend">*Endereço:</span>
                                        <input type="text" name="street" class="street" placeholder="Endereço Completo" value="{{ old('street') }}"/>
                                    </label>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">*Número:</span>
                                            <input type="text" name="number" placeholder="Número do Endereço" value="{{ old('number') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Complemento:</span>
                                            <input type="text" name="complement" placeholder="Completo (Opcional)" value="{{ old('complement') }}"/>
                                        </label>
                                    </div>

                                    <label class="label"> <span class="legend">*Bairro:</span>
                                        <input type="text" name="neighborhood" class="neighborhood" placeholder="Bairro" value="{{ old('neighborhood') }}"/>
                                    </label>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">*Estado:</span>
                                            <input type="text" name="state" class="state" placeholder="Estado" value="{{ old('state') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">*Cidade:</span>
                                            <input type="text" name="city" class="city" placeholder="Cidade" value="{{ old('city') }}"/>
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
                                            <input type="tel" name="telephone" class="mask-phone" placeholder="Número do Telefonce com DDD" value="{{ old('telephone') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">*Celular:</span>
                                            <input type="tel" name="cell" class="mask-cell" placeholder="Número do Telefonce com DDD" value="{{ old('cell') }}"/>
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
                                            <input type="email" name="email" placeholder="Melhor e-mail" value="{{ old('email') }}"/>
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
                                            <option value="{{ $key }}" {{ old('type_of_communion')== $key
                                                ? 'selected' : ''}}> {{ $type_of_communion }}
                                            </option>
                                            @endforeach
                                        </select> </label>

                                    <label class="label"> <span class="legend">Nome:</span>
                                        <input type="text" name="spouse_name" placeholder="Nome do Cônjuge" value="{{ old('spouse_name') }}"/>
                                    </label>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Genero:</span>
                                            <select name="spouse_genre">
                                                <option value="m">Masculino</option>
                                                <option value="f">Feminino</option>
                                            </select> </label>

                                        <label class="label"> <span class="legend">CPF:</span>
                                            <input type="text" class="mask-doc" name="spouse_document" placeholder="CPF do Cliente" value="{{ old('spouse_document') }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">RG:</span>
                                            <input type="text" name="spouse_document_secondary" placeholder="RG do Cliente" value="{{ old('spouse_document_secondary') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Órgão Expedidor:</span>
                                            <input type="text" name="spouse_document_secondary_complement" placeholder="Expedição" value="{{ old('spouse_document_secondary_complement') }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Data de Nascimento:</span>
                                            <input type="tel" class="mask-date" name="spouse_date_of_birth" placeholder="Data de Nascimento" value="{{ old('spouse_date_of_birth') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Naturalidade:</span>
                                            <input type="text" name="spouse_place_of_birth" placeholder="Cidade de Nascimento" value="{{ old('spouse_place_of_birth') }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Profissão:</span>
                                            <input type="text" name="spouse_occupation" placeholder="Profissão do Cliente" value="{{ old('spouse_occupation') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Renda:</span>
                                            <input type="text" class="mask-money" name="spouse_income" placeholder="Valores em Reais" value="{{ old('spouse_income') }}"/>
                                        </label>
                                    </div>

                                    <label class="label"> <span class="legend">Empresa:</span>
                                        <input type="text" name="spouse_company_work" placeholder="Contratante" value="{{ old('spouse_company_work') }}"/>
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
                                        <div class="no-content mb-2">Não foram encontrados registros!</div>
                                    </div>
                                    @can('Cadastrar Empresa')
                                    <p class="text-right">
                                        <a href="javascript:void(0)" class="btn btn-green btn-disabled icon-building-o">Cadastrar Nova Empresa</a>
                                    </p>
                                    @endcan
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
                                        <div class="no-content">Não foram encontrados registros!</div>
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
                                        <div class="no-content">Não foram encontrados registros!</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="management" class="d-none">
                            <div class="label_gc">
                                <span class="legend">Conceder:</span> <label class="label">
                                    <input type="checkbox" name="admin" {{ !!old('admin')? 'checked' : '' }}><span>Administrativo</span>
                                </label>

                                <label class="label">
                                    <input type="checkbox" name="client" {{ !!old('client')? 'checked' : '' }}><span>Cliente</span>
                                </label>
                            </div>
                            @foreach($roles as $role)
                                <label class="label">
                                    <input type="checkbox" name="acl[{{ $role->id }}]"><span>{{ $role->name }}</span>
                                </label>
                            @endforeach
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
