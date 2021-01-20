<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\QuizQuestion;
use App\QuizAnswer;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'title' => 'required|max:25',
            'slug' => 'required|unique:quizzes|max:25',
        ]);
        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->slug = $request->slug;
        $quiz->active = true;
        $quiz->save();

        return redirect()->route('quizzes.index')->with('message', 'Quiz successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $quiz = Quiz::findOrFail($id);
        return view('quizzes.edit', compact('quiz'));
    }

    public function manageQuestions(Quiz $quiz, Request $request){
        return view('questions.manage', compact('quiz'));
    }

    public function addQuestion(Quiz $quiz, Request $request){

        $request->validate([
            'prompt' => 'required|max:100',
        ]);

        $question = new QuizQuestion();
        $question->quiz_id = $quiz->id;
        $question->prompt = $request->prompt;
        $question->allowCustomAnswer = false;
        $question->save();
        return redirect()->back()->with('message', 'Question successfully added!');
    }

    public function editQuestion($id)
    {
        //
        $question = QuizQuestion::findOrFail($id);
        return view('questions.edit', compact('question'));
    }

    public function updateQuestion($id, Request $request)
    {
        //
        $question = QuizQuestion::findOrFail($id);

        if($request->allowCustomAnswer){
            $question->update(
                [
                    'prompt' => $request->prompt,
                    'allowCustomAnswer' => true
                ]
            );
        }else{
            $question->update(
                [
                    'prompt' => $request->prompt,
                    'allowCustomAnswer' => false
                ]
            );
        }
        return redirect()->route('quizzes.questions.manage', ['quiz' => $question->quiz_id])->with('message', 'Question updated!');
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteQuestion($id){
        $question = QuizQuestion::findOrFail($id);
        $question->delete();
        return redirect()->back()->with('message', 'Question deleted!');
    }

    public function manageAnswers(QuizQuestion $question, Request $request){
        return view('answers.manage', compact('question'));
    }

    public function addAnswer(QuizQuestion $question, Request $request){

        $request->validate([
            'content' => 'required|max:250',
        ]);

        $answer = new QuizAnswer();
        $answer->quiz_question_id = $question->id;
        $answer->content = $request->content;
        $answer->save();
        return redirect()->back()->with('message', 'Answer successfully added!');
    }

    public function deleteAnswer($id){
        $answer = QuizAnswer::findOrFail($id);
        $answer->delete();
        return redirect()->back()->with('message', 'Answer deleted!');
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
        //
        $quiz = Quiz::findOrFail($id);
        if($request->active){
            $quiz->update([
                'active' => true,
                'title' => $request->title,
                'slug' => $request->slug
            ]);
        }else{
            $quiz->update([
                'active' => false,
                'title' => $request->title,
                'slug' => $request->slug
            ]);
        }
        return redirect()->route('quizzes.index')->with('message', 'Quiz successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->back()->with('message', 'Quiz deleted!');
    }
}
