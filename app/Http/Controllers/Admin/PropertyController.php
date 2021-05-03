<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\PropertyRequest;
    use App\Models\PropertiesImage;
    use App\Models\Property as PropertyModel;
    use App\Models\User;
    use App\Models\User as UserModel;
    use App\Support\Cropper;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Str;

    class PropertyController extends Controller
    {

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $propertyModel = new PropertyModel();
            $properties = $propertyModel->orderBy('id', 'DESC')->get();

            $list_type_simple = [];
            foreach ($propertyModel->list_type as $types){
                foreach ($types as $key => $type) {
                    $list_type_simple[$key] = $type;
                }
            }
            return view('admin.properties.index', [
                'properties' => $properties,
                'list_category' => $propertyModel->list_category,
                'list_type' => $propertyModel->list_type,
                'list_type_simple' => $list_type_simple
            ]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $users = UserModel::select('id', 'name', 'document')->orderBy('name')->get();
            $property = new PropertyModel();
            return view('admin.properties.create', [
                'list_category' => $property->list_category,
                'list_type' => $property->list_type,
                'users' => $users
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(PropertyRequest $request)
        {

            $property = PropertyModel::create($request->all());
            $property->setSlug();
            return redirect()->route('admin.properties.edit', [
                'property' => $property->id
            ])->with([
                'color' => 'green',
                'message' => 'Imóvel salvo com sucesso.'
            ]);
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
            $property = PropertyModel::where('id', $id)->first();

            $users = UserModel::select('id', 'name', 'document')->orderBy('name')->get();

            return view('admin.properties.edit', [
                'list_category' => $property->list_category,
                'list_type' => $property->list_type,
                'users' => $users,
                'property' => $property
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(PropertyRequest $request, $id)
        {
            $property = PropertyModel::where('id', $id)->first();
            $property->setSaleAttribute($request->sale);
            $property->setRentAttribute($request->rent);
            $property->setTypeAttribute($request->type);
            $property->setCategoryAttribute($request->category);
            $property->setAirConditioningAttribute($request->air_conditioning);
            $property->setBarAttribute($request->bar);
            $property->setLibraryAttribute($request->library);
            $property->setBarbecueGrillAttribute($request->barbecue_grill);
            $property->setAmericanKitchenAttribute($request->american_kitchen);
            $property->setFittedKitchenAttribute($request->fitted_kitchen);
            $property->setPantryAttribute($request->pantry);
            $property->setEdiculeAttribute($request->edicule);
            $property->setOfficeAttribute($request->office);
            $property->setBathtubAttribute($request->bathtub);
            $property->setFireplaceAttribute($request->fireplace);
            $property->setLavatoryAttribute($request->lavatory);
            $property->setFurnishedAttribute($request->furnished);
            $property->setPoolAttribute($request->pool);
            $property->setSteamRoomAttribute($request->steam_room);
            $property->setViewOfTheSeaAttribute($request->view_of_the_sea);
            $property->setStatusAttribute($request->status);
            $property->fill($request->all());
            $property->save();

            $property->setSlug();

            $validator = Validator::make($request->only('files'), ['files.*' => 'image']);

            if (!!$validator->fails()) {
                return redirect()->back()->withInput()->with([
                    'color' => 'orange',
                    'message' => 'Todas as imagens devem ser dos tipos: jpg, jpeg ou png'
                ]);
            }
            if ($request->allFiles()) {
                foreach ($request->allFiles()['files'] as $file) {
                    $propertyImage = new PropertiesImage();
                    $propertyImage->property_id = $property->id;
                    $propertyImage->path = $file->storeAs(
                        'properties/' . $property->id, Str::slug($request->title) . '-' . str_replace('.',
                            '',
                            microtime(true)) . '.' . $file->extension()
                    );
                    $propertyImage->save();
                    unset($propertyImage);
                }
            }


            return redirect()->route('admin.properties.edit', [
                'property' => $property->id
            ])->with([
                'color' => 'green',
                'message' => 'Imóvel atualizado com sucesso.'
            ]);
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

        public function imageSetCover(Request $request)
        {
            $currentImageProperty = PropertiesImage::where('id', $request->image)->first();

            $allImagesProperty = PropertiesImage::where('property_id', $currentImageProperty->property_id)->get();

            foreach ($allImagesProperty as $image) {
                $image->cover = false;
                $image->save();
            }
            $currentImageProperty->cover = true;
            $currentImageProperty->save();
            $json = [
                'success' => true
            ];
            return response()->json($json);
        }

        public function imageRemove(Request $request)
        {
            $currentImageProperty = PropertiesImage::where('id', $request->image)->first();
            $success = false;
            if ($currentImageProperty) {

                if (!!$currentImageProperty->delete()) {
                    $success = true;

                    Storage::delete($currentImageProperty->path);
                    Cropper::flush($currentImageProperty->path);

                    $defaultImageProperty = PropertiesImage::where('property_id', $currentImageProperty->property_id)->first();
                    if ($defaultImageProperty) {
                        $defaultImageProperty->cover = true;
                        $defaultImageProperty->save();
                    }

                    $defaultImageId = $defaultImageProperty->id ?? '';
                }
            }
            $json = [
                'success' => $success,
                'defaultImageId' => $defaultImageId ?? ''
            ];

            return response()->json($json);

        }
    }
