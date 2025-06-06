<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\programExercise;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         //
        $program = Program::where('user_id','=', Auth::user()->id)->get();


        return view('program.index', [
            'program' => $program
        ]);
    }

      public function add()
    {
        return view('program.add');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       Program::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);

        return redirect(route('program.index', absolute: false))->with('message', 'Program created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $programs)
    {
        //
        $workout = programExercise::where('program_id', $programs->id)->get();

        return view('program.edit', [
            'program' => $programs,
            'workout' => $workout
        ]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $programs)
    {
        //
        $programs->delete();
        return redirect(route('program.index'))->with('message', 'Program deleted successfully!');
    }
}
