<?php

namespace App\Http\Controllers;

use App\Models\PartieCour;
use App\Models\Quiz;
use App\Models\QuestionsQuiz;
use Illuminate\Http\Request;
;
class QuizController extends Controller
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
        
      //  dd($correctAnswers);
       // dd($userAnswers);
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
}
