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
        return view('exercise.add');
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
        ]);
        Exercise::create($validated);

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
    public function edit(Exercise $exercise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercise $exercise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        //
    }
}
