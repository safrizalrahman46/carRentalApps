<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials)) {
        //     $user = Auth::user();

        //     if ($user->role == 'admin') {
        //         return redirect()->route('admin.dashboard');
        //     } elseif ($user->role == 'departemen') {
        //         return redirect()->route('departemen.dashboard');
        //     } elseif ($user->role == 'kepala_seksi') {
        //         return redirect()->route('kepala_seksi.dashboard');
        //     } elseif ($user->role == 'staf') {
        //         return redirect()->route('staf.dashboard');
        //     }
        // }

        return redirect('/')->withErrors(['email' => 'Invalid credentials']);
    }



    public function index()
    {

        if (Auth::check()) {
            return Redirect('/dashboard');
        }

        return view('admin.login');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function prosesLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $kredensil = $request->only('email', 'password');

        if (Auth::attempt($kredensil)) {
            $user = Auth::user();
            return redirect()->intended('dashboard');
        }

        return redirect('/')
            ->withInput()
            ->withErrors(['error' => 'Username atau password invalid.']);

    }

    public function signout()
    {
        FacadesSession::flush();
        Auth::logout();
        return Redirect('/backoffice/login');

        // return view('admin.login');
    }


    public function logout()
    {
        FacadesSession::flush();
        Auth::logout();
        return Redirect('/');

        // return view('admin.login');
    }


}
