<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charge;

class ChargesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $charges = Charge::orderBy('nom')->paginate(35);

        return view('charges.index', [
            'charges' => $charges
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('charges.create');
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
            'nom' => 'required|string|min:3|max:45',
            'cout' => 'required|integer|min:0',
            'mois' => 'required|integer|min:0'
        ]);

        $charge = new Charge([
            'nom' => $request->get('nom'),
            'cout' => $request->get('cout'),
            'mois' => $request->get('mois')
        ]);

        $charge->save();

        return redirect('/charges')->with('success', 'Charge ajoutée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $charge = Charge::find($id);
        if(!$charge) {
            return redirect('/charges')->with('error', 'Charge introuvable');
        }

        return view('charges.show', [
            'charge' => $charge
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
            'nom' => 'required|string|min:3|max:45',
            'cout' => 'required|integer|min:0',
            'mois' => 'required|integer|min:0'
        ]);
        
        $charge = Charge::find($id);
        if(!$charge) {
            return redirect('/charges')->with('error', 'Charge introuvable');
        }
        $charge->nom = $request->get('nom');
        $charge->cout = $request->get('cout');
        $charge->mois = $request->get('mois');
        $charge->save();

        return redirect('/charges')->with('success', 'Charge modifiée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $charge = Charge::find($id);
        if($charge == null) {
            return redirect('/charges')->with('error', 'Charge introuvable');
        }
        $charge->delete();

        return redirect('/charges')->with('success', 'Charge supprimée');
    }
}
