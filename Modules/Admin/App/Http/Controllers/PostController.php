<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PostMedia;
use App\Models\Posts;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Ramsey\Uuid\Uuid;

class PostController extends Controller
{
    public function index(): View
    {
        $sql = "SELECT p.id, p.title, u.name AS author, c.name AS kategori , p.created_at, p.updated_at
        FROM posts p JOIN users u ON p.user_id = u.id JOIN categories c ON p.category_id = c.id";

        $posts = DB::select($sql);
        return view('admin::pages\post', compact('posts'));
    }


    public function addView(): View
    {
        return view('admin::components\post\add');
    }

    public function editView(string $id): View
    {
        $all = "SELECT p.title,p.content,p.is_published, p.is_featured, p.meta_description, p.slug, p.category_id,
         p.created_at, p.updated_at, p.id , pm.path, c.name AS kategori, u.name AS author FROM posts p JOIN post_media pm ON pm.post_id = p.id
        JOIN categories c ON c.id = p.category_id
        JOIN users u ON u.id = p.user_id WHERE p.id = '$id'";
        $artikel = DB::select($all);
        return view('admin::components\post\edit', compact('artikel'));
    }

    public function uploadImage(Request $request)
    {
        $file = $request->file('file');
        $fileName = time() . '-' . random_int(100, 99999) . '.webp';
        $outputFile = "storage/uploads/artikel/media/$fileName";
        $manager = ImageManager::gd();
        $image = $manager->read($file);
        $image->save(quality: 10);
        $image->save($outputFile, 10);
        return response()->json(['location' => asset("storage/$outputFile")]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'kategori' => 'required',
            'content' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'slug' => 'required',
            'metadescription' => 'required',
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'statusCode' => 422,
                'errors' => $validator->getMessageBag()
            ], 422);
        }
        $meta = "";
        $meta = implode(',', $request->metadescription);
        $ids = Uuid::uuid4()->toString();
        $data = [
            'id' => $ids,
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'slug' => $request->slug,
            'meta_description' => $meta,
            'category_id' => $request->kategori,
            'is_published' => $request->is_published,
            'is_featured' => $request->is_featured,
        ];
        $dataThumbnail = [
            'id' => Uuid::uuid4()->toString(),
            'post_id' => $ids,
        ];

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = time() . '-' . random_int(100, 99999) . '.webp';
            $outputFile = "storage/uploads/artikel/thumbnail/$fileName";
            $manager = ImageManager::gd();
            $image = $manager->read($file);
            $image->save(quality: 10);
            $image->save($outputFile);
            $dataThumbnail['path'] = asset($outputFile);
        }
        try {
            Posts::create($data);
            PostMedia::create($dataThumbnail);
            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'message' => 'Berhasil membuat artikel'
            ], 201);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $ids = $request->id;
        $meta = implode(',', $request->metadescription);
        $newContent = str_replace(getenv('ASSET_URL'), '../../', $request->content);
        $data = [
            'id' => $ids,
            'title' => $request->title,
            'content' => $newContent,
            'user_id' => auth()->user()->id,
            'slug' => $request->slug,
            'meta_description' => $meta,
            'category_id' => $request->kategori,
            'is_published' => $request->is_published,
            'is_featured' => $request->is_featured,
        ];
        $dataThumbnail = [
            'id' => Uuid::uuid4()->toString(),
            'post_id' => $ids,
        ];

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = time() . '-' . random_int(100, 99999) . '.webp';
            $check = PostMedia::where('post_id', $ids)->first();
            $outputFile = "storage/uploads/artikel/thumbnail/$fileName";
            $manager = ImageManager::gd();
            $image = $manager->read($file);
            $image->save(quality: 10);
            $image->save($outputFile);
            if (file_exists($check->path)) {
                unlink($check->path);
            }
            $dataThumbnail['path'] = $outputFile;
        }

        try {
            Posts::where('id', $ids)->update($data);
            PostMedia::where('post_id', $ids)->update($dataThumbnail);
            return response()->json([
                'status' => true,
                'statusCode' => 201,
                'message' => 'Berhasil update artikel'
            ], 201);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        $check = PostMedia::where('post_id', $id)->first();

        if ($check) {
            if (file_exists($check->path)) {
                unlink($check->path);
            }
            try {
                Posts::destroy($id);
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'message' => 'Berhasil menghapus artikel'
                ], 200);
            } catch (\Exception $th) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 500,
                    'message' => $th->getMessage()
                ], 500);
            }
        }
    }
}
