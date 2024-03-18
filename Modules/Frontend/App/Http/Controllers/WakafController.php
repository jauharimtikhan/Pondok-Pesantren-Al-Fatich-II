<?php

namespace Modules\Frontend\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaketWakaf;
use App\Models\Wakaf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Ramsey\Uuid\Uuid;


/**
 * @property Request $request
 */
class WakafController extends Controller
{

    public function viewsWakaf(): View
    {
        $wakafs = DB::table('wakafs')->orderBy('created_at', 'asc')->paginate(10);


        return view('frontend::pages/wakafs', compact('wakafs'));
    }

    public function viewsWakafById(string $id): View
    {
        $details_wakaf = DB::table("wakafs")->where('id', $id)->get();
        $totalDonaturs = DB::table("donaturs")->where('wakaf_id', $id)->count();
        return view('frontend::pages/wakaf-single', compact('details_wakaf', 'totalDonaturs'));
    }

    public function viewsFormWakaf(string $id): View
    {
        $paket_wakafs = DB::table('paket_wakafs')->where('wakaf_id', $id)->orderBy('created_at', 'asc')->get();
        $sql = "SELECT DISTINCT multiple_price AS total FROM paket_wakafs WHERE wakaf_id = '$id'";
        $total_prices = DB::select($sql);
        $totalDonaturs = DB::table("donaturs")->where('wakaf_id', $id)->count();
        $sqls = "SELECT target, last_amount, id FROM wakafs WHERE id = '$id'";
        $targets = DB::select($sqls);
        return view('frontend::pages/form-wakaf', compact('paket_wakafs', 'total_prices', 'totalDonaturs', 'targets'));
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
