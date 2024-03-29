<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;

use App\Models\Roll;
use Illuminate\Http\Request;

class RollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roll = Roll::all();
        return response()->json($roll);
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
        try {
            $request->validate(['name' => 'required']);

            $roll = Roll::create($request->all());

            $bitacora = Bitacora::add("Un nuevo Roll fue crado con el id: {$roll->id}");

            if (!$bitacora) {
                throw new \Exception('Error creando el log.');
            }

            return response()->json(['roll' => $roll]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $roll = Roll::findOrFail($id);
        return response()->json($roll);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roll $roll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|unique:rolls,name,' . $id,
            ]);

            $roll = Roll::findOrFail($id);
            $roll->update($request->all());

            $bitacora = Bitacora::add("Un Roll con el id {$id} fue actualizado.");

            if (!$bitacora) {
                throw new \Exception('Error creando el log.');
            }

            return response()->json($roll);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        try {
            $roll = Roll::findOrFail($id);
            $roll->delete();

            $Bitacora = Bitacora::add("Roll con el id: {$id} fue eliminado.");

            if (!$Bitacora) {
                throw new \Exception('Error creando el log.');
            }

            return response()->json(['message' => 'El Roll fue eliminado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function CstatusR(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:active,inactive'
            ]);

            $newStatus = $request->input('status');

            $roll = Roll::findOrFail($id);
            $roll->status = $newStatus;
            $roll->save();

            $statusChange = ($newStatus == 'active') ? 'activated' : 'inactivated';
            $bitacora = Bitacora::add("El Roll con el id: {$roll->id} Fue $statusChange.");

            if (!$bitacora) {
                throw new \Exception('Error creando el log.');
            }

            return response()->json(['message' => 'El estado del Rol cambió satisfactoriamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
