<?php

namespace Modules\Frontend\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function success(Request $request): View
    {
        $wakaf_id = $request->query('wakaf_id');
        $donatur_id = $request->query('donatur_id');
        $order_id = $request->query('order_id');
        $last_amount = $request->query('last_amount');
        return view('frontend::pages\paymentsuccess', compact('wakaf_id', 'donatur_id', 'order_id', 'last_amount'));
    }
}
