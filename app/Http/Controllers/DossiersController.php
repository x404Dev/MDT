<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Http\Request;

class DossiersController extends Controller
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
            $dossiers = [];

            if (is_numeric($search)) {
                //check for IDs
                //Dossier IDs
                $dosID = Dossier::find($search);
                if ($dosID != null) {
                    array_push($dossiers, $dosID);
                }

                //Rapport IDs
                // $rapID = Rapport::find($search);
                // if($rapID != null) {
                //     array_push($dossiers, Dossier::find($rapID->dossier_id));
                // }
            } else {
                //Check for names
                $dosSearch = Dossier::query()->where('nom', 'LIKE', "%{$search}%")->paginate(25);
                if ($dosSearch != null) {
                    $dossiers = $dosSearch;
                }
            }

            return view('dossiers.index', [
                'dossiers' => $dossiers,
                'search' => $search,
            ]);
        } else {
            return view('dossiers.index', [
                'dossiers' => Dossier::paginate(25),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dossiers.create');
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
            'nom' => 'required|min:3|max:50|string',
            'telephone' => 'max:7',
            'emploi' => 'max:50',
            'photo' => 'max:255',
        ], [
            'nom.required' => 'Vous devez mettre un nom!',
            'nom.min' => 'Le nom doit faire au moins 3 caractères',
            'nom.max' => 'Le nom doit faire au plus 50 caractères',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'telephone.max' => 'Le numéro de téléphone doit faire 7 caractères',
            'emploi.max' => 'L\'emploi doit faire au plus 50 caractères',
            'photo.max' => 'Le lien de la photo doit faire au plus 255 caractères',
        ]);

        $dossier = new Dossier();
        $dossier->nom = $request->input('nom');
        $dossier->telephone = $request->input('telephone');
        $dossier->emploi = $request->input('emploi');
        $dossier->photo = $request->input('photo');
        $dossier->notes = $request->input('notes');
        $dossier->user_id = auth()->user()->id;
        $dossier->save();

        return redirect()->route('dossiers.show', $dossier->id)->with('success', 'Le dossier à été créé!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dossier = Dossier::withCount('rapports')->find($id);
        if ($dossier) {
            return view('dossiers.view', [
                'dossier' => $dossier,
            ]);} else {
            return redirect()->route('dossiers.index')->with('error', 'Le dossier n\'existe pas!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'nom' => 'required|min:3|max:50|string',
            'telephone' => 'max:7',
            'emploi' => 'max:50',
            'photo' => 'max:255',
        ], [
            'nom.required' => 'Vous devez mettre un nom!',
            'nom.min' => 'Le nom doit faire au moins 3 caractères',
            'nom.max' => 'Le nom doit faire au plus 50 caractères',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'telephone.max' => 'Le numéro de téléphone doit faire 7 caractères',
            'emploi.max' => 'L\'emploi doit faire au plus 50 caractères',
            'photo.max' => 'Le lien de la photo doit faire au plus 255 caractères',
        ]);

        $dossier = Dossier::find($id);
        if ($dossier == null) {
            return redirect()->route('dossiers.index')->with('error', 'Le dossier n\'existe pas!');
        }
        $dossier->nom = $request->input('nom');
        $dossier->telephone = $request->input('telephone');
        $dossier->emploi = $request->input('emploi');
        $dossier->photo = $request->input('photo');
        $dossier->notes = $request->input('notes');

        $dossier->save();

        return redirect()->route('dossiers.show', $dossier->id)->with('success', 'Le dossier à été modifié!');
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
            return redirect()->route('dossiers.index')->with('error', 'Vous n\'avez pas les droits pour supprimer un dossier!');
        }
        $dossier = Dossier::find($id);
        if ($dossier == null) {
            return redirect()->route('dossiers.index')->with('error', 'Le dossier n\'existe pas!');
        }
        $dossier->delete();
        return redirect()->route('dossiers.index')->with('success', 'Le dossier à été supprimé!');
    }
}
