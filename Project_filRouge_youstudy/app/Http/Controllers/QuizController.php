<?php

namespace App\Http\Controllers;

use App\Models\PartieCour;
use App\Models\Quiz;
use App\Models\QuestionsQuiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer tous les Quiz avec les questions avec leurs parties associés
        $quizzes = Quiz::with(['partieCour:id,titre,cour_id', 'partieCour.cour:id,niveau,matiere_cour' , 'questions'])
            ->select('id', 'partie_cour_id')
            ->get();
        // dd($quizzes);

        return view('admin.quiz.index',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        $quiz = Quiz::where('partie_cour_id', $id)->first();
        
        if (!$quiz) {
            return redirect()->back()->with('error', 'Quiz not found');
        }
        
        $questionsQuiz = QuestionsQuiz::where('quiz_id', $id)->get();
        $partieCour = PartieCour::find($id);
        
        if ($questionsQuiz->isEmpty()) {
            return redirect()->back()->with('error', 'No questions found for this quiz');
        }

        foreach ($questionsQuiz as $question) {
            $question->propositions = json_decode($question->propositions, true);
        }

        return view('user.ContenusCour.quizPartie', compact('partieCour', 'questionsQuiz'));   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        //
    }

    public function traitementQuiz(Request $request)
    {
        $score = 0;

        $correctAnswers = $request->input('correct_answers'); // tableau des bonnes réponses
        $userAnswers = $request->input('question'); // tableau des réponses de l'utilisateur
        
        // On boucle sur les réponses
        foreach ($correctAnswers as $questionId => $correctAnswer) {
            // Vérifie si la question existe aussi dans les réponses de l'utilisateur
            if (isset($userAnswers[$questionId])) {
                if ($userAnswers[$questionId] == $correctAnswer) {
                    $score++;
                }
            }
        }
        return redirect()->back()->with('success', 'Your score is: ' . $score);
    }

    /**
     * Fetch questions for a quiz via AJAX.
     */
   

    /**
     * Update quiz questions
     */
    public function updateQuizQuestions(Request $request, $id)
    {
        try {
            $quiz = Quiz::findOrFail($id);
            
            // Récupérer les données du formulaire
            $questionIds = $request->input('question_id', []);
            $questionTexts = $request->input('question_text', []);
            
            // Parcourir chaque question
            foreach ($questionIds as $index => $questionId) {
                $questionText = $questionTexts[$index];
                
                // Pour les nouvelles questions
                if ($questionId === 'new') {
                    $propositionName = 'proposition_new_' . $index;
                    $correctAnswerName = 'correct_answer_new_' . $index;
                    
                    // Créer une nouvelle question
                    $propositions = $request->input($propositionName, []);
                    $correctAnswer = $request->input($correctAnswerName, 0);
                    
                    // Vérifier que la question a au moins une proposition
                    if (count($propositions) > 0) {
                        QuestionsQuiz::create([
                            'quiz_id' => $id,
                            'question' => $questionText,
                            'propositions' => json_encode($propositions),
                            'reponse_correcte' => $correctAnswer,
                        ]);
                    }
                } 
                // Pour les questions existantes
                else {
                    $question = QuestionsQuiz::find($questionId);
                    if ($question) {
                        $propositionName = 'proposition_' . $questionId;
                        $correctAnswerName = 'correct_answer_' . $questionId;
                        
                        $propositions = $request->input($propositionName, []);
                        $correctAnswer = $request->input($correctAnswerName, 0);
                        
                        // Mettre à jour la question
                        $question->question = $questionText;
                        $question->propositions = json_encode($propositions);
                        $question->reponse_correcte = $correctAnswer;
                        $question->save();
                    }
                }
            }
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
