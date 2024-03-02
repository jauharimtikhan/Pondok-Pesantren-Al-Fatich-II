<?php

namespace App\Http\Controllers;

use App\Models\Wakaf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;


/**
 * @property Request $request
 */
class WakafController extends Controller
{
    public function index(): View
    {
        return view("pages.wakaf");
    }

    public function ViewPaketWakaf(): View
    {
        return view('pages.paket_wakaf');
    }

    public function get()
    {
        $wakafs = DB::table("wakafs")->get();
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $wakafs
        ]);
    }

    public function getById(string $id)
    {
        $wakafs = DB::table("wakafs")->where('id', $id)->get();
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $wakafs
        ]);
    }

    public function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'judul_wakaf' => 'required',
            'target' => 'required',
            'link_wakaf' => 'required',
            'tanggal_berakhir' => 'required',
            'benefit' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'required' => ':attribute harus diisi'
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
            'name' => $request->judul_wakaf,
            'description' => $request->deskripsi,
            'benefit' => $request->benefit,
            'target' => RP($request->target),
            'expire_date' => $request->tanggal_berakhir,
            'link' => $request->link_wakaf
        ];

        if ($request->has('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $name = time() . '-' . random_int(100, 999) . '.' . $ext;
            $path = 'storage/uploads/wakaf/';
            $file->move($path, $name);
            $data['image'] = $path . $name;
        }

        try {
            Wakaf::create($data);
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Berhasil membuat campaign wakaf baru!'
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $check_file = DB::table('wakafs')->where('id', $request->id_wakaf_edit)->first();

        $dataUpdate = [
            'name' => $request->judul_wakaf_edit,
            'description' => $request->deskripsi_edit,
            'benefit' => $request->benefit_edit,
            'target' => RP($request->target_edit),
            'expire_date' => $request->tanggal_berakhir_edit,
            'link' => $request->link_wakaf_edit,
        ];

        if ($request->has('image_edit')) {
            $file = $request->file('image_edit');
            $ext = $file->getClientOriginalExtension();
            $name = time() . '-' . random_int(100, 999) . '.' . $ext;
            $path = 'storage/uploads/wakaf/';
            $file->move($path, $name);
            if (File::exists($check_file->image)) {
                File::delete($check_file->image);
            }
            $dataUpdate['image'] = $path . $name;
        }

        try {
            DB::table('wakafs')->where('id', $request->id_wakaf_edit)->update($dataUpdate);
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Berhasil mengupdate campaign wakaf!'
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::table('wakafs')->where('id', $id)->delete();
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Berhasil menghapus data wakaf!'
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function create_paket_wakaf(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'nama_paket' => 'required',
            'harga_paket' => 'required',
            'harga_kelipatan_paket' => 'required',
            'campaign_wakaf' => 'required',
        ], [
            'required' => ':attribute harus diisi!'
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
            'name' => $request->nama_paket,
            'price' => RP($request->harga_paket),
            'multiple_price' => RP($request->harga_kelipatan_paket),
            'wakaf_id' => $request->campaign_wakaf,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        try {
            DB::table('paket_wakafs')->insert($data);
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => "Berhasil membuat paket wakaf"
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getPaketWakaf()
    {
        $sql = "SELECT p.id , p.name AS nama_paket, w.name , p.multiple_price  FROM paket_wakafs p 
        JOIN wakafs w ON w.id = p.wakaf_id ";
        $datas = DB::select($sql);

        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $datas
        ], 200);
    }



    public function getPaketById(string $id)
    {
        $sql = "SELECT p.id , p.name AS nama_paket, p.multiple_price, w.name, p.price AS harga,
        w.id AS id_wakaf
         FROM paket_wakafs p 
        JOIN wakafs w ON w.id = p.wakaf_id WHERE p.id = '$id'";
        $datas = DB::select($sql);

        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $datas
        ], 200);
    }

    public function update_paket_wakaf(Request $request)
    {
        $data = [
            'name' => $request->nama_paket_edit,
            'price' => RP($request->harga_paket_edit),
            'multiple_price' => RP($request->harga_kelipatan_paket_edit),
            'wakaf_id' => $request->campaign_wakaf_edit,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        try {
            DB::table('paket_wakafs')->where('id', $request->id_paket_edit)->update($data);
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => "Berhasil mengupdate paket wakaf"
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function paket_wakaf_destroy(string $id)
    {
        try {
            DB::table('paket_wakafs')->where('id', $id)->delete();
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Berhasil menghapus data paket wakaf!'
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }


    /**
     * Method For API Route
     */
    public function getWakafPagination(Request $request)
    {
        $request->query('page');
        $perPage = $request->query('perPage');
        $wakafs = DB::table('wakafs')->paginate($perPage);
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'result' => $wakafs
        ]);
    }

    public function getWakafById(string $id)
    {
        $wakaf = DB::table('wakafs')->find($id);
        $donatur = DB::table('donaturs')->where('wakaf_id', $id)->count();
        $rawSql = "SELECT DISTINCT multiple_price FROM paket_wakafs WHERE wakaf_id = '$id'";
        $paket = DB::select($rawSql);
        $data = [
            'data_wakaf' => $wakaf,
            'total_donatur' => $donatur,
            'multiple_price' => $paket[0]->multiple_price
        ];
        if ($wakaf) {
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'result' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'result' => []
            ], 500);
        }
    }

    function getPaketWakafApi(string $id)
    {
        $wakaf = DB::table('paket_wakafs')
            ->where('wakaf_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'result' => $wakaf
        ], 200);
    }
}
