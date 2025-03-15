<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $inventory = Inventory::get();

        return view('inventory.index', [
            'inventory' => $inventory
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */ public function add()
    {
        return view('inventory.add');
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
        ]);
        Inventory::create($validated);

        return redirect(route('inventory.index', absolute: false))->with('message', 'Inventory created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventories)
    {
        //

        return view('inventory.edit', [
            'inventories' => $inventories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventories)
    {
        //

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'string', 'max:255']
        ]);

        $inventories->update($validated);

        return redirect(route('inventory.index'))->with('message', 'Inventory updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventories)
    {
        //

        $inventories->delete();

        return redirect(route('inventory.index'))->with('message', 'Inventory deleted successfully!');
    }
}
