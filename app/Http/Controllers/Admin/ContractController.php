<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use App\Models\User as UserModel;
    use Illuminate\Http\Request;

    class ContractController extends Controller
    {
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
                'lessees' => $lessees
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            //
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

            $spouse = [];
            $companies = [];
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
                $success = true;

            }


            $json = [
                'spouse' => $spouse,
                'companies' => $companies,
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
    }
