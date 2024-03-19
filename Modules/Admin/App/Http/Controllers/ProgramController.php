<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class ProgramController extends Controller
{
    public function index(): View
    {
        return view('admin::pages/program');
    }

    public function get()
    {
        $program = DB::table('programs')->get();
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $program
        ], 200);
    }

    public function getById(string $id)
    {
        $program = DB::table('programs')->where('id', $id)->get();
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $program
        ], 200);
    }

    public function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'nama_program' => 'required',
            'status_program' => 'required',
            'link_program' => 'required',

        ], [
            'required' => ':attribute wajib diisi',
        ]);
        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'statusCode' => 422,
                'errors' => $validated->getMessageBag()
            ], 422);
        }

        $data = [
            'id' => Uuid::uuid4()->toString(),
            'name' => $request->nama_program,
            'status' => $request->status_program,
            'link' => $request->link_program
        ];

        try {
            Program::create($data);
            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'message' => 'Program berhasil ditambahkan'
            ], 201);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => 'Program gagal ditambahkan'
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $data = [
            'id' => $request->id_edit,
            'name' => $request->nama_program_edit,
            'status' => $request->status_program_edit,
            'link' => $request->link_program_edit
        ];

        try {
            DB::table('programs')->where('id', $request->id_edit)->update($data);
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Program berhasil diupdate'
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => 'Program gagal diupdate'
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::table('programs')->where('id', $id)->delete();
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Program berhasil dihapus'
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => 'Program gagal dihapus'
            ], 500);
        }
    }
}
