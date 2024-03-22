<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(): View
    {
        $sql = "SELECT SUM(last_amount) as total FROM wakafs";
        $earn = DB::select($sql);
        return view('admin::pages/home', compact('earn'));
    }


    public function getDataDonatur()
    {

        $sqls = "SELECT MONTH(created_at) as bulan, COUNT(id) as total 
        FROM donaturs GROUP BY created_at ORDER BY created_at ASC";
        $data = DB::select($sqls);
        $result = [];
        foreach ($data as $d) {
            $bulan = [
                1 => "Januari",
                2 => "Februari",
                3 => "Maret",
                4 => "April",
                5 => "Mei",
                6 => "Juni",
                7 => "Juli",
                8 => "Agustus",
                9 => "September",
                10 => "Oktober",
                11 => "November",
                12 => "Desember",
            ];

            $converted = $bulan[$d->bulan] ?? "";
            $result[] = [
                'bulan' => $converted,
                'total' => $d->total,
            ];
        }
        $sums = array();
        foreach ($result as $item) {
            $bulan = $item['bulan'];
            $total = $item['total'];

            if (array_key_exists($bulan, $sums)) {
                $sums[$bulan] += $total;
            } else {
                $sums[$bulan] = $total;
            }
        }
        return response()->json([
            'data' => $sums
        ]);
    }
}
