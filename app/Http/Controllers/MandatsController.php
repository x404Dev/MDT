<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Dossier;
use App\Models\Mandat;
use Illuminate\Http\Request;

class MandatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled("search")) {
            $search = $request->search;
            $mandats = [];

            if (is_numeric($search)) {
                //check for IDs
                //Dossier IDs
                $mandID = Mandat::find($search);
                if ($mandID != null) {
                    array_push($mandats, $mandID);
                }
            } else {
                //Check for names
                $mandSearch = Dossier::query()->where('nom', 'LIKE', "%{$search}%")->first();
                if ($mandSearch != null) {
                    $mandats = $mandSearch->mandats()->paginate(25);
                }
            }

            return view('mandats.index', [
                'mandats' => $mandats,
                'search' => $search,
            ]);
        } else {
            return view('mandats.index', [
                'mandats' => Mandat::orderBy('created_at', 'desc')->paginate(25),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        return view('mandats.create', [
            'dossier' => Dossier::find($id),
            'charges' => Charge::orderBy('nom')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            "titre" => 'required|min:5|max:255|string',
            "notes" => 'required|min:5|string',
        ]);

        //store
        $mandat = new Mandat();
        $mandat->titre = $request->input('titre');
        $mandat->notes = $request->input('notes');
        $mandat->charges = $request->input('charges');
        $mandat->dossier_id = $id;
        $mandat->user_id = auth()->user()->id;
        $mandat->save();

        return redirect("/dossiers/" . $id)->with('success', 'Le mandat à été créé avec succès!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mandat = Mandat::find($id);

        $charges = [];

        if ($mandat->charges != '') {

            foreach (explode(',', $mandat->charges) as $charge) {
                $str = explode('x', $charge);
                array_push($charges, [
                    'id' => $str[0],
                    'amt' => $str[1],
                ]);
            }
        }
        // dd($charges);
        return view('mandats.show', [
            'mandat' => $mandat,
            'dossier' => Dossier::find($mandat->dossier_id),
            'chargesAll' => Charge::orderBy('nom')->get(),
            'charges' => $charges,
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
        $request->validate([
            "titre" => 'required|min:5|max:255|string',
            "notes" => 'required|min:5|string',
        ]);

        //store
        $mandat = Mandat::find($id);
        $mandat->titre = $request->input('titre');
        $mandat->notes = $request->input('notes');
        $mandat->charges = $request->input('charges');
        $mandat->save();

        return redirect("/mandats/" . $mandat->id)->with('success', 'Le mandat à été modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->role_id != 1) {
            return redirect('/mandats')->with('error', 'Vous n\'avez pas les droits pour supprimer un mandat!');
        }
        $mandat = Mandat::find($id);
        if ($mandat == null) {
            return redirect('/mandats')->with('error', 'Le mandat n\'existe pas!');
        }
        $dossier_id = $mandat->dossier_id;
        $mandat->delete();

        return redirect("mandats")->with('success', 'Le mandat à été supprimé avec succès!');
    }
}
