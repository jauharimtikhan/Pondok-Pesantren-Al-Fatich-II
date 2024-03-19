<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
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

    public function visitor()
    {
        $key = getenv("VISITOR_API_KEY");
        $guzzle = new \GuzzleHttp\Client();
        $response = $guzzle->request('GET', "https://api.visitorapi.com/api/?pid=$key");
        return response()->json([
            'statusCode' => $response->getStatusCode(),
            'data' => json_encode($response->getBody()->getContents())
        ], $response->getStatusCode());
    }
}
