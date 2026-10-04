<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadHelper;
use App\Models\Setting;
use App\Models\Filelist;
use Illuminate\Http\Request;

class FilelistController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = Filelist::all();
        return view("admin.attachement.view", compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.attachement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file'  => 'required|file|max:10240', // 10MB max
            'title' => 'required|string|max:255',
        ]);

        $settings = Setting::first();
        $path     = UploadHelper::upload($request->file('file'), 'attachments');

        // Extract just the filename from the path
        $filename = basename($path);

        $filelist             = new Filelist();
        $filelist->file_title = $request->input('title');
        $filelist->file_name  = $filename;
        $filelist->slug       = ($settings->url ?? url('/')) . '/uploads/attachments/' . $filename;
        $filelist->save();

        return redirect()->route('admin.attachements.view')->with('success', 'File uploaded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file = Filelist::findOrFail($id);
        return view('admin.attachement.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = Filelist::find($id);
        if ($file) {
            UploadHelper::delete('uploads/attachments/' . $file->file_name);
            $file->delete();
            return redirect()->route('admin.attachements.view')->with('success', 'File deleted successfully');
        }
        return redirect()->route('admin.attachements.view')->with('error', 'File not found');
    }
}
