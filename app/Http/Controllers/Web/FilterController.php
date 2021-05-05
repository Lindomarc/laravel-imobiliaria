<?php

    namespace App\Http\Controllers\Web;

    use App\Http\Controllers\Controller;
    use App\Models\Property as PropertyModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class FilterController extends Controller
    {
        private $PropertyModel;

        /**
         * FilterController constructor.
         */
        public function __construct()
        {
            parent::__construct();

            $this->PropertyModel = new PropertyModel();

        }

        public function search(Request $request)
        {
            $json = [
                'status' => 'fail',
                'data' => '',
                'message' => 'Não há registros nesta pesquisa.'
            ];

            session()->remove('category');
            session()->remove('type');
            session()->remove('neighborhood');
            session()->remove('bedrooms');

            if (isset($request->search)) {
                if ($request->search === 'buy') {
                    session()->put('sale', true);
                    session()->remove('rent');
                    $properties = $this->createQuery('category');
                }
                if ($request->search === 'rent') {
                    session()->put('rent', true);
                    session()->remove('sale');
                    $properties = $this->createQuery('category');
                }
            }

            if (isset($properties) && $properties->count()) {

                $list_category = $this->PropertyModel->list_category;

                $category = array();
                foreach ($properties as $property) {
                    $category[$property->category] = $list_category[$property->category];
                }

                $collect = collect($category)->unique()->toArray();
                $json = $this->setResponse('success', $collect, '');
            }

            return response()->json($json);
        }

        public function category(Request $request)
        {
            $json = [
                'status' => 'fail',
                'data' => '',
                'message' => 'Não há registros nesta pesquisa.'
            ];

            session()->remove('type');
            session()->remove('neighborhood');
            session()->remove('bedrooms');

            session()->put('category', $request->search);

            $properties = $this->createQuery('type');

            if (isset($properties) && $properties->count()) {
                $type = array();
                foreach ($properties as $property) {
                    $this->PropertyModel->type = $property->type;
                    $type[$property->type] = $this->PropertyModel->type_text;
                }

                $collect = collect($type)->unique()->toArray();
                $json = $this->setResponse('success', $collect, '');
            }

            return response()->json($json);
        }

        public function type(Request $request)
        {
            $json = [
                'status' => 'fail',
                'data' => '',
                'message' => 'Não há registros nesta pesquisa.'
            ];

            session()->remove('category');
            session()->remove('neighborhood');
            session()->remove('bedrooms');

            session()->put('type', $request->search);

            $properties = $this->createQuery('neighborhood');

            if ($properties->count()) {

                $neighborhoods = array();
                foreach ($properties as $property) {
                    $neighborhoods[$property->neighborhood] = $property->neighborhood;
                }

                $collect = collect($neighborhoods)->unique()->toArray();
                $json = $this->setResponse('success', $collect, '');
            }

            return response()->json($json);
        }

        public function neighborhood(Request $request)
        {
            $json = [
                'status' => 'fail',
                'data' => '',
                'message' => 'Não há registros nesta pesquisa.'
            ];
            session()->remove('bedrooms');

            session()->put('neighborhood', $request->search);

            $properties = $this->createQuery('bedrooms');


            if ($properties->count()) {

                $bedrooms = array('' => 'Todos');

                foreach ($properties as $property) {
                    if ($property->bedrooms === 0) {
                        $bedrooms['no_bedrooms'] = "Sem quarto";
                    } else {
                        $plural = ($property->bedrooms === 1) ? 'quarto' : 'quartos';
                        $bedrooms[$property->bedrooms] = "{$property->bedrooms} {$plural}";
                    }
                }

                $collect = collect($bedrooms)->unique()->toArray();
                $json = $this->setResponse('success', $collect, '');
            }

            return response()->json($json);
        }

        public function bedrooms(Request $request)
        {
            $json = [
                'status' => 'fail',
                'data' => '',
                'message' => 'Não há registros nesta pesquisa.'
            ];

            session()->put('bedrooms', $request->search);
            session()->remove('neighborhood');

            $properties = $this->createQuery('suites');

            if ($properties->count()) {

                $suites = array('' => 'Todos');
                foreach ($properties as $property) {
                    if ($property->suites === 0) {
                        $suites['no_suites'] = "Sem suítes";
                    } else {
                        $plural = ($property->suites === 1) ? 'suíte' : 'suítes';
                        $suites[$property->suites] = "{$property->suites} {$plural}";
                    }
                }

                $collect = collect($suites)->unique()->toArray();

                $json = $this->setResponse('success', $collect, '');
            }

            return response()->json($json);
        }

        private function setResponse(string $status, array $data, string $message)
        {
            return [
                'status' => $status,
                'data' => $data,
                'message' => $message
            ];
        }

        private function createQuery($field)
        {
            $sale = session('sale');
            $rent = session('rent');
            $category = session('category');
            $type = session('type');
            $neighborhood = session('neighborhood');
            $bedrooms = session('bedrooms');
            $suites = session('suites');

            return DB::table('properties')
                ->when($sale, function ($query, $sale) {
                    return $query->where('sale', $sale);
                })
                ->when($rent, function ($query, $rent) {
                    return $query->where('rent', $rent);
                })
                ->when($category, function ($query, $category) {
                    return $query->where('category', $category);
                })
                ->when($type, function ($query, $type) {
                    return $query->whereIn('type', $type);
                })
                ->when($neighborhood, function ($query, $neighborhood) {
                    return $query->whereIn('neighborhood', $neighborhood);
                })
                ->when($bedrooms, function ($query, $bedrooms) {
                    $bedrooms = $bedrooms !== 'no_bedrooms' ? $bedrooms : 0;
                    return $query->where('bedrooms', $bedrooms);
                })
                ->when($suites, function ($query, $suites) {
                    $suites = $suites !== 'no_suites' ? $suites : 0;
                    return $query->where('suites', $suites);
                })
                ->get([$field]);
        }
    }
