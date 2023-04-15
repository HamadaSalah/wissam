<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class CatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = NewsCategory::where('category', NULL)->with('categories')->get();
        return view('Admin.Cats.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = NewsCategory::where('category', NULL)->with('categories')->get();

        return view('Admin.Cats.create', compact('cats'));
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
            'name' => 'required',
        ]);
        NewsCategory::create([
            'name' => $request->name,
            'category' => $request->category,
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Created Successfully');
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
        $cat = NewsCategory::findOrFail($id);
        return view('Admin.Cats.edit', compact('cat'));
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
            'name' => 'required'
        ]);
        $cat = NewsCategory::findOrFail($id);
        $cat->update([
            'name' => $request->name
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cat = NewsCategory::findOrFail($request->deleteItemId);
        $cat->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Deleted Successfully');
    }
    public function catdel(Request $request)
    {
        $cat = NewsCategory::findOrFail($request->id);
        $cat->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Deleted Successfully');
    }
}
