<?php

namespace App\Http\Controllers;

use App\Models\QuestionsQuiz;
use Illuminate\Http\Request;

class QuestionsQuizController extends Controller
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
    public function showQuestionsfetch($id)
    {
        // Récupérer le titre de la partie de quiz et  les questions du quiz
        $questions = QuestionsQuiz::where('quiz_id', $id)
            ->with(['quiz:id,partie_cour_id', 'quiz.partieCour:id,titre,cour_id'])
            ->select('id', 'quiz_id', 'question','propositions', 'correct_answer', 'created_at')
            ->get();

        foreach ($questions as $question) {
            $question->propositions = json_decode($question->propositions);
        }

        // Vérifier si des questions existent
        if ($questions->isEmpty()) {
            return response()->json(['message' => 'Aucune question trouvée pour ce quiz.'], 404);
        }

        return response()->json($questions);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuestionsQuiz $questionsQuiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $quizId = $request->input('quiz_id');
            
            // Récupérer les données du formulaire
            $questionIds = $request->input('question_id', []);
            $questionTexts = $request->input('question_text', []);
            
            // Récupérer toutes les questions existantes pour ce quiz
            $existingQuestions = QuestionsQuiz::where('quiz_id', $quizId)->get();
            $updatedQuestionIds = [];
            
            // Parcourir chaque question du formulaire
            foreach ($questionIds as $index => $questionId) {
                $questionText = $questionTexts[$index];
                
                // Pour les nouvelles questions
                if ($questionId === 'new') {
                    $propositionName = 'proposition_new_' . $index;
                    $correctAnswerName = 'correct_answer_new_' . $index;
                    
                    // Créer une nouvelle question
                    $propositions = $request->input($propositionName, []);
                    $correctAnswer = $request->input($correctAnswerName);
                    
                    // Vérifier que la question a au moins une proposition
                    if (count($propositions) === 3 && !empty($questionText)) {
                        $newQuestion = new QuestionsQuiz();
                        $newQuestion->quiz_id = $quizId;
                        $newQuestion->question = $questionText;
                        $newQuestion->propositions = json_encode($propositions);
                        $newQuestion->correct_answer = intval($correctAnswer); 
                        $newQuestion->save();
                        
                        $updatedQuestionIds[] = $newQuestion->id;
                    }
                } 
                // Pour les questions existantes
                else {
                    $question = QuestionsQuiz::find($questionId);
                    if ($question) {
                        $propositionName = 'proposition_' . $questionId;
                        $correctAnswerName = 'correct_answer_' . $questionId;
                        
                        $propositions = $request->input($propositionName, []);
                        $correctAnswer = $request->input($correctAnswerName);
                        
                        // Mettre à jour la question
                        $question->question = $questionText;
                        $question->propositions = json_encode($propositions);
                        $question->correct_answer = intval($correctAnswer); // S'assurer que c'est 1, 2 ou 3
                        $question->save();
                        
                        $updatedQuestionIds[] = $questionId;
                    }
                }
            }
            
            // Supprimer les questions qui n'ont pas été mises à jour
            foreach ($existingQuestions as $existingQuestion) {
                if (!in_array($existingQuestion->id, $updatedQuestionIds)) {
                    $existingQuestion->delete();
                }
            }
            
            return redirect()->back()->with('success', 'Quiz mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionsQuiz $questionsQuiz)
    {
        //
    }
}
