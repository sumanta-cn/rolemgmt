<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminDetails as Admin;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLogin() {

        return view('login');
    }

    public function loginCheck(Request $request) {

        $this->validate($request, [
            'email' => 'required|max:255',
            'password' => 'required',
        ]);

        $ismatch = Admin::where('email', $request->email)->first();
        $pwdmatch = Hash::check($request->password, $ismatch->password);

        if($pwdmatch) {

            Session::put('username', $ismatch->full_name);
        }

        return redirect()->route('home');
    }
}
