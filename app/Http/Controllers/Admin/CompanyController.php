<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company as CompanyModel;
use http\Client\Curl\User;
use \App\Models\User as UserModel;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CompanyRequest ;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = CompanyModel::all();

        return view('admin.companies.index',[
            'results' => $results
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users = UserModel::orderBy('name')->get();
        return view('admin.companies.create', [
            'users' => $users,
            'selectedUser' => $request->user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Admin\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company =  CompanyModel::create($request->all());

        return redirect()->route('admin.companies.index', [
            'company' => $company->id
        ])->with([
            'color' => 'green',
            'message' => 'Registro salvo com sucesso.'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = CompanyModel::where('id',$id)->first();
        $users = UserModel::orderBy('name')->get();

        $item->document_company = onlyNumber($item->document_company);

        return view('admin.companies.edit',[
            'item' => $item,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\CompanyRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company =  CompanyModel::where('id',$id)->first();
        $company->fill($request->all());
        $company->save();
        return redirect()->route('admin.companies.edit',$id)->with([
            'color' => 'green',
            'message' => 'Empresa atualizada com sucesso'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
