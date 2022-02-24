<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('admin.login.login', [
            'title' => 'Login'
        ]);
    }

    public function LoginAdmin(Request $request){
        if($this->validation($request) == true){
            if(Auth::attempt([
                'email' => $request->input('admin_email'),
                'password' => $request->input('admin_password')
            ])){
                $request->session()->put('success', 'Login Success');
                return redirect()->route('dashboard');
            }else{
                $request->session()->put('message', 'Login Failed');
                return redirect()->back();
            }
        }else{
            $request->session()->put('message', 'Login Failed');
            return redirect()->back();
        }
    }

    public function validation(Request $request) {
        return $this->validate($request, [
            'admin_email' => 'required|email:filter|max:255',
            'admin_password' => 'required|max:255'
        ]);
    }
}
