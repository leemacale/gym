<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Exercise;
use App\Models\LinkExercise;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $equipment = Equipment::get();

        return view('equipment.index', [
            'equipment' => $equipment
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */ public function add()
    {
        return view('equipment.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Equipment::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'image' => 'images/' . $imageName,
        ]);

        return redirect(route('equipment.index', absolute: false))->with('message', 'Equipment created successfully!');
    }


    public function storeexercise(Request $request)
    {
        //

        $validated = $request->validate([
            'exercise_id' => ['required', 'string', 'max:255'],
            'equipment_id' => ['required', 'string', 'max:255'],

        ]);


        LinkExercise::create($validated);

        return redirect(route('equipment.exercises', $request->equipment_id))->with('message', 'exercise  added successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipments)
    {
        //

        return view('equipment.edit', [
            'equipments' => $equipments,
        ]);
    }


    public function qr(Equipment $equipments)
    {
        //

        return view('equipment.qr', [
            'equipments' => $equipments,
        ]);
    }

    public function views(Equipment $equipments)
    {
        //
        $linkexercise = LinkExercise::where('equipment_id', $equipments->id)->get();
        return view('equipment.view', [
            'equipments' => $equipments,
            'linkexercise' => $linkexercise,
        ]);
    }


    public function exercises(Equipment $equipments)
    {
        //

        $linkexercise = LinkExercise::where('equipment_id', $equipments->id)->get();

        return view('equipment.exercises', [
            'equipments' => $equipments,
            'linkexercise' => $linkexercise,
        ]);
    }

    public function addexercises(Equipment $equipments)
    {
        //

        $exercises = Exercise::get();

        return view('equipment.addexercises', [
            'equipments' => $equipments,
            'exercise' => $exercises,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipments)
    {
        //

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'string', 'max:255']
        ]);

        $equipments->update($validated);

        return redirect(route('equipment.index'))->with('message', 'Equipment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipments)
    {
        //
        unlink($equipments->image);
        $equipments->delete();

        return redirect(route('equipment.index'))->with('message', 'Equipment deleted successfully!');
    }

    public function destroy2(LinkExercise $exercises)
    {

        $exercises->delete();

        return redirect(route('equipment.exercises', $exercises->equipment_id));
    }
}
