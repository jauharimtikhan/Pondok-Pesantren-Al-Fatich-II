<?php

namespace Modules\Frontend\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\PostMedia;
use App\Models\Posts;
use App\Models\Wakaf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index(): View
    {
        $kegiatans = Kegiatan::orderBy('created_at', 'asc')->limit(12)->get();
        $sql = "SELECT SUM(target) AS target_dana, SUM(last_amount) AS total FROM wakafs";
        $target_dana = DB::select($sql);
        $sqls = "SELECT COUNT(id) AS total_donatur FROM donaturs";
        $donatur = DB::select($sqls);
        return view('frontend::pages/home', compact('kegiatans', 'target_dana', 'donatur'));
    }

    public function artikel(): View
    {
        $all = "SELECT *, p.created_at, p.updated_at, p.id AS artikel_id , pm.path, c.name AS kategori, u.name AS author FROM posts p JOIN post_media pm ON pm.post_id = p.id
        JOIN categories c ON c.id = p.category_id
        JOIN users u ON u.id = p.user_id";
        $artikels = DB::select($all);

        $pagination = Posts::paginate(10);
        return view('frontend::pages/artikel', compact('artikels', 'pagination'));
    }

    public function artikelById(string $id): View
    {
        $all = "SELECT *, p.created_at, p.updated_at, p.id AS artikel_id , pm.path, c.name AS kategori, u.name AS author FROM posts p JOIN post_media pm ON pm.post_id = p.id
        JOIN categories c ON c.id = p.category_id
        JOIN users u ON u.id = p.user_id WHERE p.id = '$id'";
        $artikel = DB::select($all);
        return view('frontend::pages/artikel-single', compact('artikel'));
    }

    public function search(Request $request)
    {
        $query = $request->keyword;

        $sql = "SELECT title, id FROM posts WHERE title LIKE '%{$query}%'";
        $artikels = DB::select($sql);
        if (isset($query)) {
            if ($artikels) {
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'result' => $artikels
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'statusCode' => 404,
                    'message' => 'Data Tidak Ditemukan'
                ], 404);
            }
        }
    }
}
