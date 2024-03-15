<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pages.settings');
    }
    public function changePassword(): View
    {
        return view('pages.change_password');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $search = $request->get('query');
        $envFile = base_path('.env');
        $lines = file($envFile);

        $envData = [];

        foreach ($lines as $line) {
            if (strpos($line, '#') === false) {
                $parts = explode('=', $line, 2);

                if (count($parts) === 2) {
                    $key = trim($parts[0]);
                    $value = trim($parts[1]);

                    $envData[$key] = $value;
                }
            }
        }
        if (isset($search)) {
            $searchTerm = $search;
            $envData = array_filter($envData, function ($value, $key) use ($searchTerm) {
                return strpos($key, $searchTerm) !== false || strpos($value, $searchTerm) !== false;
            }, ARRAY_FILTER_USE_BOTH);
        }
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $envData
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    private function __store($key, $field, $old)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $old,
                $key . '=' . $field,
                file_get_contents($path)
            ));
        }
    }

    /**
     * Display the specified resource.
     */
    public function changePasswordStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_sekarang' => 'required|min:5',
            'password_baru' => 'required|min:5',
            'konfirmasi_password_baru' => 'required|same:password_baru'
        ], [
            'required' => ':attribute tidak boleh kosong',
            'same' => ':attribute tidak sama dengan :other',
            'min' => ':attribute minimal :min karakter'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'statusCode' => 422,
                'errors' => $validator->getMessageBag()
            ], 422);
        }
        $user = User::find(auth()->user()->id)->first();

        if (!Hash::check($request->password_sekarang, $user->password)) {
            return response()->json([
                'status' => false,
                'statusCode' => 400,
                'message' => 'Maaf, Password sekarang yang anda masukkan salah'
            ], 400);
        }
        $data = [
            'password' => Hash::make($request->password_baru),
        ];
        try {
            User::where('id', $user->id)->update($data);
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Password berhasil diubah',
                'redirect' => route('logout')
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $val = $request->setting;
        $old = $request->old;

        $this->__store($id, $val, $old);
        return response()->json([
            'status' => true,
            'statusCode' => 200

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
