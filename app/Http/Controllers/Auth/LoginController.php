<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; // Import Route facade

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Menentukan ke mana pengguna harus diarahkan setelah login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Redirect ke named route 'index'
        return redirect()->intended(route('index'));
    }

    /**
     * Membuat instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware untuk memastikan hanya tamu yang dapat mengakses halaman login, dan logout hanya bisa diakses oleh user yang terautentikasi
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
