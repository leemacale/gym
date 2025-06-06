<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Program;
use App\Models\UserProf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
     
    }
    public function step1()
    {
        //

        return view('calculator.step1');
    }

    public function step2(UserProf $userprof)
    {
        //


        return view('calculator.step2', ['userprof' => $userprof]);
    }

    public function step3(UserProf $userprof)
    {
        // Names for recommended programs
        $recommendedNames = [
            "Recommended Program 1",
            "Recommended Program 2",
            "Recommended Program 3"
        ];

        $userId = Auth::user()->id;

        // Only create recommended programs if they do not exist for this user
        $existingProgramsCount = Program::where('user_id', $userId)
            ->whereIn('name', $recommendedNames)
            ->count();

        if ($existingProgramsCount < count($recommendedNames)) {
            foreach ($recommendedNames as $name) {
                $program = Program::where('user_id', $userId)
                    ->where('name', $name)
                    ->first();

                if (!$program) {
                    $program = Program::create([
                        'name' => $name,
                        'user_id' => $userId,
                    ]);

                    // Get 1 random warm-up exercise (category_id = 9)
                    $warmup = \App\Models\Exercise::where('category_id', 9)->inRandomOrder()->first();
                    if ($warmup) {
                        for ($i = 0; $i < 3; $i++) {
                            $program->exercises()->create([
                                'exercise_id' => $warmup->id,
                                'weight' => rand(5, 10),
                                'reps' => 8,
                                'remarks' => 'Set ' . ($i + 1),
                                'date' => now()->toDateString(),
                            ]);
                        }
                    }

                    // Add 5 other random (non-warmup) exercises, each repeated 3 times
                    $randomExercises = \App\Models\Exercise::where('category_id', '!=', 9)
                        ->inRandomOrder()
                        ->limit(5)
                        ->get();

                    foreach ($randomExercises as $exercise) {
                        for ($i = 0; $i < 3; $i++) {
                            $program->exercises()->create([
                                'exercise_id' => $exercise->id,
                                'weight' => rand(5, 10),
                                'reps' => 8,
                                'remarks' => 'Set ' . ($i + 1),
                                'date' => now()->toDateString(),
                            ]);
                        }
                    }
                }
            }
        }

        // Show both user's and default (user_id = 1) recommended programs
            $program = Program::where('user_id','=', Auth::user()->id)->orWhere('user_id',  '=', '1')->get();


        return view('calculator.step3', ['userprof' => $userprof, 'program' => $program]);
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
        $validated = $request->validate([
            'user_id' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'weight' => ['required', 'string', 'max:255'],
            'height' => ['required', 'string', 'max:255'],
            'activity' => ['required', 'string', 'max:255'],
            

        ]);
        $userprof = UserProf::create($validated);

        return redirect(route('calculator.step2', ['userprof' => $userprof]))->with('message', 'Profile added successfully!');
    }

    public function store2(Request $request)
    {
        //

        $userprof = UserProf::find($request->user_id);

        $userprof->update([
            'goal' => $request->goal,
            'date' => $request->date,
            'tdee' => $request->tdee,
            
            
        ]);

        return redirect(route('calculator.step3', ['userprof' => $userprof]))->with('message', 'Profile updated successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProf $userProf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProf $userProf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserProf $userProf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProf $userProf)
    {
        //
    }
}
