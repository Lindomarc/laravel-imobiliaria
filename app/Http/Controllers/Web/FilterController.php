<?php

    namespace App\Http\Controllers\Web;

    use App\Http\Controllers\Controller;
    use App\Models\Property as PropertyModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class FilterController extends Controller
    {
        public function search(Request $request)
        {
            $json = [
                'status' => 'fail',
                'data' => '',
                'message' => 'Não há registros nesta pesquisa.'
            ];

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

            if (isset($properties) && $properties->count()) {

                $propertyModel = new PropertyModel();
                $list_category = $propertyModel->list_category;
                $category = array();
                foreach ($properties as $categoryProperty) {
                    $category[$categoryProperty->category] = $list_category[$categoryProperty->category];
                }

                $collect = collect($category)->unique()->toArray();
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

            return DB::table('properties')
                ->when($sale, function ($query, $sale) {
                    return $query->where('sale', $sale);
                })
                ->when($rent, function ($query, $rent) {
                    return $query->where('rent', $rent);
                })
                ->get([$field]);
        }
    }
