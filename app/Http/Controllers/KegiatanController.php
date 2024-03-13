<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pages.kegiatan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required|min:3|max:100',
            'deskripsi_kegiatan' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ], [
            'required' => ':attribute tidak boleh kosong.',
            'min' => ':attribute minimal :min karakter.',
            'max' => ':attribute maksimal :max karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'statusCode' => 422,
                'errors' => $validator->getMessageBag()
            ], 422);
        }

        $data = [
            'id' => Uuid::uuid4()->toString(),
            'name' => $request->nama_kegiatan,
            'description' => $request->deskripsi_kegiatan,
        ];

        if ($request->has('gambar_kegiatan')) {
            $file = $request->file('gambar_kegiatan');
            $ext = $file->getClientOriginalExtension();
            $name = time() . '-' . random_int(100, 999) . '.' . $ext;
            $path = 'storage/uploads/kegiatan/';
            $file->move($path, $name);
            $data['image'] = $path . $name;
        }

        try {
            Kegiatan::create($data);
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Berhasil membuat kegiatan baru!'
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
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $kegiatan = Kegiatan::all();
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $kegiatan
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kegiatan = Kegiatan::find($id);
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $kegiatan
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id_kegiatan_edit;
        $check_file = Kegiatan::find($id)->first();
        $dataUpdate = [
            'name' => $request->nama_kegiatan_edit,
            'description' => $request->deskripsi_kegiatan_edit,
        ];

        if ($request->has('gambar_kegiatan_edit')) {
            $file = $request->file('gambar_kegiatan_edit');
            $ext = $file->getClientOriginalExtension();
            $name = time() . '-' . random_int(100, 999) . '.' . $ext;
            $path = 'storage/uploads/kegiatan/';
            $file->move($path, $name);
            if (File::exists($check_file->image)) {
                File::delete($check_file->image);
            }
            $dataUpdate['image'] = $path . $name;
        }

        try {
            Kegiatan::where('id', $id)->update($dataUpdate);
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Berhasil mengupdate kegiatan!'
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = Kegiatan::find($id)->first();
        if ($check) {
            try {
                Kegiatan::where('id', $id)->delete();
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'message' => 'Berhasil menghapus data kegiatan!'
                ], 200);
            } catch (\Exception $th) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 500,
                    'message' => $th->getMessage()
                ], 500);
            }
        } else {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => 'Data kegiatan tidak ditemukan!'
            ], 500);
        }
    }
}
