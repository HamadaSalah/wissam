<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Add;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AddsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(Add::all(), 200);
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
            'img' => 'required',
        ]);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = 'imgs' . '_' . time() . '.' . $ext;
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $imgname = basename($storagePath);
        }
        $prog = Add::create([
            'img' => '/uploads/' . $imgname,
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
        // dd($request->all());
        $request->validate([
            'img' => 'required|mimes:png,jpg,jpeg,webp,svg',
        ]);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = 'imgs' . '_' . time() . '.' . $ext;
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $imgname = basename($storagePath);
        }
        $prog = Add::findOrFail($id);

        $prog->update([
            'img' => '/uploads/' . $imgname,
        ]);
        return response()->json($prog, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prog = Add::findOrFail($id);
        $prog->delete();
        return response()->json(['message' => 'Advertise Deleted Successfully'], 200);
    }
}
