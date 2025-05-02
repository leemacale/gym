<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $exercise = Exercise::get();
        $category = Category::get();

        return view('exercise.index', [
            'exercise' => $exercise,
            'category' => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        $category = Category::get();
        return view('exercise.add', [
            'category' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'max:255'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Exercise::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => 'images/' . $imageName,
        ]);

        return redirect(route('exercise.index', absolute: false))->with('message', 'Exercise created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exercise $exercises)
    {
        //
        $category = Category::get();
        return view('exercise.edit', [
            'exercises' => $exercises,
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercise $exercises)
    {
        //


        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'max:255']
        ]);

        $exercises->update($validated);

        return redirect(route('exercise.index'))->with('message', 'Exercise updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercises)
    {
        //
        unlink($exercises->image);
        $exercises->delete();

        return redirect(route('exercise.index'))->with('message', 'Exercise deleted successfully!');
    }
}
