<?php

namespace App\Http\Controllers;

use App\Models\PartieCour;
use App\Models\Quiz;
use App\Models\QuestionsQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartieCourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Création de la partie du cours (chapitre)
        $partieCour = new PartieCour();
        $partieCour->titre = $request->titre;
        $partieCour->order = $request->order;
        $partieCour->contenu_definition = $request->contenu_definition;
        $partieCour->contenu_propriete = $request->contenu_propriete;
        $partieCour->contenu_exemple = $request->contenu_exemple;
        $partieCour->url_video = $request->url_video;
        $partieCour->contenu_exercice = $request->contenu_exercice;
        $partieCour->solution_exercice_video = $request->solution_exercice_video;
        $partieCour->solution_exercice_text = $request->solution_exercice_text;
        $partieCour->difficulte_exercice = $request->difficulte_exercice;
        $partieCour->cour_id = $request->cour_id;
        $partieCour->save();

        // Si des questions sont soumises, créer un quiz
        if ($request->has('questions') && is_array($request->questions)) {
            $quiz = new Quiz();
            $quiz->partie_cour_id = $partieCour->id;
            $quiz->save();

            // Ajouter chaque question
            foreach ($request->questions as $index => $questionText) {
                if (!empty($questionText)) {
                    $question = new QuestionsQuiz();
                    $question->partie_id = $quiz->id;  // Changed from partie_id to quiz_id
                    $question->question = $questionText;
                    
                    // Récupérer les propositions pour cette question
                    $propositions = $request->input("propositions.$index", []);
                    
                    // Stocker les propositions en JSON
                    $question->propositions = json_encode($propositions);
                    
                    // Réponse correcte
                    $correctAnswer = $request->input("correct_answer.$index");
                    if (!empty($correctAnswer)) {
                        $question->correct_answer = $correctAnswer;  // Changed from correct_answer to indice_vrai
                    }
                    
                    $question->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Chapitre ajouté avec succès!');
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
    public function show(PartieCour $partieCour)
    {
        $partieCour = PartieCour::find(4);
        return view('user.ContenusCour.contenucour',compact('partieCour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PartieCour $partieCour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PartieCour $partieCour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PartieCour $partieCour)
    {
        //
    }
}
