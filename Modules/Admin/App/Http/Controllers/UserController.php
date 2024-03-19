<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    public function store()
    {
        $users = User::all();
        return view("admin::pages/user", compact("users"));
    }

    public function get()
    {
        $users = DB::table('users')->get();
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $users
        ], 200);
    }

    public function getById($id)
    {
        $users = DB::table('users')->where('id', $id)->get();
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $users
        ], 200);
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'role' => 'required'
        ], [
            'required' => ':attribute harus diisi',
            'email' => ':attribute tidak valid',
            'min' => ':attribute minimal :min karakter'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'errors' => $validate->getMessageBag()
            ], 422);
        }
        $data = [
            'id' => Uuid::uuid4()->toString(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ];
        try {
            User::create($data);
            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'message' => 'Data berhasil ditambahkan'
            ], 201);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {
        $pass = $request->checkpass;

        if ($pass == true) {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ];
        } else {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role
            ];
        }

        try {
            User::where('id', $request->id)->update($data);
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Data berhasil diubah'
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function destroy(string $id)
    {
        try {
            User::where('id', $id)->delete();
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Data berhasil dihapus'
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }
}
