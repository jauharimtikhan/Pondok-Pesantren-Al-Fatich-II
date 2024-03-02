<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Ramsey\Uuid\Uuid;

class PaymentController extends Controller
{

    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    public function store(Request $request)
    {

        $check_donatur = DB::table('donaturs')->where('phone', $request->phone)->first();
        if (!$check_donatur) {
            $data = [
                'id' => Uuid::uuid4()->toString(),
                'name' => $request->name,
                'phone' => $request->phone,
                'wakaf_id' => $request->wakaf_id
            ];
            Donatur::create($data);
        }
        $params = [
            'transaction_details' => [
                'order_id' => 'WAKAF-' . random_int(100000000, 999999999),
                'gross_amount' => $request->total,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'phone' => $request->phone,
            ],
            'item_details' => [
                [
                    'id'            => random_int(0, 100),
                    'price'         => $request->total,
                    'quantity'      => 1,
                    'name'          => 'Wakaf kepada ' . config('app.name'),
                    'brand'         => 'Wakaf',
                    'category'      => 'Wakaf',
                    'merchant_name' => config('app.name'),
                ]
            ]
        ];


        try {
            $snapTokens = Snap::getSnapToken($params);
            \Midtrans\Config::$overrideNotifUrl = "https://07b8-180-247-170-16.ngrok-free.app/paymentsuccess?wakaf_id=" . $request->wakaf_id . "&donatur_id=" . $check_donatur->id;
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'snap_token' => $snapTokens
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 400,
                'snap_token' => $th->getMessage()
            ], 400);
        }
    }

    public function getStatusPayment(Request $request)
    {
        $orderId = $request->query('order_id');
        $guzzele = new \GuzzleHttp\Client();
        $response = $guzzele->request('GET', 'https://api.sandbox.midtrans.com/v2/' . $orderId . '/status', [
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode(config('services.midtrans.serverKey') . ':')
            ]
        ]);
        if ($response->getStatusCode() == 200) {
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => json_decode($response->getBody())
            ]);
        }
    }

    public function updateLastAmout(Request $request)
    {
        $data = [
            'last_amount' => $request->last_amount,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        try {
            DB::table('wakaf')->where('id', $request->wakaf_id)->update($data);
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
}
