@extends('admin.layout.master')
@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-search">Cadastrar Novo Contrato</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.contracts.index') }}">Contratos</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="#" class="text-orange">Cadastrar Contrato</a></li>
                    </ul>
                </nav>

                <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>
            </div>
        </header>

        @include('admin.contracts.filter')

        <div class="dash_content_app_box">

            <div class="nav">
                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#parts" class="nav_tabs_item_link active">Das Partes</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#terms" class="nav_tabs_item_link">Termos</a>
                    </li>
                </ul>

                <div class="nav_tabs_content">
                    <div id="parts">
                        <form action="{{ route('admin.contracts.store', null, false) }}" method="post" class="app_form">
                            @csrf
                            <input type="hidden" name="owner_spouse_persist" value="{{ old('owner_spouse') }}">
                            <input type="hidden" name="owner_company_id_persist" value="{{ old('owner_company_id') }}">
                            <input type="hidden" name="acquirer_spouse_persist" value="{{ old('acquirer_spouse') }}">
                            <input type="hidden" name="acquirer_company_id_persist" value="{{ old('acquirer_company_id') }}">
                            <input type="hidden" name="property_id_persist" value="{{ old('property_id') }}">
                            <div class="label_gc">
                                <span class="legend">Finalidade:</span>
                                <label class="label">
                                    <input type="radio" name="purpose" value="sale" {{ (old('purpose') == 'sale')?'checked':'' }}/>
                                    <span>Venda</span>
                                </label>
                                <label class="label">
                                    <input type="radio" name="purpose" value="rent" {{ (old('purpose') != 'sale')?'checked': '' }}/>
                                    <span>Loca????o</span>
                                </label>
                            </div>
                            <label class="label"> <span class="legend">Status do Contrato</span>
                                <select name="status" class="select2">
                                    <option value="pending" {{ old('status')=='pending'?'selected':'' }}>Pendente</option>
                                    <option value="active" {{ old('status')=='active'?'selected':'' }}>Ativo</option>
                                    <option value="canceled" {{ old('status')=='canceled'?'selected':'' }}>Cancelado</option>
                                </select>
                            </label>

                            <div class="app_collapse">
                                <div class="app_collapse_header mt-2 collapse">
                                    <h3>Propriet??rio</h3>
                                    <span class="icon-minus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content">
                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Propriet??rio:</span>
                                            <select class="select2" name="owner_id" onchange="changeOwner()" data-action="{{ route('admin.contracts.getDataOwner') }}">
                                                <option value="">Informe um Cliente</option>
                                                @foreach($lessors->get() as $lessor)
                                                    <option value="{{ $lessor->id }}" {{ (old('owner_id')== $lessor->id)?'selected':'' }}>{{ $lessor->name }} ({{ $lessor->document }})</option>
                                                @endforeach
                                            </select> </label>

                                        <label class="label"> <span class="legend">Conjuge Propriet??rio:</span>
                                            <select class="select2" name="owner_spouse">
                                                <option value="" selected>N??o informado</option>
                                            </select> </label>
                                    </div>

                                    <label class="label"> <span class="legend">Empresa:</span>
                                        <select class="select2" name="owner_company_id">
                                            <option value="" selected>N??o informado</option>
                                        </select> </label>
                                </div>
                            </div>

                            <div class="app_collapse">
                                <div class="app_collapse_header mt-2 collapse">
                                    <h3>Adquirente</h3>
                                    <span class="icon-minus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content">
                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Adquirente:</span>
                                            <select name="acquirer_id" class="select2" onchange="changeAcquirer()"
                                                data-action="{{ route('admin.contracts.getDataAcquirer') }}">
                                                <option value="0" selected>Informe um Cliente</option>
                                                @foreach($lessees->get() as $lessee)
                                                    <option
                                                        value="{{ $lessee->id }}" {{ (old('acquirer_id')== $lessee->id)?'selected':'' }}>{{ $lessee->name }} ({{ $lessee->document }})</option>
                                                @endforeach
                                            </select>
                                        </label>

                                        <label class="label"> <span class="legend">Conjuge Adquirente:</span>
                                            <select class="select2" name="acquirer_spouse">
                                                <option value="" selected>N??o informado</option>
                                            </select>
                                        </label>
                                    </div>

                                    <label class="label"> <span class="legend">Empresa:</span>
                                        <select name="acquirer_company_id" class="select2">
                                            <option value="" selected>N??o informado</option>
                                        </select>
                                    </label>
                                </div>
                            </div>

                            <div class="app_collapse">
                                <div class="app_collapse_header mt-2 collapse">
                                    <h3>Par??metros do Contrato</h3>
                                    <span class="icon-minus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content">
                                    <label class="label"> <span class="legend">Im??vel:</span>
                                        <select name="property_id" class="select2" onchange="changeProperty(this)" data-action="{{ route('admin.contracts.getDataProperty') }}">
                                            <option value="">N??o informado</option>
                                        </select> </label>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Valor de Venda:</span>
                                            <input type="tel" name="sale_price" class="mask-money" placeholder="Valor de Venda" value="{{ old('sale_price') }}" disabled/>
                                        </label>

                                        <label class="label"> <span class="legend">Valor de Loca????o:</span>
                                            <input type="text" name="rent_price" class="mask-money" placeholder="Valor de Loca????o" value="{{ old('rent_price') }}" disabled/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">IPTU:</span>
                                            <input type="text" name="tribute" class="mask-money" placeholder="IPTU" value="{{ old('tribute') }}"/>
                                        </label>

                                        <label class="label"> <span class="legend">Condom??nio:</span>
                                            <input type="text" name="condominium" class="mask-money" placeholder="Valor do Condom??nio" value="{{ old('condominium') }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">

                                        <label class="label"> <span class="legend">Dia de Vencimento:</span>

                                            <select name="due_date" class="select2">
                                                @foreach($list_due_date as $key => $value)
                                                    <option value="{{ $key }}" {{ old('due_date')==$key?'selected':'' }}>{{ $value }}</option>
                                                @endforeach
                                            </select> </label> <label class="label">
                                            <span class="legend">Prazo do Contrato (Em meses)</span>
                                            <select name="dateline" class="select2">
                                                @foreach($list_dateline as $key => $value)
                                                    <option value="{{ $key }}" {{ old('dateline')==$key?'selected':'' }}>{{ $value }}</option>
                                                @endforeach
                                            </select> </label>
                                    </div>

                                    <label class="label"> <span class="legend">Data de In??cio:</span>
                                        <input type="tel" name="start_at" class="mask-date" placeholder="Data de In??cio" value="{{ old('start_at') }}"/>
                                    </label>
                                </div>
                            </div>

                            <div class="text-right mt-2">
                                <button class="btn btn-large btn-green icon-check-square-o">Salvar Contrato</button>
                            </div>
                        </form>
                    </div>

                    <div id="terms" class="d-none">
                        <h3 class="mb-2">Termos</h3>

                        <textarea name="terms" cols="30" rows="10" class="mce"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js_block')
    <script>
        $(() => {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            changeOwner()
            changeAcquirer()
            getPropertyIdPersist()
        });

        function setFieldOwner(response) {
            /** Spouse     */
            let owner_spouse = $('select[name="owner_spouse"]')
            owner_spouse.html('')
            if (!!response.spouse.spouse_name) {
                owner_spouse.append($('<option>', {
                    value: '',
                    text: 'N??o informar'
                }))
                owner_spouse.append($('<option>', {
                    value: 1,
                    text: `${response.spouse.spouse_name} - (${response.spouse.spouse_document})`,
                    selected: ($('input[name="owner_spouse_persist"]').val() == 1 ? 'selected' : false)
                }))
            } else {
                owner_spouse.append($('<option>', {
                    value: '',
                    text: 'N??o informado'
                }))
            }
            /** Companies     */
            let owner_company = $('select[name="owner_company_id"]')
            owner_company.html('')
            if (!!response.companies.length) {
                owner_company.append($('<option>', {
                    value: '',
                    text: 'N??o informar'
                }))
                $.each(response.companies, (key, company) => {
                    owner_company.append($('<option>', {
                        value: company.id,
                        text: `${company.alias_name} - (${company.document_company})`,
                        selected: ($('input[name="owner_company_id_persist"]').val() == company.id ? 'selected' : false)
                    }))
                })

            } else {
                owner_company.append($('<option>', {
                    value: '',
                    text: 'N??o informado'
                }))
            }

            /** Properties     */
            let select_property = $('select[name="property_id"]')
            select_property.html('')

            if (!!response.properties.length) {
                select_property.append($('<option>', {
                    value: '',
                    text: 'N??o informar'
                }))
                $.each(response.properties, (key, property) => {
                    select_property.append($('<option>', {
                        value: property.id,
                        text: `${property.description})`,
                        selected: ($('input[name="property_id_persist"]').val() == property.id ? 'selected' : false)
                    }))
                })

            } else {
                select_property.append($('<option>', {
                    value: '',
                    text: 'N??o informado'
                }))
            }
        }

        function setFieldAcquirer(response) {
            /** Spouse     */
            let acquirer_spouse = $('select[name="acquirer_spouse"]')
            acquirer_spouse.html('')
            if (!!response.spouse.spouse_name) {
                acquirer_spouse.append($('<option>', {
                    value: '',
                    text: 'N??o informar'
                }))
                acquirer_spouse.append($('<option>', {
                    value: 1,
                    text: `${response.spouse.spouse_name} - (${response.spouse.spouse_document})`,
                    selected: ($('input[name="acquirer_spouse_persist"]').val() != 0 ? 'selected' : false)
                }))
            } else {
                acquirer_spouse.append($('<option>', {
                    value: '',
                    text: 'N??o informado'
                }))
            }
            /** Companies     */
            let acquirer_company = $('select[name="acquirer_company_id"]')
            acquirer_company.html('')
            if (!!response.companies.length) {
                acquirer_company.append($('<option>', {
                    value: '',
                    text: 'N??o informar'
                }))
                $.each(response.companies, (key, company) => {
                    acquirer_company.append($('<option>', {
                        value: company.id,
                        text: `${company.alias_name} - (${company.document_company})`,
                        selected: ($('input[name="acquirer_company_id_persist"]').val() == company.id ? 'selected' : false)
                    }))
                })

            } else {
                acquirer_company.append($('<option>', {
                    value: '',
                    text: 'N??o informado'
                }))
            }
        }

        function changeOwner() {

            let owner = $('select[name="owner_id"]')
            let owner_id = owner.val()
            let action = owner.data('action')

            $.post(action, {id: owner_id}, (response) => {
                setFieldOwner(response)
            }, 'json')

        }

        function changeAcquirer() {
            let acquirer = $('select[name="acquirer_id"]')
            let acquirer_id = acquirer.val()
            let action = acquirer.data('action')

            $.post(action, {id: acquirer_id}, (response) => {
                setFieldAcquirer(response)
            }, 'json')


        }

        function setFieldProperty(response) {

            let sale_price = $('input[name="sale_price"]')
            let rent_price = $('input[name="rent_price"]')
            let tribute = $('input[name="tribute"]')
            let condominium = $('input[name="condominium"]')

            sale_price.val('0,00')
            rent_price.val('0,00')
            tribute.val('0,00')
            condominium.val('0,00')

            if (!!response.success) {
                sale_price.val(response.property.sale_price)
                rent_price.val(response.property.rent_price)
                tribute.val(response.property.tribute)
                condominium.val(response.property.condominium)
            }
        }

        function changeProperty(element) {
            let property = $(element)
            let property_id = property.val()
            let action = property.data('action')

            $.post(action, {id: property_id}, (response) => {
                setFieldProperty(response)
            }, 'json')
        }

        function getPropertyIdPersist() {
            let property_id_persist = $('input[name="property_id_persist"]')
            let property_id = property_id_persist.val()
            let action = $('select[name="property_id"]').data('action')

            $.post(action, {id: property_id}, (response) => {
                setFieldProperty(response)
            }, 'json')
        }

    </script>
@endsection
