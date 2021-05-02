<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Illuminate\Http\Response;
use App\Models\User as UserModel;
use App\Support\Cropper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public $list_type_of_communion = [
        1 => 'Comunhão Universal de Bens',
        2 => 'Comunhão Parcial de Bens',
        3 => 'Separação Total de Bens',
        4 => 'Participação Final de Aquestos'
    ];

    public $list_civil_status = [
        'Cônjuge Obrigatório' => [
            1 => 'Casado',
            2 => 'Separado'
        ],
        'Cônjuge não Obrigatório' => [
            3 => 'Solteiro',
            4 => 'Divorciado',
            5 => 'Viúvo'
        ]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $users = UserModel::all();
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }


    public function team()
    {
        $users = UserModel::where('admin', 1)->get();
        return view('admin.users.team', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('admin.users.create', [
            'list_type_of_communion' => $this->list_type_of_communion,
            'list_civil_status' => $this->list_civil_status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return UserRequest
     */
    public function store(UserRequest $request)
    {
        $user = UserModel::create($request->all());
        if ($user) {
            if (!!$request->file('cover')) {
                $user->cover = $request->file('cover')->store('user');
                $user->save();
            }
        }

        return redirect()->route('admin.users.edit', [
            'user' => $user->id
        ])->with([
            'color' => 'green',
            'message' => 'Cliente salvo com sucesso.'
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
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        $user = UserModel::where('id', $id)->first();

        $propertyModel = new \App\Models\Property();
        $list_type_simple = [];
        foreach ($propertyModel->list_type as $types){
            foreach ($types as $key => $type) {
                $list_type_simple[$key] = $type;
            }
        }
        return view('admin.users.edit', [
            'user' => $user,
            'list_type_of_communion' => $this->list_type_of_communion,
            'list_civil_status' => $this->list_civil_status,
            'list_category' => $propertyModel->list_category,
            'list_type_simple' => $list_type_simple,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = UserModel::where('id', $id)->first();
        $user->setLessorAttribute($request->lessor);
        $user->setLesseeAttribute($request->lessee);
        $user->setAdminAttribute($request->admin);
        $user->setClientAttribute($request->client);

        if (!!$user->cover && !!$request->file('cover')) {
            $deleteCover = $user->cover;
        }


        $user->fill($request->all());

        if (!!$request->file('cover')) {
            $user->cover = $request->file('cover')->store('user');
        }

        if (!$user->save()) {
            return redirect()->back()->withInput()->withErrors();
        }
        if (isset($deleteCover)) {
            Storage::delete($deleteCover);
            Cropper::flush($deleteCover);
        }

        return redirect()->route('admin.users.edit', [
            'user' => $user->id
        ])->with([
            'color' => 'green',
            'message' => 'Cliente atualizado com sucesso.'
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
