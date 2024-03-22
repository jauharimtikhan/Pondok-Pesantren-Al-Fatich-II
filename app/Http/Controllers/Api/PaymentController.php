<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GuzzleException;
use App\Http\Controllers\Controller;
use App\Models\Donatur;
use App\Models\Transaction;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
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


    public function getStatusPayment(Request $request)
    {
        $params = $request->query('order_id');
        $orderId = $params;
        $guzzele = new Client(['http_errors' => false]);

        try {
            $response = $guzzele->request('GET', getenv('MIDTRANS_API_URL') . 'v2/' . $orderId . '/status', [
                'headers' => [
                    'accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode(config('services.midtrans.serverKey') . ':')
                ]
            ]);
            $responseData = json_decode($response->getBody(), true);
            if ($responseData == null) {
                return response()->json([
                    'status' => true,
                    'statusCode' => $response->getStatusCode(),
                    'data' => 'Transaksi Tidak Ditemukan'
                ], $response->getStatusCode());
            }
            return response()->json([
                'status' => true,
                'statusCode' => $response->getStatusCode(),
                'data' => $responseData
            ], $response->getStatusCode());
        } catch (BadResponseException $th) {

            throw new Exception('Transaksi Tidak Ditemukan', $th->getCode());
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

    // untuk pembayaran wakaf normal
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

                if (!$double_check_payment) {
                    $updateOrderId = [
                        'order_id' => $order_id
                    ];

                    DB::table('donaturs')->where('id', $check_donatur->id)->update($updateOrderId);
                }
                $double_check_donatur = DB::table('donaturs')->where('id', $check_donatur->id)->first();

                if ($double_check_payment) {
                    return response()->json([
                        'status' => false,
                        'statusCode' => 400,
                        'message' => 'Anda sudah melakukan transaksi',
                        'url' => getenv('FRONTEND_URL') . '?wakaf_id=' . $request->wakaf_id . '&donatur_id=' . $check_donatur->id . '&last_amount=' . $check_wakaf->last_amount . '&order_id=' . $double_check_donatur->order_id
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

    // untuk direct one pembayaran 
    public function getSnapTokenDirect(Request $request)
    {
        $order_id = 'WAKAF-DIRECT-' . random_int(10000, 999999999);
        $dataUser = DB::table('donaturs')->where('phone', $request->phone)->first();
        if (!$dataUser) {
            $data = [
                'id' => Uuid::uuid4()->toString(),
                'name' => $request->nama,
                'phone' => $request->phone,
                'wakaf_id' => 'WAKAF-DIRECT-' . random_int(10, 999),
                'order_id' => $order_id,
                'amount' => $request->total
            ];

            $tr = [
                'id' => Uuid::uuid4()->toString(),
                'donatur_id' => $data['id'],
                'wakaf_id' => $data['wakaf_id'],
                'status' => 'pending',
            ];

            Donatur::create($data);
            Transaction::create($tr);

            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $request->total,
                ],
                'customer_details' => [
                    'first_name' => $request->nama,
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
                    'snap_token' => null
                ], 400);
            }
        } else {
            $tr = [
                'id' => Uuid::uuid4()->toString(),
                'donatur_id' => $dataUser->id,
                'wakaf_id' => $dataUser->wakaf_id,
                'status' => 'pending',
            ];
            Transaction::create($tr);

            $checkPayment = DB::table('transactions')->where('donatur_id', $dataUser->id)->where('status', 'pending')->first();

            if ($checkPayment) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 400,
                    'message' => 'Anda sudah melakukan transaksi',
                    'url' => getenv('FRONTEND_URL') . '?donatur_id=' . $dataUser->id . '&order_id=' . $dataUser->order_id
                ], 400);
            } else {
                $updateOrderId = [
                    'order_id' => $order_id
                ];
                Donatur::where('id', $dataUser->id)->update($updateOrderId);

                $doubleCheckDonatur = DB::table('donaturs')->where('id', $dataUser->id)->first();

                $params = [
                    'transaction_details' => [
                        'order_id' => $doubleCheckDonatur->order_id,
                        'gross_amount' => $request->total,
                    ],
                    'customer_details' => [
                        'first_name' => $request->nama,
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
                        'snap_token' => null
                    ], 400);
                }
            }
        }
    }

    public function deleteTransaction(string $phone)
    {
        $checkUser = DB::table("donaturs")->where('phone', $phone)->first();

        if ($checkUser) {
            try {
                DB::table("transactions")->where('donatur_id', $checkUser->id)->where('status', 'pending')->delete();
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,

                ], 200);
            } catch (Exception $th) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 400,
                ], 400);
            }
        }
    }
}
