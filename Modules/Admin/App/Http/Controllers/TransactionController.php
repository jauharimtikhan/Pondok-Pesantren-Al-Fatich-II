<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;

class  TransactionController extends Controller
{

    public function index()
    {
        return view('admin::pages/transaksi');
    }
}
