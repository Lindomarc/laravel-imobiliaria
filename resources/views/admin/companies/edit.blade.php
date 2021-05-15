@extends('admin.layout.master')
@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-user-plus">Edição de Empresa</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.users.index') }}">Clientes</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.companies.index') }}">Empresas</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.companies.create') }}" class="text-orange">Nova Empresa</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <form class="app_form" action="{{ route('admin.companies.update',$item->id, false) }}" method="post">
                    @csrf
                    @method('put')
                    <label class="label"> <span class="legend">Usuário Responsável Legal:</span>
                        <select name="user_id" class="select2">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id === old('user_id') ? 'selected': ($user->id === $item->user_id ?'selected': '') }}>
                                    {{ $user->name }} ({{ $user->document }})
                                </option>
                            @endforeach

                        </select>
                        <p style="margin-top: 4px;">
                            <a href="{{ route('admin.users.edit', $item->user_id) }}" class="text-orange icon-link" style="font-size: .8em;" target="_blank">Acessar
                                Cadastro</a>
                        </p>
                    </label>

                    <label class="label"> <span class="legend">*Razão Social:</span>
                        <input type="text" name="social_name" placeholder="Razão Social" value="{{ old('social_name') ?? ($item->social_name?? '') }}"/>
                    </label>

                    <label class="label"> <span class="legend">Nome Fantasia:</span>
                        <input type="text" name="alias_name" placeholder="Nome Fantasia" value="{{ old('alias_name') ?? ($item->alias_name?? '') }}"/>
                    </label>

                    <div class="label_g2">
                        <label class="label"> <span class="legend">CNPJ:</span>
                            <input type="tel" name="document_company" class="mask-cnpj" placeholder="CNPJ da Empresa" value="{{ old('document_company') ?? ($item->document_company?? '') }}"/>
                        </label>

                        <label class="label"> <span class="legend">Inscrição Estadual:</span>
                            <input type="text" name="document_company_secondary" placeholder="Número da Inscrição" value="{{ old('document_company_secondary') ?? ($item->document_company_secondary?? '') }}"/>
                        </label>
                    </div>

                    <div class="app_collapse">
                        <div class="app_collapse_header mt-2 collapse">
                            <h3>Endereço</h3>
                            <span class="icon-minus-circle icon-notext"></span>
                        </div>

                        <div class="app_collapse_content">
                            <div class="label_g2">
                                <label class="label"> <span class="legend">*CEP:</span>
                                    <input type="tel" name="zipcode" class="mask-zipcode zip_code_search" placeholder="Digite o CEP" value="{{ old('zipcode') ?? ($item->zipcode?? '') }}"/>
                                </label>
                            </div>

                            <label class="label"> <span class="legend">*Endereço:</span>
                                <input type="text" name="street" class="street" placeholder="Endereço Completo" value="{{ old('street') ?? ($item->street?? '') }}"/>
                            </label>

                            <div class="label_g2">
                                <label class="label"> <span class="legend">*Número:</span>
                                    <input type="text" name="number" placeholder="Número do Endereço" value="{{ old('number') ?? ($item->number?? '') }}"/>
                                </label>

                                <label class="label"> <span class="legend">Complemento:</span>
                                    <input type="text" name="complement" placeholder="Completo (Opcional)" value="{{ old('complement') ?? ($item->complement?? '') }}"/>
                                </label>
                            </div>

                            <label class="label"> <span class="legend">*Bairro:</span>
                                <input type="text" name="neighborhood" class="neighborhood" placeholder="Bairro" value="{{ old('neighborhood') ?? ($item->neighborhood?? '') }}"/>
                            </label>

                            <div class="label_g2">
                                <label class="label"> <span class="legend">*Estado:</span>
                                    <input type="text" name="state" class="state" placeholder="Estado" value="{{ old('state') ?? ($item->state?? '') }}"/>
                                </label>

                                <label class="label"> <span class="legend">*Cidade:</span>
                                    <input type="text" name="city" class="city" placeholder="Cidade" value="{{ old('city') ?? ($item->city?? '') }}"/>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-large btn-green icon-check-square-o" type="submit">Editar Empresar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
