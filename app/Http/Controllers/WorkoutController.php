<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\workout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $mytime = Carbon::now();
        $now = $mytime->toDateString();
        $workout = Workout::where('user_id', Auth::user()->id)->where('date', $now)->get();

        return view('workout.index', [
            'workout' => $workout
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
        $exercise = Exercise::get();
        return view('workout.add', [
            'exercise' => $exercise
        ]);
    }

    public function addlog(Exercise $exercises)
    {

        return view('workout.addlog', [
            'exercise' => $exercises
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $reps = $request->reps;
        $exercise_id = $request->exercise_id;
        $date = Carbon::now()->toDateString();
        $user_id = Auth::user()->id;

        Workout::create([
            'reps' => $reps,
            'exercise_id' => $exercise_id,
            'date' => $date,
            'user_id' => $user_id,

        ]);

        return redirect(route('workout.index', absolute: false))->with('message', 'Exercise added to Workout successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(workout $workout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(workout $workout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, workout $workout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(workout $workouts)
    {
        //

        $workouts->delete();

        return redirect(route('workout.index'))->with('message', 'Exercise deleted from Workout successfully!');
    }
}
