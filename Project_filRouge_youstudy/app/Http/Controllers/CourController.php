<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use Illuminate\Http\Request;

class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cour::withCount('partieCour')
            ->orderBy('order_cour', 'asc')
            ->orderBy('niveau', 'asc')
            ->orderBy('matiere_cour', 'asc')
            ->get();   
        return view('admin.cours.index', compact('cours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        validator($request->all(), [
            'order_cour' => 'required|integer|min:1',
            'niveau' => 'required|string|max:255',
            'matiere_cour' => 'required|string',
            'titre' => 'required|string',
            'description' => 'required|string',
        ])->validate();


      // dd($request->all());
        $existingCour = Cour::where([
            'order_cour' => $request->input('order_cour'),
            'matiere_cour' => $request->input('matiere_cour'),
            'niveau' => $request->input('niveau'),
        ])->first();

       // dd($existingCour);
        
        if ($existingCour) {
            return redirect()->back()->withErrors(['order' => 'cette order de cour déja existe.']);
        }

      //  dd($request->all());

        $cour = new Cour();
        $cour->create([
            'order_cour' => $request->input('order_cour'),
            'niveau' => $request->input('niveau'),
            'matiere_cour' => $request->input('matiere_cour'),
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
        ]);
        return redirect()->back()->with('success', 'Le cours a été créé avec succès.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cour $cour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       // dd($id);
        $cour = Cour::find($id);
        if (!$cour) {
            return redirect()->back()->withErrors(['error' => 'Le cours n\'existe pas.']);
        }
        return view('admin.cours.edit',compact('cour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        validator($request->all(), [
            'order_cour' => 'required|integer|min:1',
            'niveau' => 'required|string|max:255',
            'matiere_cour' => 'required|string',
            'titre' => 'required|string',
            'description' => 'required|string',
        ])->validate();

        $existingCour = Cour::where([
            'order_cour' => $request->input('order_cour'),
            'matiere_cour' => $request->input('matiere_cour'),
            'niveau' => $request->input('niveau'),
        ])->where('id', '!=', $id)->first();
        if ($existingCour) {
            return redirect()->back()->withErrors(['order' => 'cette order de cour déja existe.']);
        }
        $cour = Cour::find($id);
        if (!$cour) {
            return redirect()->back()->withErrors(['error' => 'Le cours n\'existe pas.']);
        }
        $cour->update([
            'order_cour' => $request->order_cour,
            'niveau' => $request->niveau,
            'matiere_cour' => $request->matiere_cour,
            'titre' => $request->titre,
            'description' => $request->description,
        ]);
        return redirect()->route('cours')->with('success', 'Le cours a été mis à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cour = Cour::find($id);
        if ($cour) {
            $cour->delete();
            return redirect()->back()->with('success', 'Le cours a été supprimé avec succès.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Le cours n\'existe pas.']);
        }
    }
}
