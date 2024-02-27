<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(): View
    {
        return view('pages.post');
    }


    public function addView(): View
    {
        return view('components.post.add');
    }
}
