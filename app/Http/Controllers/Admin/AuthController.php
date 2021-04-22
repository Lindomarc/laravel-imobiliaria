<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.dashboard');
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
