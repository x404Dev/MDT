<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Dossier;
use App\Models\Rapport;
use Illuminate\Http\Request;

class RapportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('dossiers.rapports.create', [
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
        //validate
        $request->validate([
            "titre" => 'required|min:5|max:255|string',
            "notes" => 'required|min:5|string',
        ]);

        //store
        $rapport = new Rapport();
        $rapport->titre = $request->input('titre');
        $rapport->notes = $request->input('notes');
        $rapport->charges = $request->input('charges');
        $rapport->dossier_id = $id;
        $rapport->user_id = auth()->user()->id;
        $rapport->save();

        return redirect("/dossiers/" . $id)->with('success', 'Rapport créé avec succès!');
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
        $rapport = Rapport::find($id);

        $charges = [];

        if ($rapport->charges != '') {

            foreach (explode(',', $rapport->charges) as $charge) {
                $str = explode('x', $charge);
                array_push($charges, [
                    'id' => $str[0],
                    'amt' => $str[1],
                ]);
            }
        }
        // dd($charges);
        return view('dossiers.rapports.show', [
            'rapport' => $rapport,
            'dossier' => Dossier::find($rapport->dossier_id),
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

        $rapport = Rapport::find($id);
        $rapport->titre = $request->input('titre');
        $rapport->notes = $request->input('notes');
        $rapport->charges = $request->input('charges');
        $rapport->save();
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
            return redirect("/dossiers/" . $rapport->dossier_id)->with('error', 'Vous n\'avez pas les droits pour supprimer ce rapport!');
        }

        $rapport = Rapport::find($id);
        if ($rapport == null) {
            return redirect("/dossiers/" . $rapport->dossier_id)->with('error', 'Rapport introuvable!');
        }
        $rapport->delete();
        return redirect("/dossiers/" . $rapport->dossier_id)->with('success', 'Rapport supprimé avec succès!');
    }
}
