<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use App\QuestionComment;
use App\Answer;
use App\AnswerComment;
use App\user;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // take data
        $questions = Question::all();
        $questComents = QuestionComment::all();
        $answers = Answer::all();
        $answerComents = AnswerComment::all();
        $users = User::all();
        
        // view
        $data = [
            'title' => "Welcome To Larahub",
            'questions' => $questions,
            'questComents' => $questComents,
            'answers' => $answers,
            'answerComents' => $answerComents,
            'users' => $users
        ];
        return view('home', $data);
    }
}
