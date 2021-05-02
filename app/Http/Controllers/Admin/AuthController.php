<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User as UserModel;
use App\Models\Property as PropertyModel;
use App\Models\Contract as ContractModel;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()=== true) {
            return redirect()->route('admin.home');
        }
        return view('admin.index');
    }

    public function home()
    {
        $lessors = UserModel::lessors()->count();
        $lessees = UserModel::lessees()->count();
        $team = UserModel::where('admin',1)->count();

        $propertiesAvailable = PropertyModel::available()->count();
        $propertiesUnavailable = PropertyModel::unavailable()->count();
        $propertiesTotal = PropertyModel::all()->count();

        $contractsPending = ContractModel::pendent()->count();
        $contractsActive = ContractModel::active()->count();
        $contractsCanceled = ContractModel::canceled()->count();
        $contractsLeased = ContractModel::leased()->count();

        $contractsTotal = ContractModel::all()->count();

        $contracts = ContractModel::orderBy('id','desc')->limit(10)->get();
        $properties = PropertyModel::orderBy('id','desc')->limit(10)->get();
        $propertyModel = new PropertyModel();
        $list_category = $propertyModel->list_category;
        $list_type_simple = [];
        foreach ($propertyModel->list_type as $types){
            foreach ($types as $key => $type) {
                $list_type_simple[$key] = $type;
            }
        }

        return view('admin.dashboard',[
            'lessors' => $lessors,
            'lessees' => $lessees,
            'team' => $team,

            'propertyAvailable' => $propertiesAvailable,
            'propertyUnavailable' => $propertiesUnavailable,
            'propertyTotal' => $propertiesTotal,

            'contractsPending' => $contractsPending,
            'contractsActive' => $contractsActive,
            'contractsCanceled' => $contractsCanceled,
            'contractsLeased' => $contractsLeased,
            'contractsTotal' => $contractsTotal,
            'contracts' => $contracts,
            'properties' => $properties,
            'list_category' => $list_category,
            'list_type_simple' => $list_type_simple
        ]);
    }

    public function login(Request $request)
    {
        if (in_array('',$request->only('email','password'))) {
            $json['message'] = $this->message->error('Ops, informe os dados para efetuar login.')->render();
            return  response()->json($json);
        }

        if (!filter_var($request->email,FILTER_VALIDATE_EMAIL)) {
            $json['message'] = $this->message->error('Ops, informe um email válido.')->render();
            return  response()->json($json);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {
            $json['message'] = $this->message->error('Ops, usário e senha inválido')->render();
            return  response()->json($json);
        }

        $this->authenticated($request->getClientIp());
        $json['redirect'] = route('admin.home');
        return  response()->json($json);

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    private function authenticated(string $ip)
    {
        $user = User::where('id',Auth::user()->id);
        $user->update([
            'last_login_at' => date('Y-m-d h:i:s'),
            'last_login_ip' => $ip
        ]);
    }
}
