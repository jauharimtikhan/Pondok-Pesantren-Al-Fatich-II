<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(): View
    {
        $kegiatans = Kegiatan::orderBy('created_at', 'asc')->limit(12)->get();
        return view('home.pages.home', compact('kegiatans'));
    }

    public function artikel(): View
    {
        return view('home.pages.artikel');
    }

    public function artikelById(string $id): View
    {
        return view('home.pages.artikel-single', compact('id'));
    }
}
