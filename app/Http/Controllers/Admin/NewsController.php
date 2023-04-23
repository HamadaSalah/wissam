<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
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
        $cats = NewsCategory::doesntHave('categories')->get();
        if ($request->category) {
            $videos = News::where('news_category_id', $request->category)->get();
        } else {
            $videos = News::all();
        }
        return view('Admin.News.index', compact('videos', 'cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = NewsCategory::doesntHave('categories')->get();
        return view('Admin.News.create', compact('cats'));
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
            'news_category_id' => 'required',
        ]);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = 'imgs' . '_' . time() . '.' . $ext;
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $imgname = 'uploads/' . basename($storagePath);
        }
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $ext = $file->getClientOriginalExtension();
            $filename = 'videos' . '_' . time() . '.' . $ext;
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $videoname = 'uploads/' . basename($storagePath);
        }
        News::create([
            'head' => $request->head,
            'body' => $request->body ?? null,
            'img' => $imgname ?? null,
            'video' => $videoname ?? null,
            'news_category_id' => $request->news_category_id
        ]);
        return redirect()->route('admin.news.index')->with('success', 'تم الاضافة');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cats = NewsCategory::doesntHave('categories')->get();
        $news = News::findOrFail($id);
        return view('Admin.News.edit', compact('cats', 'news'));
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
        $request->validate([
            'head' => 'required',
            'news_category_id' => 'required',
        ]);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = 'imgs' . '_' . time() . '.' . $ext;
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $imgname = 'uploads/' . basename($storagePath);
        }
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $ext = $file->getClientOriginalExtension();
            $filename = 'videos' . '_' . time() . '.' . $ext;
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $videoname = 'uploads/' . basename($storagePath);
        }
        $news = News::findOrFail($id);
        $news->update([
            'head' => $request->head,
            'body' => $request->body ?? $news->body,
            'img' => $imgname ?? $news->img,
            'video' => $videoname ?? $news->video,
            'news_category_id' => $request->news_category_id
        ]);
        return redirect()->route('admin.news.index')->with('success', 'تم التعديل ');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cat = News::findOrFail($request->deleteItemId);
        $cat->delete();
        return redirect()->route('admin.news.index')->with('success', 'Deleted Successfully');
    }
    public function newdel(Request $request)
    {
        $cat = News::findOrFail($request->id);
        $cat->delete();
        return redirect()->route('admin.news.index')->with('success', 'Deleted Successfully');
    }
}
