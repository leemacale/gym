<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $announcement = Announcements::get();
        return view('announcement.index', [
            'announcement' => $announcement,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function add()
    {
        return view('announcement.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Announcements::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => 'images/' . $imageName,
        ]);

        return redirect(route('announcement.index', absolute: false))->with('message', 'Announcement created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcements $announcements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcements $announcements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcements $announcements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcements $announcements)
    {
        //

        unlink($announcements->image);
        $announcements->delete();

        return redirect(route('announcement.index'))->with('message', 'Announcement deleted successfully!');
    }
}
