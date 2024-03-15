<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class CategoryController extends Controller
{
    public function index()
    {
        return view("pages.kategori");
    }

    public function get()
    {
        $categories = Categories::all();
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $categories
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], [
            'required' => ':attribute harus diisi'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()
            ], 422);
        }
        $data = [
            'id' => random_int(100000, 999999),
            'name' => $request->name
        ];

        try {
            Categories::create($data);
            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'message' => 'Kategori berhasil ditambahkan'
            ], 201);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => $th->getCode(),
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getById(string $id)
    {
        $categories = Categories::where('id', $id)->get();
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $categories
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = [
            'name' => $request->name
        ];
        try {
            Categories::where('id', $id)->update($data);
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Kategori berhasil diupdate'
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
            Categories::where('id', $id)->delete();
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Kategori berhasil dihapus'
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
