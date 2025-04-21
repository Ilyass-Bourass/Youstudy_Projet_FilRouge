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
        dd($request->all());
        // $quizId = $request->input('quiz_id');
        // $questions = QuestionsQuiz::where('quiz_id', $quizId)->get();
        // $score = 0;

        // foreach ($questions as $question) {
        //     $userAnswer = $request->input('question_' . $question->id);
        //     if ($userAnswer == $question->correct_answer) {
        //         $score++;
        //     }
        // }

        // return redirect()->back()->with('success', 'Your score is: ' . $score);
    }
}
