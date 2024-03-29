<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;

use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Pages::all();
        return response()->json($pages);
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
            $request->validate([
                'URL' => 'required',
                'name' => 'required',
                'description' => 'required'
            ]);

            $pages = Pages::create($request->all());

            $Bitacora = Bitacora::add("Una nueva pagina fue creada con el id: {$pages->id}");

            if (!$Bitacora) {
                throw new \Exception('Error creando el log.');
            }

            return response()->json(['paginas' => $pages]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Pages $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pages $pages)
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
                'URL' => 'required',
                'name' => 'required',
                'description' => 'required'
            ]);

            $page = Pages::findOrFail($id);
            $page->update($request->all());

            $Bitacora = Bitacora::add("Pagina con el id: {$page->id} Fue actualizada.");

            if (!$Bitacora) {
                throw new \Exception('Error creando el log.');
            }

            return response()->json($page);
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
            $pages = Pages::findOrFail($id);
            $pages->delete();

            $Bitacora = Bitacora::add("Pagina con el id: {$id} fue eliminada.");

            if (!$Bitacora) {
                throw new \Exception('Error creating log.');
            }

            return response()->json(['message' => 'La  pagina ha sido borrada']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
