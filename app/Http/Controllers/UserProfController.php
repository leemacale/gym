<?php

namespace App\Http\Controllers;

use App\Models\UserProf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        //


        return view('calculator.step3', ['userprof' => $userprof]);
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
