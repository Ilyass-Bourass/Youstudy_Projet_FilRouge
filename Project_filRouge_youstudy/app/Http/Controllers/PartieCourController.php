<?php


namespace App\Http\Controllers;

use App\Models\PartieCour;
use App\Models\Quiz;
use App\Models\QuestionsQuiz;
use Illuminate\Http\Request;
use App\Models\Cour;
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
                    $question->quiz_id = $quiz->id;  // Changed from partie_id to quiz_id
                    $question->question = $questionText;
                    
                    // Récupérer les propositions pour cette question
                    $propositions = $request->input("propositions.$index", []);
                    
                    
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

    public function showPartiesCour(){
        $userNiveau = auth()->user()->niveau;
        $cours = Cour::where('niveau', $userNiveau)->get();
        //dd($cours);
        foreach ($cours as $cour) {
            $cour->parties = PartieCour::where('cour_id', $cour->id)
                                      ->orderBy('order', 'asc')
                                      ->get();
        }
        //dd($cours);
        
        return view('user.partie_cour', compact('userNiveau', 'cours'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id_partie=$id;
        $partieCour = PartieCour::find($id);
        return view('user.ContenusCour.contenucour',compact('partieCour','id_partie'));
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

    public function ChangerNiveau(Request $request)
    {
        $user = auth()->user();
        $user->niveau = $request->niveau; 
        $user->save(); // Save the changes to the database
        return redirect()->back()->with('success', 'Niveau changé avec succès vers : '.$request->niveau);  
    }

    public function showExercice($id)
    {
        $partieCour = PartieCour::find($id);
        return view('user.ContenusCour.exercicesPartie', compact('partieCour'));
    }
}
