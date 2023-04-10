<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
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
            'img' => $imgname,
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
}
