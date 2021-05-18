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
            session()->remove('suites');
            session()->remove('garage');
            session()->remove('price_base');
            session()->remove('price_limit');

            session()->put('trade', $request->search);

            $properties = $this->createQuery('category');

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
            session()->remove('suites');
            session()->remove('garage');
            session()->remove('price_base');
            session()->remove('price_limit');

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
            session()->remove('suites');
            session()->remove('garage');
            session()->remove('price_base');
            session()->remove('price_limit');

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
            session()->remove('suites');
            session()->remove('garage');
            session()->remove('price_base');
            session()->remove('price_limit');


            session()->put('neighborhood', $request->search);

            $properties = $this->createQuery('bedrooms');


            if ($properties->count()) {

                $bedrooms = array('' => 'Todos');

                foreach ($properties as $property) {
                    if ($property->bedrooms === 0) {
                        $bedrooms['no_bedrooms'] = "Sem quarto";
                    } else {
                        $plural = ($property->bedrooms > 1) ? 'quartos' : 'quarto';
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

            session()->remove('suites');
            session()->remove('garage');
            session()->remove('price_base');
            session()->remove('price_limit');

            session()->put('bedrooms', $request->search);


            $properties = $this->createQuery('suites');

            if ($properties->count()) {

                $suites = array('' => 'Todos');
                foreach ($properties as $property) {
                    if ($property->suites === 0) {
                        $suites['no_suites'] = "Sem suíte";
                    } else {
                        $plural = ($property->suites > 1) ? 'suítes' : 'suíte';
                        $suites[$property->suites] = "{$property->suites} {$plural}";
                    }
                }

                $collect = collect($suites)->unique()->toArray();

                $json = $this->setResponse('success', $collect, '');
            }

            return response()->json($json);
        }

        public function suites(Request $request)
        {
            $json = [
                'status' => 'fail',
                'data' => '',
                'message' => 'Não há registros nesta pesquisa.'
            ];

            session()->remove('garage');
            session()->remove('price_base');
            session()->remove('price_limit');

            session()->put('suites', $request->search);

            $properties = $this->createQuery('bathrooms');

            if ($properties->count()) {
                $bathrooms = array('' => 'Todos');
                foreach ($properties as $property) {
                    if ($property->bathrooms === 0) {
                        $bathrooms['no_bathrooms'] = 'Sem banheiro';
                    } else {
                        $plural = ($property->bathrooms > 1) ? 'banheiros' : 'banheiro';
                        $bathrooms[$property->bathrooms] = "{$property->bathrooms} {$plural}";
                    }
                }
                $collect = collect($bathrooms)->unique()->toArray();
                $json = $this->setResponse('success', $collect, '');
            }
            return response()->json($json);
        }

        public function bathrooms(Request $request)
        {
            $json = [
                'status' => 'fail',
                'data' => '',
                'message' => 'Não há registros nesta pesquisa.'
            ];

            session()->remove('suites');
            session()->remove('garage');
            session()->remove('price_base');
            session()->remove('price_limit');

            session()->put('bathrooms', $request->search);

            $properties = $this->createQuery('garage,garage_covered');
            if ($properties->count()) {
                $garage = array('' => 'Todos');
                foreach ($properties as $property) {
                    if ($property->garage === 0) {
                        $garage['no_garage'] = "Sem garagem";
                    } else {
                        $property->garage += $property->garage_covered;
                        $plural = ($property->garage > 1) ? 'garagens' : 'garagem';
                        $garage[$property->garage] = "{$property->garage} {$plural}";
                    }
                }
                $collect = collect($garage)->unique()->toArray();
                $json = $this->setResponse('success', $collect, '');
            }

            return response()->json($json);
        }

        public function garage(Request $request)
        {
            $json = [
                'status' => 'fail',
                'data' => '',
                'message' => 'Não há registros nesta pesquisa.'
            ];
            session()->remove('bathrooms');
            session()->remove('price_base');
            session()->remove('price_limit');

            session()->put('garage', $request->search);

            $base = session('trade') . '_price as price';

            $properties = $this->createQuery($base);

            if ($properties->count()) {
                $prices = array('' => 'Todos');
                foreach ($properties as $property) {
                    if (isset($property->price)) {
                        $prices[$property->price] = 'À partir de R$ ' . fixDouble($property->price, 'br');
                    }
                }
                $collect = collect($prices)->unique()->toArray();
                $json = $this->setResponse('success', $collect, '');
            }

            return response()->json($json);
        }

        public function priceBase(Request $request)
        {
            $json = [
                'status' => 'fail',
                'data' => '',
                'message' => 'Não há registros nesta pesquisa.'
            ];

            session()->remove('garage');
            session()->remove('price_limit');

            session()->put('price_base', $request->search);

            $base = session('trade') . '_price as price';
            $properties = $this->createQuery($base);

            if ($properties->count()) {
                $limit = array('' => 'Todos');
                foreach ($properties as $property) {
                    if ($property->price) {
                        $limit[$property->price] = 'Até R$ ' . fixDouble($property->price, 'br');
                    }
                }

                $collect = collect($limit)->unique()->toArray();
                $json = $this->setResponse('success', $collect, '');
            }

            return response()->json($json);
        }

        public function priceLimit(Request $request)
        {
            $json = [
                'status' => 'fail',
                'data' => '',
                'message' => 'Não há registros nesta pesquisa.'
            ];

            session()->remove('price_base');
            session('price_limit', $request->search);
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

        public function clearAllData(){
            session()->remove('trade');
            session()->remove('category');
            session()->remove('type');
            session()->remove('neighborhood');
            session()->remove('bedrooms');
            session()->remove('suites');
            session()->remove('garage');
            session()->remove('price_base');
            session()->remove('price_limit');

        }

        public function createQuery($field)
        {
            $sale = session('trade') === 'sale' ?? '';
            $rent = session('trade') === 'rent' ?? '';


            $category = session('category');
            $type = session('type');
            $neighborhood = session('neighborhood');
            $bedrooms = session('bedrooms');
            $suites = session('suites');
            $bathrooms = session('bathrooms');
            $garage = session('garage');
            $priceBase = session('price_base');
            $priceLimit = session('price_limit');


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
                ->when($bathrooms, function ($query, $bathrooms) {
                    $bathrooms = $bathrooms !== 'no_bathrooms' ? $bathrooms : 0;
                    return $query->where('bathrooms', $bathrooms);
                })
                ->when($garage, function ($query, $garage) {
                    $garage = $garage !== 'no_garage' ? $garage : 0;
                    return $query->whereRaw('(garage + garage_covered = ? OR garage = ? OR garage_covered = ?)', [
                        $garage, $garage, $garage
                    ]);
                })
                ->when($priceBase, function ($query, $priceBase) {
                    $field = session('trade') . '_price';
                    return $query->where($field, '>=', $priceBase);
                })
                ->when($priceLimit, function ($query, $priceLimit) {
                    $field = session('trade') . '_price';
                    return $query->where($field, '<=', $priceLimit);
                })
                ->get(explode(',', $field));
        }
    }
