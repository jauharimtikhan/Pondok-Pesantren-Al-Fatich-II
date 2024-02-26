<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Snap;

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
        $params = array(
            'transaction_details' => array(
                'order_id' => 'WAKAF-' . random_int(100000000, 999999999),
                'gross_amount' => $request->total,
            ),
            'customer_details' => array(
                'first_name' => $request->name,
                'phone' => $request->phone,
            ),
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
        );
        try {
            $snapTokens = Snap::getSnapToken($params);
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
}
