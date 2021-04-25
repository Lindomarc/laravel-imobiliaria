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
                        <form action="" method="post" class="app_form">

                            <div class="label_gc">
                                <span class="legend">Finalidade:</span> <label class="label"> <input type="checkbox" name="sale"><span>Venda</span>
                                </label>

                                <label class="label"> <input type="checkbox" name="rent"><span>Locação</span> </label>
                            </div>

                            <div class="app_collapse">
                                <div class="app_collapse_header mt-2 collapse">
                                    <h3>Proprietário</h3>
                                    <span class="icon-minus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content">
                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Proprietário:</span>
                                            <select class="select2" name="owner_id" onchange="changeOwner(this)" data-action="{{ route('admin.contracts.getDataOwner') }}">
                                                <option value="">Informe um Cliente</option>
                                                @foreach($lessors->get() as $lessor)
                                                    <option value="{{ $lessor->id }}">{{ $lessor->name }} ({{ $lessor->document }})</option>
                                                @endforeach
                                            </select>
                                        </label>

                                        <label class="label"> <span class="legend">Conjuge Proprietário:</span>
                                            <select class="select2" name="owner_spouse_id">
                                                <option value="" selected>Não informado</option>
                                            </select>
                                        </label>
                                    </div>

                                    <label class="label"> <span class="legend">Empresa:</span> <select class="select2" name="owner_company_id">
                                            <option value="" selected>Não informado</option>
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
                                            <select name="acquirer_id" class="select2" onchange="changeAcquirer(this)"  data-action="{{ route('admin.contracts.getDataAcquirer') }}">
                                                <option value="" selected>Informe um Cliente</option>
                                                @foreach($lessees->get() as $lessee)
                                                    <option value="{{ $lessee->id }}">{{ $lessee->name }} ({{ $lessee->document }})</option>
                                                @endforeach
                                            </select>
                                        </label>

                                        <label class="label"> <span class="legend">Conjuge Adquirente:</span>
                                            <select class="select2" name="acquirer_spouse">
                                                <option value="" selected>Não informado</option>
                                            </select> </label>
                                    </div>

                                    <label class="label"> <span class="legend">Empresa:</span> <select name="acquirer_company_id" class="select2">
                                            <option value="" selected>Não informado</option>
                                        </select> </label>
                                </div>
                            </div>

                            <div class="app_collapse">
                                <div class="app_collapse_header mt-2 collapse">
                                    <h3>Parâmetros do Contrato</h3>
                                    <span class="icon-minus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content">
                                    <label class="label"> <span class="legend">Imóvel:</span> <select name="property" class="select2">
                                            <option value="">Não informado</option>
                                        </select> </label>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Valor de Venda:</span>
                                            <input type="tel" name="sale_price" class="mask-money" placeholder="Valor de Venda" disabled/>
                                        </label>

                                        <label class="label"> <span class="legend">Valor de Locação:</span>
                                            <input type="text" name="rent_price" class="mask-money" placeholder="Valor de Locação" disabled/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">IPTU:</span>
                                            <input type="text" name="tribute" class="mask-money" placeholder="IPTU" value=""/>
                                        </label>

                                        <label class="label"> <span class="legend">Condomínio:</span>
                                            <input type="text" name="condominium" class="mask-money" placeholder="Valor do Condomínio" value=""/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label"> <span class="legend">Dia de Vencimento:</span> <select name="due_date" class="select2">
                                                <option value="1">1º</option>
                                                <option value="2">2/mês</option>
                                                <option value="3">3/mês</option>
                                                <option value="4">4/mês</option>
                                                <option value="5">5/mês</option>
                                                <option value="6">6/mês</option>
                                                <option value="7">7/mês</option>
                                                <option value="8">8/mês</option>
                                                <option value="9">9/mês</option>
                                                <option value="10">10/mês</option>
                                                <option value="11">11/mês</option>
                                                <option value="12">12/mês</option>
                                                <option value="13">13/mês</option>
                                                <option value="14">14/mês</option>
                                                <option value="15">15/mês</option>
                                                <option value="16">16/mês</option>
                                                <option value="17">17/mês</option>
                                                <option value="18">18/mês</option>
                                                <option value="19">19/mês</option>
                                                <option value="20">20/mês</option>
                                                <option value="21">21/mês</option>
                                                <option value="22">22/mês</option>
                                                <option value="23">23/mês</option>
                                                <option value="24">24/mês</option>
                                                <option value="25">25/mês</option>
                                                <option value="26">26/mês</option>
                                                <option value="27">27/mês</option>
                                                <option value="28">28/mês</option>
                                            </select> </label>

                                        <label class="label"> <span class="legend">Prazo do Contrato (Em meses)</span> <select name="deadline" class="select2">
                                                <option value="12">12 meses</option>
                                                <option value="24">24 meses</option>
                                                <option value="36">36 meses</option>
                                                <option value="48">48 meses</option>
                                            </select> </label>
                                    </div>

                                    <label class="label"> <span class="legend">Data de Início:</span>
                                        <input type="tel" name="start_at" class="mask-date" placeholder="Data de Início" value=""/>
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


        });

        function changeOwner(element) {
            let owner = $(element)
            let owner_id = owner.val()
            let action = owner.data('action')


            $.post(action,{id:owner_id},(response)=>{

                /** Spouse     */
                let owner_spouse = $('select[name="owner_spouse_id"]')
                owner_spouse.html('')
                if (!!response.spouse.spouse_name){
                    owner_spouse.append($('<option>',{
                        value: 0,
                        text: 'Não informar'
                    }))
                    owner_spouse.append($('<option>',{
                        value: response.spouse.spouse_name,
                        text: `${response.spouse.spouse_name} - (${response.spouse.spouse_document})`
                    }))
                }else{
                    owner_spouse.append($('<option>',{
                        value: 0,
                        text: 'Não informado'
                    }))
                }
                /** Companies     */
                let owner_company = $('select[name="owner_company_id"]')
                owner_company.html('')
                if (!!response.companies.length){
                    owner_company.append($('<option>',{
                        value: 0,
                        text: 'Não informar'
                    }))
                    $.each(response.companies, (key, company)=>{
                        owner_company.append($('<option>',{
                            value: company.id,
                            text: `${company.alias_name} - (${company.document_company})`
                        }))
                    })

                }else{
                    owner_company.append($('<option>',{
                        value: '',
                        text: 'Não informado'
                    }))
                }
            },'json')
        }


        function changeAcquirer(element) {
            let acquirer = $(element)
            let acquirer_id = acquirer.val()
            let action = acquirer.data('action')


            $.post(action,{id:acquirer_id},(response)=>{

                /** Spouse     */
                let acquirer_spouse = $('select[name="acquirer_spouse_id"]')
                acquirer_spouse.html('')
                if (!!response.spouse.spouse_name){
                    acquirer_spouse.append($('<option>',{
                        value: 0,
                        text: 'Não informar'
                    }))
                    acquirer_spouse.append($('<option>',{
                        value: response.spouse.spouse_name,
                        text: `${response.spouse.spouse_name} - (${response.spouse.spouse_document})`
                    }))
                }else{
                    acquirer_spouse.append($('<option>',{
                        value: 0,
                        text: 'Não informado'
                    }))
                }
                /** Companies     */
                let acquirer_company = $('select[name="acquirer_company_id"]')
                acquirer_company.html('')
                if (!!response.companies.length){
                    acquirer_company.append($('<option>',{
                        value: 0,
                        text: 'Não informar'
                    }))
                    $.each(response.companies, (key, company)=>{
                        acquirer_company.append($('<option>',{
                            value: company.id,
                            text: `${company.alias_name} - (${company.document_company})`
                        }))
                    })

                }else{
                    acquirer_company.append($('<option>',{
                        value: '',
                        text: 'Não informado'
                    }))
                }
            },'json')
        }
    </script>
@endsection
