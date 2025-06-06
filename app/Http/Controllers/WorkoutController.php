<?php

namespace App\Http\Controllers;

use App\Models\programExercise;
use Carbon\Carbon;
use App\Models\Program;
use App\Models\workout;
use App\Models\Calendar;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

                  $program = Program::where('user_id','=', Auth::user()->id)->get();
        $mytime = Carbon::now();
        $now = $mytime->toDateString();
        $date = request()->date;
        if (request()->date != '') {

            $workout = Workout::where('user_id', Auth::user()->id)->where('date', request()->date)->get();
        } else {

            $workout = Workout::where('user_id', Auth::user()->id)->where('date', $now)->get();
        }

        return view('workout.index', [
            'workout' => $workout,
            'date' => $date,
            'program' => $program
        ]);
    }

    public function date(Date $date)
    {


        $workout = Workout::where('user_id', Auth::user()->id)->where('date', $date)->get();

        return view('workout.date', [
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
                    $program = Program::where('user_id','=', Auth::user()->id)->get();

        return view('workout.add', [
            'exercise' => $exercise,
            'program' => $program
        ]);
    }

     public function add2(Program $program)
    {
        $exercise = Exercise::get();
        return view('program.add2', [
            'exercise' => $exercise,
            'program' => $program
        ]);
    }

    public function addlog(Exercise $exercises)
    {
               $program = Program::where('user_id','=', Auth::user()->id)->get();
        return view('workout.addlog', [
            'exercise' => $exercises,
            'program' => $program
        ]);
    }
    

     public function addlog2(Exercise $exercises,  Program $program)
    {

        return view('program.addlog', [
            'exercise' => $exercises,
            'program' => $program
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
            'weight' => $request->weight,
            'remarks' => $request->remarks,

        ]);

        $calendar = Calendar::where('created_at', 'like', '%' . $date . '%')->where('user_id', Auth::user()->id)->get();


        Calendar::create([
            'comment' => 'Workout ...',
            'user_id' => Auth::user()->id,
            'start_date' => $date,
            'end_date' => $date,
        ]);


        return redirect(route('workout.index', absolute: false))->with('message', 'Exercise added to Workout successfully!');
    }

       public function store2(Request $request)
    {
        //
        $reps = $request->reps;
        $exercise_id = $request->exercise_id;
        $date = Carbon::now()->toDateString();
        $program_id = $request->program_id;

        programExercise::create([
            'reps' => $reps,
            'exercise_id' => $exercise_id,
            'date' => $date,
            'program_id' => $program_id,
            'weight' => $request->weight,
            'remarks' => $request->remarks,

        ]);

        $programs = Program::where('id', '=',$program_id)->get();
        

        return redirect(route('program.edit', $program_id))->with('message', 'Exercise added to Workout successfully!');
    }


    public function copy(Request $request)
    {
        //
        $olddate = $request->old;
        $newdate = $request->date;

        $workout = Workout::where('user_id', Auth::user()->id)->where('date', $olddate)->get();

        foreach ($workout as $newworkout) {
            Workout::create([
                'reps' => $newworkout->reps,
                'exercise_id' => $newworkout->exercise_id,
                'date' => $newdate,
                'user_id' => $newworkout->user_id,
                'weight' => $newworkout->weight,
            'remarks' => $newworkout->remarks,


            ]);
        }


        $calendar = Calendar::where('created_at', 'like', '%' . $newdate . '%')->where('user_id', Auth::user()->id)->get();


        Calendar::create([
            'comment' => 'Workout ...',
            'user_id' => Auth::user()->id,
            'start_date' => $newdate,
            'end_date' => $newdate,
        ]);


        return redirect('/workout?date=' . $newdate);
    }


    /**
     * Display the specified resource.
     */
    public function show(workout $workout)
    {
        //
    }

    public function userprogram(Program $programs)
    {
        //

        foreach($programs->exercises as $exercise) {
            Workout::create([
                'reps' => $exercise->reps,
                'exercise_id' => $exercise->exercise_id,
                'date' => Carbon::now()->toDateString(),
                   'user_id' => Auth::user()->id,
                'weight' => $exercise->weight,
                'remarks' => $exercise->remarks,
            ]);
        }

                return redirect(route('workout.index', absolute: false))->with('message', 'Exercise added to Workout successfully!');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(workout $workouts)
    {
        //
              $program = Program::where('user_id','=', Auth::user()->id)->get();

        return view('workout.edit', [
            'workouts' => $workouts,
            'program' => $program
        ]);
    }

    
    public function edit2(programExercise $workouts, Program $program)
    {
        //

        return view('program.edit2', [
            'workouts' => $workouts,
            'program' => $program
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, workout $workouts)
    {
        //

        $workouts->update([
            'reps' => $request->reps,
            'weight' => $request->weight,
            'remarks' => $request->remarks,
        ]);
        return redirect(route('workout.index', absolute: false));
    }

      public function update2(Request $request, programExercise $workouts)
    {
        //
    

        $workouts->update([
            'reps' => $request->reps,
            'weight' => $request->weight,
            'remarks' => $request->remarks,
        ]);

        $programs = Program::where('id', '=', $request->program_id)->first();
        
    return redirect(route('program.edit', $programs->id))->with('message', 'Exercise updated to Workout successfully!');
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

     public function destroy2(programExercise $workouts, Program $program)
    {
        //

        $workouts->delete();

        $programs = Program::where('id', '=', $program->id)->first();

         return redirect(route('program.edit', $programs->id))->with('message', 'Exercise updated to Workout successfully!');
    }

}
