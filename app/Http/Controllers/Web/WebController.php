<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Property as PropertyModel;
use Illuminate\Http\Request;

class WebController extends Controller
{

    public function home()
    {
        $headSeo = $this->seo->render(
            getenv('APP_NAME') . ' - Home',
            'lorem ipsum',
            url('/'),
            asset('assets/images/front1.jpg')
        );

        $propertiesForSales = PropertyModel::sale()->available()->limit(3)->get();
        $propertiesForRents = PropertyModel::rent()->available()->limit(3)->get();

        return view('web.home', [
            'propertiesForSales' => $propertiesForSales,
            'propertiesForRents' => $propertiesForRents,
            'headSeo' => $headSeo
        ]);
    }
    public function contact()
    {
        return view('web.contact');
    }

    public function rent()
    {
        $filter = new FilterController();
        $filter->clearAllData();
        session()->put('trade', 'rent');

        $properties = PropertyModel::rent()->available()->get();

        $headSeo = $this->seo->render(
            getenv('APP_NAME') . ' - Para Alugar',
            'lorem ipsum',
            route('web.rent'),
            asset('assets/images/front1.jpg')
        );

        return view('web.filter',[
            'properties' => $properties,
            'headSeo' => $headSeo
        ]);
    }

    public function rentProperty(Request $request)
    {
        $property = PropertyModel::where('slug', $request->slug)->first();

        session('trader', 'rent');

        $headSeo = $this->seo->render(
            getenv('APP_NAME') . ' - Para Alugar',
            'lorem ipsum',
            route('web.rent').'/'.$request->slug,
            $property->cover
        );

        return view('web.property', [
            'property' => $property,
            'headSeo' => $headSeo
        ]);
    }

    public function sale()
    {
        $filter = new FilterController();
        $filter->clearAllData();
        session()->put('trade', 'sale');

        $properties = PropertyModel::sale()->available()->get();

        $headSeo = $this->seo->render(
            getenv('APP_NAME') . ' - Para Comprar',
            'lorem ipsum',
            route('web.sale'),
            asset('assets/images/front1.jpg')
        );

        return view('web.filter',[
            'properties' => $properties,
            'headSeo' => $headSeo
        ]);
    }

    public function saleProperty(Request $request)
    {
        $property = PropertyModel::where([
                'slug' => $request->slug
            ]
        )->first();

        $headSeo = $this->seo->render(
            getenv('APP_NAME') . ' - Para Comprar',
            'lorem ipsum',
            route('web.sale').'/'.$request->slug,
            $property->cover
        );


        return view('web.property',[
            'property'=>$property,
            'headSeo' => $headSeo
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
            $properties = PropertyModel::whereIn('id', $listIds)->get();
        }

        return view('web.filter', [
            'properties' => $properties
        ]);
    }

    public function experiences()
    {
        $filter = new FilterController();
        $filter->clearAllData();

        $properties = PropertyModel::whereNotNull('experience')->get();

        return view('web.filter', [
            'properties' => $properties
        ]);
    }

    public function experiencesCategory(Request $request)
    {
        $filter = new FilterController();
        $filter->clearAllData();


        $properties = new PropertyModel();
        if (isset($request->slug)) {

            $slug = str_replace('-', ' ', $request->slug);
            $results = $properties->where('experience', $slug)->get();

        } else {
            $results = $properties->whereNotNull('experience')->get();
        }

        return view('web.filter', [
            'properties' => $results
        ]);
    }
}
