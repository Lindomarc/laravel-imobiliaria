<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\ContractRequest;
    use App\Models\Contract as ContractModel;
    use App\Models\Property as PropertyModel;
    use App\Models\User as UserModel;
    use Illuminate\Http\Request;

    class ContractController extends Controller
    {

        public $listDueDate = [
            1 => '1º',
            2 => '2/mês',
            3 => '3/mês',
            4 => '4/mês',
            5 => '5/mês',
            6 => '6/mês',
            7 => '7/mês',
            8 => '8/mês',
            9 => '9/mês',
            10 => '10/mês',
            11 => '11/mês',
            12 => '12/mês',
            13 => '13/mês',
            14 => '14/mês',
            15 => '15/mês',
            16 => '16/mês',
            17 => '17/mês',
            18 => '18/mês',
            19 => '19/mês',
            20 => '20/mês',
            21 => '21/mês',
            22 => '22/mês',
            23 => '23/mês',
            24 => '24/mês',
            25 => '25/mês',
            26 => '26/mês',
            27 => '27/mês',
            28 => '28/mês',
        ];

        public $listDeadline = [
            12 => '12 meses',
            24 => '24 meses',
            36 => '36 meses',
            46 => '48 meses',
        ];

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('admin.contracts.index');
        }


        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $lessors = UserModel::lessors();
            $lessees = UserModel::lessees();

            return view('admin.contracts.create', [
                'lessors' => $lessors,
                'lessees' => $lessees,
                'list_due_date' => $this->listDueDate,
                'list_deadline' => $this->listDeadline
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(ContractRequest $request)
        {
            dd($request->all());
        }

        /**
         * Display the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            return view('admin.contracts.edit');
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }

        public function getDataOwner(Request $request)
        {
            $lessor = UserModel::where('id', $request->id)->first([
                'id',
                'civil_status',
                'spouse_name',
                'spouse_document'
            ]);

            $spouse = $companies = $properties = [];
            $success = false;
            if (!empty($lessor->civil_status)) {
                $civilStatusSpouseRequired = [
                    '1',// married
                    '2' // separated
                ];

                if (in_array($lessor->civil_status, $civilStatusSpouseRequired)) {
                    $spouse = [
                        'spouse_name' => $lessor->spouse_name,
                        'spouse_document' => $lessor->spouse_document
                    ];
                }

                $companies = $lessor->companies()->get([
                    'id',
                    'alias_name',
                    'document_company'
                ]);

                $getProperties = $lessor->properties()->get([
                    'id', 'street', 'number', 'complement', 'neighborhood', 'city', 'state', 'zipcode'
                ]);

                foreach ($getProperties as $property) {
                    $properties[] = [
                        'id' => $property->id,
                        'description' => "#{$property->id} {$property->street}, {$property->number}
                        {$property->complement} - {$property->neighborhood} - {$property->city}/{$property->state}
                        ({$property->zipcode})"
                    ];
                }

                $success = true;

            }

            $json = [
                'spouse' => $spouse,
                'companies' => $companies,
                'properties' => $properties,
                'success' => $success
            ];

            return response()->json($json);
        }

        public function getDataAcquirer(Request $request)
        {
            $lessee = UserModel::where('id', $request->id)->first([
                'id',
                'civil_status',
                'spouse_name',
                'spouse_document'
            ]);

            $spouse = [];
            $companies = [];
            $properties = [];
            $success = false;
            if (!empty($lessee->civil_status)) {
                $civilStatusSpouseRequired = [
                    '1',// married
                    '2' // separated
                ];

                if (in_array($lessee->civil_status, $civilStatusSpouseRequired)) {
                    $spouse = [
                        'spouse_name' => $lessee->spouse_name,
                        'spouse_document' => $lessee->spouse_document
                    ];
                }

                $companies = $lessee->companies()->get([
                    'id',
                    'alias_name',
                    'document_company'
                ]);
                $success = true;

            }


            $json = [
                'spouse' => $spouse,
                'companies' => $companies,
                'success' => $success
            ];

            return response()->json($json);
        }

        public function getDataProperty(Request $request)
        {
            $property = PropertyModel::where('id', $request->id)->first([
                'id',
                'sale_price',
                'rent_price',
                'tribute',
                'condominium'
            ]);
            $success = false;

            if ($property) {
                $success = true;
            }

            $json = [
                'property' => $property,
                'success' => $success
            ];
            return response()->json($json);
        }
    }
