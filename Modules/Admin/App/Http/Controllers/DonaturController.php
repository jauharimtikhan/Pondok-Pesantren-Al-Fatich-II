<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonaturController extends Controller
{
    public function index(): View
    {
        $sql = "SELECT d.id, d.name, d.phone, w.name as wakaf, d.amount FROM donaturs d 
        JOIN wakafs w ON d.wakaf_id = w.id";

        $wakafs = DB::select($sql);
        return view('admin::pages\donatur', compact('wakafs'));
    }

    public function getDetails(string $id)
    {
        $guzzele = new \GuzzleHttp\Client();
        $dataDonatur = [];
        $results = [];
        $statusCode = 0;
        $sql = "SELECT t.id, t.payment_id, d.name, d.phone FROM transactions t
         JOIN donaturs d ON t.donatur_id = d.id WHERE d.id = '$id'";
        $payments = DB::select($sql);
        if ($payments) {
            foreach ($payments as $payment) {
                $dataDonatur[] = [
                    'id' => $payment->id,
                    'donatur_name' => $payment->name,
                    'order_id' => $payment->payment_id,
                    'phone' => $payment->phone
                ];
            }
        }

        if ($dataDonatur) {
            foreach ($dataDonatur as $donatur) {
                $orderId = $donatur['order_id'];
                $response = $guzzele->request('GET', getenv('MIDTRANS_API_URL') . 'v2/' . $orderId . '/status', [
                    'headers' => [
                        'accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Basic ' . base64_encode(config('services.midtrans.serverKey') . ':')
                    ]
                ]);
                $statusCode = $response->getStatusCode();
                if ($response->getStatusCode() == 200) {
                    $results[] = [
                        'id' => $donatur['id'],
                        'donatur_name' => $donatur['donatur_name'],
                        'donatur_phone' => $donatur['phone'],
                        'result' => json_decode($response->getBody())
                    ];
                }
            }
        }
        return response()->json([
            'status' => true,
            'statusCode' => $statusCode,
            'results' => $results
        ], $statusCode);
    }
}
