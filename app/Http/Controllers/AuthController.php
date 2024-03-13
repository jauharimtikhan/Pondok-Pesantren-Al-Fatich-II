<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    public function registerView(): View
    {
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'required' => ':attribute harus diisi',
            'email' => ':attribute harus valid',
            'min' => ':attribute minimal :min karakter',
            'unique' => ':attribute harus unik',
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect('login')->with('msg_success', 'Registrasi Berhasil');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'required' => ':attribute harus diisi',
            'email' => ':attribute harus valid',
            'min' => ':attribute minimal :min karakter',
        ]);

        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }


        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect('login')->withErrors(['error' => 'Email tidak terdaftar'])->withInput();
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect('login')->witherrors(['error' => 'Password salah'])->withInput();
        }
        // $request->session()->put('user', $user);
        // return redirect('/home');

        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect('login')->witherrors(['error' => 'Email atau Password salah'])->withInput();
        }
        $request->session()->regenerate();
        return redirect()->route('home');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
