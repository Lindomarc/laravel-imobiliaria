<?php

    namespace App\Http\Controllers\Admin\ACL;

    use App\Http\Requests\Admin\PermissionRequest;
    use Illuminate\Http\Request;
    use Spatie\Permission\Models\Permission;
    use App\Http\Controllers\Controller;

    class PermissionController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $permissions = Permission::all();

            return view('admin.permissions.index', [
                'permissions' => $permissions
            ]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('admin.permissions.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(PermissionRequest $request)
        {

            $permission = Permission::create($request->all());

            return redirect()->route('admin.permission.index')->with([
                'color' => 'green',
                'message' => 'Salvo com sucesso'
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
            $permission = Permission::findById($id);
            return view('admin.permissions.edit', [
                'permission' => $permission
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(PermissionRequest $request, $id)
        {
            $permission = Permission::findById($id);


            $permission->fill($request->all());
            $permission->save();
            return redirect()->route('admin.permission.edit', $permission->id)->with([
                'color' => 'green',
                'message' => 'Atualizado com sucesso'
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
            $permission = Permission::findById($id);
            $permission->delete();
            return redirect()->route('admin.permission.index')->with([
                'color' => 'green',
                'message' => 'Removido com sucesso'
            ]);
        }
    }
