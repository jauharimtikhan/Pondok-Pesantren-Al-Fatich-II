<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class TransactionController extends Controller
{




    public function create(Request $request)
    {
        $data = [
            'id' => Uuid::uuid4()->toString(),
            'donatur_id' => $request->donatur_id,
            'wakaf_id' => $request->wakaf_id,
            'payment_id' => $request->transaction_id,
            'status' => $request->transaction_status
        ];
        $dataUpdateAmount = [
            'last_amount' => RP($request->gross_amount)
        ];
        try {
            DB::table('transactions')->insert($data);
            DB::table('wakafs')->where('id', $request->wakaf_id)->update($dataUpdateAmount);
            return response()->json(
                [
                    'status' => true,
                    'statusCode' => 200,
                    'message' => "Berhasil"
                ]
            );
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {

        $check = DB::table('transactions')->where('donatur_id', $request->donatur_id)->first();

        $sum = $request->last_amount + $request->gross_amount;
        if ($check) {
            $data = [
                'status' => $request->transaction_status,
                'payment_id' => $request->transaction_id
            ];
            $data_lastAmount = [
                'last_amount' => $sum
            ];
            try {
                DB::table('transactions')->where('donatur_id', $request->donatur_id)->update($data);
                if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
                    DB::table('wakafs')->where('id', $request->wakaf_id)->update($data_lastAmount);

                    return response()->json(
                        [
                            'status' => true,
                            'statusCode' => 200,
                            'message' => "Berhasil"
                        ]
                    );
                } elseif ($request->transaction_status == 'pending') {
                    return response()->json(
                        [
                            'status' => true,
                            'statusCode' => 200,
                            'message' => "Pending"
                        ]
                    );
                }
            } catch (\Exception $th) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 500,
                    'errors' => $th->getMessage()
                ]);
            }
        }
    }
}
