<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class  TransactionController extends Controller
{

    public function index()
    {
        return view('admin::pages/transaksi');
    }

    public function getTransactions()
    {
        $sql = "SELECT t.id, t.status,t.created_at, t.updated_at, d.name, d.order_id AS payment_id  FROM transactions t
         JOIN donaturs d ON t.donatur_id = d.id";
        $query = DB::select($sql);
        if ($query) {
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $query
            ]);
        } else {
            return response()->json([
                'status' => false,
                'statusCode' => 400,
                'data' => 'No data found'
            ]);
        }
    }

    public function deleteTransaction(string $id)
    {
        $tr = Transaction::where('id', $id)->first();
        if ($tr) {
            try {
                $tr->delete();
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'message' => 'Berhasil menghapus data transaksi!'
                ], 200);
            } catch (\Exception $th) {
                throw $th;
            }
        }
    }

    public function bulkDeleteTransaction(Request $request)
    {
        $ids = $request->ids;
        $tr = Transaction::where('id', $ids)->get();
        if ($tr) {
            try {
                Transaction::whereIn('id', $ids)->delete();
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'message' => 'Berhasil menghapus data transaksi!'
                ], 200);
            } catch (\Exception $th) {
                throw $th;
            }
        }
    }
}
