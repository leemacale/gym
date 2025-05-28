<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WeightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //


            $weight = Weight::where('user_id', Auth::user()->id)->get();

            return view('weight.index', [
            'weight' => $weight,

        ]);
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

          $date = Carbon::now()->toDateString();
          Weight::create([
            'weight' => $request->weight,
            'remarks' => $request->remarks,
            'date' => $date,
            'user_id' => Auth::user()->id,
        ]);

          return redirect(route('weight.index', absolute: false))->with('message', 'weight progress added successfully!');
    }

    public function add()
    {

        return view('weight.add');
    }


    public function weightChartData()
    {
        $data = DB::table('weights')
            ->select('weight', 'date', 'remarks')
            ->where('user_id', Auth::user()->id)
            ->orderBy('date')
            ->get();

        return response()->json($data);
    }
    /**
     * Display the specified resource.
     */
    public function show(Weight $weight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Weight $weight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Weight $weight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Weight $weights)
    {
        //

           $weights->delete();

        return redirect(route('weight.index'))->with('message', 'Weight deleted successfully!');
    }
}
