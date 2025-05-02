<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
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
}
