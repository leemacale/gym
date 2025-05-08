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
