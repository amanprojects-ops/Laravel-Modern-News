<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\Filelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $settings = Setting::first();
        $file = $request->file('file');
        $filename = bin2hex(random_bytes(8)) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('attachments', $filename, 'public');

        $filelist = new Filelist();
        $filelist->file_title = $request->input('title');
        $filelist->file_name = $filename;
        $filelist->slug = $settings->url . '/storage/attachments/' . $filename;
        $filelist->save();

        return redirect()->route('admin.attachements.view')->with('success', 'File uploaded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd("id is" . $id);
        // $file = Filelist::find($id);

        // if (!$file) {
        //     return redirect()->route('admin.attachements.view')->with('error', 'File not found');
        // }

        // return view('admin.attachement.show', compact('file'));
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
        if ($file && Storage::disk('public')->exists('attachments/' . $file->file_name)) {
            Storage::disk('public')->delete('attachments/' . $file->file_name);
            $file->delete();
            return redirect()->route('admin.attachements.view')->with('success', 'File deleted successfully');
        }
    }
}
