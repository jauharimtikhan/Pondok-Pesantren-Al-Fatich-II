<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use App\Models\Transaction;
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
        $check_wakaf = DB::table('wakafs')->where('id', $request->wakaf_id)->first();
        if (!$check_donatur) {
            $data = [
                'id' => Uuid::uuid4()->toString(),
                'name' => $request->name,
                'phone' => $request->phone,
                'wakaf_id' => $request->wakaf_id
            ];
            Donatur::create($data);
        } else {
            $checkPayment = DB::table('transactions')->where('donatur_id', $check_donatur->id)->first();
            $dataPayment = [
                'id' => Uuid::uuid4()->toString(),
                'donatur_id' => $check_donatur->id,
                'wakaf_id' => $request->wakaf_id,
                'status' => 'pending'
            ];
            Transaction::create($dataPayment);

            if ($checkPayment->status == "pending") {
                return response()->json([
                    'status' => false,
                    'statusCode' => 400,
                    'message' => 'Anda sudah melakukan transaksi'
                ], 400);
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
                ],
                'callbacks' => [
                    'finish' => getenv('FRONTEND_URL') . '?wakaf_id=' . $request->wakaf_id . '&donatur_id=' . $check_donatur->id . '&last_amount=' . $check_wakaf->last_amount
                ]
            ];


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
                    'errors' => 'Something went wrong'
                ], 400);
            }
        }
    }

    public function getStatusPayment(Request $request)
    {
        $params = $request->query('order_id');
        $orderId = $params;
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

    public function getSnapToken(Request $request)
    {
        $check_donatur = DB::table('donaturs')->where('phone', $request->phone)->first();
        $order_id = 'WAKAF-' . random_int(100000000, 999999999);
        if (!$check_donatur) {
            $data = [
                'id' => Uuid::uuid4()->toString(),
                'name' => $request->name,
                'phone' => $request->phone,
                'amount' => RP($request->total),
                'wakaf_id' => $request->wakaf_id,
                'order_id' => $order_id
            ];
            Donatur::create($data);
            $double_check_donatur = DB::table('donaturs')->where('phone', $request->phone)->first();
            $check_wakaf = DB::table('wakafs')->where('id', $request->wakaf_id)->first();
            $checkPayment = DB::table('transactions')->where('donatur_id', $double_check_donatur->id)->first();

            if (!$checkPayment) {
                $dataPayment = [
                    'id' => Uuid::uuid4()->toString(),
                    'donatur_id' => $double_check_donatur->id,
                    'wakaf_id' => $request->wakaf_id,
                    'status' => 'pending'
                ];
                Transaction::create($dataPayment);
                $params = [
                    'transaction_details' => [
                        'order_id' => $double_check_donatur->order_id,
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
                    ],
                    'callbacks' => [
                        'finish' => getenv('FRONTEND_URL') . '?wakaf_id=' . $request->wakaf_id . '&donatur_id=' . $double_check_donatur->id . '&last_amount=' . $check_wakaf->last_amount
                    ]
                ];

                $snapTokens = Snap::getSnapToken($params);
                if ($snapTokens) {
                    return response()->json([
                        'status' => true,
                        'statusCode' => 200,
                        'snap_token' => $snapTokens
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'statusCode' => 400,
                        'snap_token' => 'kosong'
                    ], 400);
                }
            } else {
                $double_check_payment = DB::table('transactions')->where('status', 'pending')->where('donatur_id', $double_check_donatur->id)->first();
                $double_check_donatur = DB::table('donaturs')->where('phone', $request->phone)->first();
                if ($double_check_payment) {
                    return response()->json([
                        'status' => false,
                        'statusCode' => 400,
                        'message' => 'Anda sudah melakukan transaksi',
                        'url' => getenv('FRONTEND_URL') . '?wakaf_id=' . $request->wakaf_id . '&donatur_id=' . $double_check_donatur->id . '&last_amount=' . $check_wakaf->last_amount . '&order_id=' . $double_check_donatur->order_id
                    ], 400);
                } else {
                    $dataPayment = [
                        'id' => Uuid::uuid4()->toString(),
                        'donatur_id' => $double_check_donatur->id,
                        'wakaf_id' => $request->wakaf_id,
                        'status' => 'pending'
                    ];
                    Transaction::create($dataPayment);
                    $params = [
                        'transaction_details' => [
                            'order_id' => $double_check_donatur->order_id,
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
                        ],
                        'callbacks' => [
                            'finish' => getenv('FRONTEND_URL') . '?wakaf_id=' . $request->wakaf_id . '&donatur_id=' . $double_check_donatur->id . '&last_amount=' . $check_wakaf->last_amount
                        ]
                    ];

                    $snapTokens = Snap::getSnapToken($params);
                    if ($snapTokens) {
                        return response()->json([
                            'status' => true,
                            'statusCode' => 200,
                            'snap_token' => $snapTokens
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => false,
                            'statusCode' => 400,
                            'snap_token' => 'kosong'
                        ], 400);
                    }
                }
            }
        } else {
            $check_wakaf = DB::table('wakafs')->where('id', $request->wakaf_id)->first();
            $checkPayment = DB::table('transactions')->where('donatur_id', $check_donatur->id)->first();

            if (!$checkPayment) {
                $dataPayment = [
                    'id' => Uuid::uuid4()->toString(),
                    'donatur_id' => $check_donatur->id,
                    'wakaf_id' => $request->wakaf_id,
                    'status' => 'pending'
                ];
                Transaction::create($dataPayment);
                $params = [
                    'transaction_details' => [
                        'order_id' => $check_donatur->order_id,
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
                    ],
                    'callbacks' => [
                        'finish' => getenv('FRONTEND_URL') . '?wakaf_id=' . $request->wakaf_id . '&donatur_id=' . $check_donatur->id . '&last_amount=' . $check_wakaf->last_amount
                    ]
                ];

                $snapTokens = Snap::getSnapToken($params);
                if ($snapTokens) {
                    return response()->json([
                        'status' => true,
                        'statusCode' => 200,
                        'snap_token' => $snapTokens
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'statusCode' => 400,
                        'snap_token' => 'kosong'
                    ], 400);
                }
            } else {
                $double_check_payment = DB::table('transactions')->where('status', 'pending')->where('donatur_id', $check_donatur->id)->first();
                $updateOrderId = [
                    'order_id' => $order_id
                ];

                DB::table('donaturs')->where('id', $check_donatur->id)->update($updateOrderId);
                $double_check_donatur = DB::table('donaturs')->where('id', $check_donatur->id)->first();

                // if($check_donatur->order_id == $double_check_)
                if ($double_check_payment) {
                    return response()->json([
                        'status' => false,
                        'statusCode' => 400,
                        'message' => 'Anda sudah melakukan transaksi',
                        'url' => getenv('FRONTEND_URL') . '?wakaf_id=' . $request->wakaf_id . '&donatur_id=' . $check_donatur->id . '&last_amount=' . $check_wakaf->last_amount . '&order_id=' . $check_donatur->order_id
                    ], 400);
                } else {

                    $dataPayment = [
                        'id' => Uuid::uuid4()->toString(),
                        'donatur_id' => $check_donatur->id,
                        'wakaf_id' => $request->wakaf_id,
                        'status' => 'pending'
                    ];
                    Transaction::create($dataPayment);
                    $params = [
                        'transaction_details' => [
                            'order_id' => $double_check_donatur->order_id,
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
                        ],
                        'callbacks' => [
                            'finish' => getenv('FRONTEND_URL') . '?wakaf_id=' . $request->wakaf_id . '&donatur_id=' . $check_donatur->id . '&last_amount=' . $check_wakaf->last_amount
                        ]
                    ];

                    $snapTokens = Snap::getSnapToken($params);
                    if ($snapTokens) {
                        return response()->json([
                            'status' => true,
                            'statusCode' => 200,
                            'snap_token' => $snapTokens
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => false,
                            'statusCode' => 400,
                            'snap_token' => 'kosong'
                        ], 400);
                    }
                }
            }
        }
    }
}
