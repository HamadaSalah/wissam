<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $programs = Program::all();
        $videos = Video::with('program')->latest()->get();
        return view('Admin.Video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programs = Program::all();

        return view('Admin.Video.create', compact('programs'));
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
            'program_id' => 'required|exists:programs,id',
            'title' => 'required',
            'img' => 'required',
            'video' => 'required'
        ]);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = 'imgs' . '_' . time() . '.' . $ext;
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $imgname = basename($storagePath);
        }
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $ext = $file->getClientOriginalExtension();
            $filename = 'imgs' . '_' . time() . '.' . $ext;
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $videoname = basename($storagePath);
        }
        $prog = Video::create([
            'program_id' => $request->program_id,
            'title' => $request->title,
            'img' => '/uploads/' . $imgname,
            'video' => '/uploads/' . $videoname
        ]);
        return redirect()->route('admin.video.index')->with('success', 'تم الاضافة');
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
        $programs = Program::all();
        $video = Video::findOrFail($id);
        return view('Admin.Video.edit', compact('programs', 'video'));
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
            'program_id' => 'required|exists:programs,id',
            'title' => 'required',
            // 'img' => 'required',
            // 'video' => 'required'
        ]);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = 'imgs' . '_' . time() . '.' . $ext;
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $imgname = basename($storagePath);
            $myimg = '/uploads/' . $imgname;
        }
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $ext = $file->getClientOriginalExtension();
            $filename = 'imgs' . '_' . time() . '.' . $ext;
            $storagePath = Storage::disk('public_uploads')->put('/uploads/', $file);
            $videoname = basename($storagePath);
            $myvid = '/uploads/' . $videoname;
        }

        $video = Video::findOrFail($id);
        $video->update([
            'program_id' => $request->program_id,
            'title' => $request->title,
            'img' => $myimg ?? $video->img,
            'video' => $myvid ??  $video->video
        ]);
        return redirect()->route('admin.video.index')->with('success', 'تم التعديل');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prog = Video::findOrFail($id);
        $prog->delete();

        return redirect()->back()->with('success', 'تم الحذف');
    }
}
