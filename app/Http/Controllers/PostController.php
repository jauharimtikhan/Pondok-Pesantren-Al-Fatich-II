<?php

namespace App\Http\Controllers;

use App\Models\PostMedia;
use App\Models\Posts;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class PostController extends Controller
{
    public function index(): View
    {
        $sql = "SELECT p.id, p.title, u.name AS author, c.name AS kategori , p.created_at, p.updated_at
        FROM posts p JOIN users u ON p.user_id = u.id JOIN categories c ON p.category_id = c.id";

        $posts = DB::select($sql);
        return view('pages.post', compact('posts'));
    }


    public function addView(): View
    {
        return view('components.post.add');
    }

    public function editView(string $id): View
    {
        $all = "SELECT p.title,p.content,p.is_published, p.is_featured, p.meta_description, p.slug, p.category_id,
         p.created_at, p.updated_at, p.id , pm.path, c.name AS kategori, u.name AS author FROM posts p JOIN post_media pm ON pm.post_id = p.id
        JOIN categories c ON c.id = p.category_id
        JOIN users u ON u.id = p.user_id WHERE p.id = '$id'";
        $artikel = DB::select($all);
        return view('components.post.edit', compact('artikel'));
    }

    public function uploadImage(Request $request)
    {
        $file = $request->file('file')->getClientOriginalName();
        $fileName = time() . '-' . $file;
        $path = $request->file('file')->storeAs('uploads/artikel/media', $fileName, 'public');
        return response()->json(['location' => asset("storage/$path")]);
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
            $file = $request->file('thumbnail')->getClientOriginalName();
            $fileName = time() . '-' . $file;
            $path = $request->file('thumbnail')->storeAs('uploads/artikel/thumbnail', $fileName, 'public');
            $dataThumbnail['path'] = asset("storage/$path");
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
            $file = $request->file('thumbnail')->getClientOriginalName();
            $fileName = time() . '-' . $file;
            $check = PostMedia::where('post_id', $ids)->first();
            $path = $request->file('thumbnail')->storeAs('uploads/artikel/thumbnail', $fileName, 'public');
            if ($check->path !== $path) {
                Storage::delete($check->path);
            }
            $dataThumbnail['path'] = $path;
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
