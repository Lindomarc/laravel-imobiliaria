<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Property as PropertyModel;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        $propertiesForSales = PropertyModel::sale()->available()->limit(3)->get();
        $propertiesForRents = PropertyModel::rent()->available()->limit(3)->get();

        return view('web.home',[
            'propertiesForSales' => $propertiesForSales,
            'propertiesForRents' => $propertiesForRents
        ]);
    }
    public function contact()
    {
        return view('web.contact');
    }

    public function rent()
    {
        return view('web.filter');
    }
    public function rentProperty(Request $request)
    {
        $property = PropertyModel::where('slug',$request->slug)->first();
        return view('web.property',[
            'property'=>$property
        ]);
    }

    public function buy()
    {
        return view('web.filter');
    }
    public function buyProperty(Request $request)
    {
        $property = PropertyModel::where([
                'slug' => $request->slug
            ]
        )->first();
        return view('web.property',[
            'property'=>$property
        ]);
    }

    public function filter()
    {
        $filter = new FilterController();
        $itensProperties = $filter->createQuery('id');

        $listIds = [];
        foreach ($itensProperties as $property){
            $listIds[] = $property->id;
        }


        $properties = [];
        if ($listIds) {
            $properties = PropertyModel::whereIn('id',$listIds)->get();
        }

        return view('web.filter',[
            'properties' => $properties
        ]);
    }
}
