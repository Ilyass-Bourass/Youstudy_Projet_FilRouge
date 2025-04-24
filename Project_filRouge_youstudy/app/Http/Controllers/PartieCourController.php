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
        // Récupérer tous les chapitres avec leurs cours associés
        $nombre_chapitre_deuxiemeBac=PartieCour::join('cours','partie_cours.cour_id','=','cours.id')->where('niveau','=','deuxieme_bac')->count();
        $nombre_cahpitre_premier_Bac=PartieCour::join('cours','partie_cours.cour_id','=','cours.id')->where('niveau','=','premier_bac')->count();
        $nombre_cahpitre_tronc_commun=PartieCour::join('cours','partie_cours.cour_id','=','cours.id')->where('niveau','=','tron_commun')->count();

        $statistiques=[
            "nombre_chapitre_deuxieme_bac"=>$nombre_chapitre_deuxiemeBac,
            "nombre_chpitre_premier_Bac"=>$nombre_cahpitre_premier_Bac,
            "nombrechapitre_troncCommmun"=>$nombre_cahpitre_tronc_commun,

        ];

      // dd($statistiques);

        $parties = PartieCour::join('cours', 'partie_cours.cour_id', '=', 'cours.id')
            ->select('partie_cours.*','cours.titre as cours_titre','cours.order_cour', 'cours.niveau', 'cours.matiere_cour')
            ->orderBy('cours.niveau', 'asc')
            ->orderBy('partie_cours.order', 'asc')
            ->orderBy('cours.matiere_cour', 'asc')
            ->get();
            
        $totalParties = PartieCour::count();
       //dd($parties);
       
        return view('admin.chapitres.index',compact('parties','totalParties','statistiques'));
    }

    public function showPartieFetch(Request $request, $id)
    {
        $partieCour = PartieCour::join('cours', 'partie_cours.cour_id', '=', 'cours.id')
            ->select('partie_cours.*', 'cours.titre as cours_titre', 'cours.order_cour', 'cours.niveau', 'cours.matiere_cour')
            ->where('partie_cours.id', $id)
            ->first();

        if (!$partieCour) {
            return response()->json(['error' => 'Partie not found'], 404);
        }
        
        return response()->json($partieCour);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Création de la partie du cours (chapitre)
        validator($request->all(), [
            'titre' => 'required|string|max:255',
            'order' => 'required|integer',
            'contenu_definition' => 'required|string',
            'contenu_propriete' => 'required|string',
            'contenu_exemple' => 'required|string',
            'url_video' => 'nullable|url',
            'contenu_exercice' => 'nullable|string',
            'solution_exercice_video' => 'nullable|url',
            'solution_exercice_text' => 'nullable|string',
            'difficulte_exercice' => 'nullable|string|max:255',
        ])->validate();
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
    public function update(Request $request)
    {
      
        // dd($request->all());
        
        validator($request->all(), [
            'titre' => 'required|string|max:255',
            'order' => 'required|integer',
            'contenu_definition' => 'required|string',
            'contenu_propriete' => 'required|string',
            'contenu_exemple' => 'required|string',
            'url_video' => 'nullable|url',
            'contenu_exercice' => 'nullable|string',
            'solution_exercice_video' => 'nullable|url',
            'solution_exercice_text' => 'nullable|string',
            'difficulte_exercice' => 'nullable|string|max:255',
        ])->validate();

        // Utiliser partie_id au lieu de id pour correspondre au formulaire
        $partieCour = PartieCour::find($request->partie_id);
        
        if(!$partieCour) {
            return redirect()->back()->with('error', 'Partie de cours non trouvée!');
        }
        
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
       
        $partieCour->save();

        return redirect()->back()->with('success', 'Chapitre modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $partieCour = PartieCour::find($id);
        if ($partieCour) {
            $partieCour->delete();
            return redirect()->back()->with('success', 'Chapitre supprimé avec succès!');
        } else {
            return redirect()->back()->with('error', 'Chapitre non trouvé!');
        }
    }

   

    public function showExercice($id)
    {
        $partieCour = PartieCour::find($id);
        return view('user.ContenusCour.exercicesPartie', compact('partieCour'));
    }
}
