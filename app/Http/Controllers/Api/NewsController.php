<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id) {
            return response()->json(News::with('category')->where('news_category_id', $request->id)->get(), 200);
        }
        return response()->json(News::with('category')->get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'head' => 'required',
            'body' => 'required',
            'img' => 'required',
            'news_category_id' => 'required',
        ]);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = 'imgs' . '_' . time() . '.' . $ext;
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $imgname = basename($storagePath);
        }
        $prog = News::create([
            'head' => $request->head,
            'body' => $request->body,
            'img' => '/uploads/' . $imgname,
            'news_category_id' => $request->news_category_id
        ]);
        return response()->json($prog, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(News::findOrFail($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $request->validate(['name' => 'required']);
        // $prog = Program::findOrFail($id);

        // $prog->update([
        //     'name' => $request->name
        // ]);
        // return response()->json($prog, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prog = News::findOrFail($id);
        $prog->delete();

        return response()->json(['message' => 'News Deleted Successfully'], 200);
    }
    public function cats()
    {
        $cats = NewsCategory::where('category', null)->with('categories')->get();
        return response()->json($cats, 200);
    }
    public function subcategory($id)
    {
        $cats = NewsCategory::where('category', $id)->with('categories')->get();
        return response()->json($cats, 200);
    }
    public function showallnews($id)
    {
        $cats = News::where('news_category_id', $id)->with('wishlist')->get();
        return response()->json($cats, 200);
    }
    public function news($id)
    {
        $news = News::findOrFail($id);
        return response()->json($news, 200);
    }
    //
    public function profilepic(Request $request)
    {
        $request->validate([
            'photo' => 'sometimes|mimes:png,jpg,jpeg.webp'
        ]);
        $user = User::findOrFail(auth()->user()->id);
        if ($user) {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $ext = $file->getClientOriginalExtension();
                $filename = 'photos' . '_' . time() . '.' . $ext;
                $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
                $imgname = '/uploads/' . basename($storagePath);
            } else {
                $imgname = $user->photo;
            }
            $user->update([
                'photo' => $imgname,
                'name' => $request->name ?? $user->name,
            ]);
            return response()->json($user, 200);
        }
    }
    //
    public function search(Request $request)
    {
        $request->validate(['search' => 'required']);
        $data = News::where('head', 'LIKE', '%' . $request->search . '%')->with('category')->get();
        return response()->json($data, 200);
    }
}
