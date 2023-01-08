<?php

namespace App\Http\Controllers;

use App\Models\BOLO;
use Illuminate\Http\Request;

class BolosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bolos = [];
        if ($request->filled("search")) {
            $search = $request->search;

            if (is_numeric($search)) {
                $bolos = BOLO::query()->where('id', $search)->paginate(25);
                return view('bolos.index', [
                    'bolos' => $bolos,
                    'search' => $search,
                ]);
            } else {
                $bolos = BOLO::query()->where('notes', 'LIKE', "%{$search}%")->paginate(25);
                return view('bolos.index', [
                    'bolos' => $bolos,
                    'search' => $search,
                ]);
            }

        } else {
            $bolos = BOLO::orderBy('created_at', 'desc')->paginate(25);
        }
        return view('bolos.index', [
            'bolos' => $bolos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bolos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|min:3|max:50',
            'notes' => 'required|min:5|string',
            'type' => 'required|string',
        ]);

        $bolo = new BOLO();
        $bolo->nom = $request->input('nom');
        $bolo->notes = $request->input('notes');
        $bolo->type = $request->input('type');
        $bolo->user_id = auth()->user()->id;
        $bolo->save();
        return redirect()->route('bolos.index')->with('success', 'Le BOLO à été créé avec succès!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $bolo = BOLO::find($id);
        if (!$bolo) {
            return redirect()->route('bolos.index')->with('error', 'Le BOLO n\'existe pas!');
        }
        return view('bolos.view', [
            'bolo' => $bolo,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (!$bolo) {
            return redirect()->route('bolos.index')->with('error', 'Le BOLO n\'existe pas!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->role_id != 1) {
            return redirect()->route('bolos.index')->with('error', 'Vous n\'avez pas les droits pour supprimer un BOLO!');
        }
        $bolo = BOLO::find($id);
        if (!$bolo) {
            return redirect()->route('bolos.index')->with('error', 'Le BOLO n\'existe pas!');
        }
        $bolo->delete();

        return redirect()->route('bolos.index')->with('success', 'Le BOLO à été supprimé avec succès!');
    }
}
