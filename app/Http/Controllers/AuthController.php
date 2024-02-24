<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{


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

        return redirect('/')->with('msg_success', 'Registrasi Berhasil');
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
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }


        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect('/')->withErrors(['error' => 'Email tidak terdaftar'])->withInput();
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect('/')->witherrors(['error' => 'Password salah'])->withInput();
        }
        $request->session()->put('user', $user);
        return redirect('/home');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $request->session()->forget('user');
        return redirect()->route('/');
    }
}
