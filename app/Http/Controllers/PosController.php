<?php

namespace App\Http\Controllers;

use App\Models\Pos;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pos = Pos::get();

        return view('pos.index', [
            'pos' => $pos,
          
        ]);
    }
    public function add()
    {
                $inventory = Inventory::get();
        return view('pos.add', [  
            'inventory' => $inventory,
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

        $validated = $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255']
        ]);

        $description = '';

        $inv = Inventory::where('id', '=',$request->description)->first();


        $currentQuantity = $inv->quantity;
        
        $inv->update([
            'quantity' => $currentQuantity - $request->quantity
        ]);

        $description = $inv->name . ' - x' . $request->quantity;

        $total = $request->amount * $request->quantity;


        Pos::create([
            'description' => $description,
            'amount' => $total,
            'type' => $request->type,
        ]);

        return redirect(route('pos.index', absolute: false))->with('message', 'POS Entry created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pos $pos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pos $pos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pos $pos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pos $pos)
    {
        //
        $pos->delete();

        return redirect(route('pos.index'))->with('message', 'POS Entry deleted successfully!');
    }
}
