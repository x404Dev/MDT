<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use App\Models\Mandat;
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
                'dossiers' => Dossier::withCount('mandats')->paginate(25),
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
            'nom.min' => 'Le nom doit faire au moins 3 caract??res',
            'nom.max' => 'Le nom doit faire au plus 50 caract??res',
            'nom.string' => 'Le nom doit ??tre une cha??ne de caract??res',
            'telephone.max' => 'Le num??ro de t??l??phone doit faire 7 caract??res',
            'emploi.max' => 'L\'emploi doit faire au plus 50 caract??res',
            'photo.max' => 'Le lien de la photo doit faire au plus 255 caract??res',
        ]);

        $dossier = new Dossier();
        if (!$dossier) {
            return redirect()->route('dossiers.index')->with('error', 'Le dossier n\'existe pas!');
        }
        $dossier->nom = $request->input('nom');
        $dossier->telephone = $request->input('telephone');
        $dossier->emploi = $request->input('emploi');
        $dossier->photo = $request->input('photo');
        $dossier->notes = $request->input('notes');
        $dossier->user_id = auth()->user()->id;
        $dossier->save();

        return redirect()->route('dossiers.show', $dossier->id)->with('success', 'Le dossier ?? ??t?? cr????!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dossier = Dossier::withCount(['rapports', 'mandats'])->find($id);
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
            'nom' => 'required|min:3|max:50|string',
            'telephone' => 'max:7',
            'emploi' => 'max:50',
            'photo' => 'max:255',
        ], [
            'nom.required' => 'Vous devez mettre un nom!',
            'nom.min' => 'Le nom doit faire au moins 3 caract??res',
            'nom.max' => 'Le nom doit faire au plus 50 caract??res',
            'nom.string' => 'Le nom doit ??tre une cha??ne de caract??res',
            'telephone.max' => 'Le num??ro de t??l??phone doit faire 7 caract??res',
            'emploi.max' => 'L\'emploi doit faire au plus 50 caract??res',
            'photo.max' => 'Le lien de la photo doit faire au plus 255 caract??res',
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

        return redirect()->route('dossiers.show', $dossier->id)->with('success', 'Le dossier ?? ??t?? modifi??!');
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
            return redirect()->route('dossiers.index')->with('error', 'Vous n\'avez pas les droits pour supprimer un dossier!');
        }
        $dossier = Dossier::find($id);
        if ($dossier == null) {
            return redirect()->route('dossiers.index')->with('error', 'Le dossier n\'existe pas!');
        }
        $dossier->delete();

        //delete all mandats with dossier_id
        $mandats = Mandat::where('dossier_id', $id)->get();
        foreach ($mandats as $mandat) {
            $mandat->delete();
        }
        return redirect()->route('dossiers.index')->with('success', 'Le dossier ?? ??t?? supprim??!');
    }
}
