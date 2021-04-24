<?php

    namespace App\Models;

    use App\Support\Cropper;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Storage;

    class Property extends Model
    {
        use HasFactory;

        protected $fillable = [
            'sale',
            'rent',
            'category',
            'type',
            'user_id',
            'sale_price',
            'rent_price',
            'tribute',
            'condominium',
            'description',
            'bedrooms',
            'suites',
            'bathrooms',
            'rooms',
            'garage',
            'garage_covered',
            'area_total',
            'area_util',
            'zipcode',
            'street',
            'number',
            'complement',
            'neighborhood',
            'state',
            'city',
            'air_conditioning',
            'bar',
            'library',
            'barbecue_grill',
            'american_kitchen',
            'fitted_kitchen',
            'pantry',
            'edicule',
            'office',
            'bathtub',
            'fireplace',
            'lavatory',
            'furnished',
            'pool',
            'steam_room',
            'view_of_the_sea'
        ];

        public $list_category = [
            1 => 'Imóvel Residencial',
            2 => 'Comercial/Industrial',
            3 => 'Terreno'
        ];

        public $list_type = [
            'Imóvel Residencial' => [
                1 => 'Casa',
                2 => 'Cobertura',
                3 => 'Apartamento',
                4 => 'Studio',
                5 => 'Kitnet'
            ],
            'Comercial/Industrial' => [
                6 => 'Sala Comercial',
                7 => 'Depósito/Galpão',
                8 => 'Ponto Comercial'
            ],
            'Terreno' => [
                9 => 'Terreno'
            ]
        ];

        public function images()
        {
            return $this->hasMany(PropertiesImage::class,'property_id','id')
                ->orderBy('cover','desc');
        }


        public function getDefaultCoverAttribute($value)
        {
            $image = $this->images()->where('cover',1)->first();
            if(!!$image){
                $value = Storage::url(Cropper::thumb($image->path,1366,768)); ;
            } else {
                $value = url('backend/assets/images/realty.jpeg');
            }
            return $value;
        }
        public function getCoverAttribute($value)
        {
            if(isset($this->images()->get()[0]['path'])){
                $value = Storage::url(Cropper::thumb($this->images()->get()[0]['path'],1366,768)); ;
            }
            return $value;
        }

        public function setSaleAttribute($value)
        {
            $this->attributes['sale'] = (!!$value) ? 1 : 0;
        }
        public function setRentAttribute($value)
        {
            $this->attributes['rent'] = (!!$value) ? 1 : 0;
        }
        public function setTypeAttribute($value)
        {
            $this->attributes['type'] =  (!!$value) ? 1 : 0;
        }
        public function setCategoryAttribute($value)
        {
            $this->attributes['category'] =  (!!$value) ? 1 : 0;
        }
        public function setSalePriceAttribute($value)
        {
            $this->attributes['sale_price'] = fixDouble($value);
        }
        public function setRentPriceAttribute($value)
        {
            $this->attributes['rent_price'] = fixDouble($value);
        }
        public function setTributeAttribute($value)
        {
            $this->attributes['tribute'] = fixDouble($value);
        }
        public function setCondominiumAttribute($value)
        {
            $this->attributes['condominium'] = fixDouble($value);
        }
        public function setAirConditioningAttribute($value)
        {
            $this->attributes['air_conditioning'] = (!!$value) ? 1 : 0;
        }
        public function setBarAttribute($value)
        {
            $this->attributes['bar'] = (!!$value) ? 1 : 0;
        }
        public function setLibraryAttribute($value)
        {
            $this->attributes['library'] = (!!$value) ? 1 : 0;
        }
        public function setBarbecueGrillAttribute($value)
        {
            $this->attributes['barbecue_grill'] = (!!$value) ? 1 : 0;
        }
        public function setOfficeAttribute($value)
        {
            $this->attributes['office'] = (!!$value) ? 1 : 0;
        }
        public function setBathtubAttribute($value)
        {
            $this->attributes['bathtub'] = (!!$value) ? 1 : 0;
        }
        public function setFireplaceAttribute($value)
        {
            $this->attributes['fireplace'] = (!!$value) ? 1 : 0;
        }
        public function setLavatoryAttribute($value)
        {
            $this->attributes['lavatory'] = (!!$value) ? 1 : 0;
        }
        public function setFurnishedAttribute($value)
        {
            $this->attributes['furnished'] = (!!$value) ? 1 : 0;
        }
        public function setPoolAttribute($value)
        {
            $this->attributes['pool'] = (!!$value) ? 1 : 0;
        }
        public function setSteamRoomAttribute($value)
        {
            $this->attributes['steam_room'] = (!!$value) ? 1 : 0;
        }
        public function setViewOfTheSeaAttribute($value)
        {
            $this->attributes['view_of_the_sea'] = (!!$value) ? 1 : 0;
        }
        public function setAmericanKitchenAttribute($value)
        {
            $this->attributes['american_kitchen'] = (!!$value) ? 1 : 0;
        }
        public function setFittedKitchenAttribute($value)
        {
            $this->attributes['fitted_kitchen'] = (!!$value) ? 1 : 0;
        }
        public function setPantryAttribute($value)
        {
            $this->attributes['pantry'] = (!!$value) ? 1 : 0;
        }
        public function setEdiculeAttribute($value)
        {
            $this->attributes['edicule'] = (!!$value) ? 1 : 0;
        }
    }
