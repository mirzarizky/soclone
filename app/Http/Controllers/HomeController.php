<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use App\Answer;

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
        $answers = Answer::all();
        // view
        $data = [
            'title' => "Welcome To Larahub",
            'questions' => $questions,
            'answers' => $answers
        ];
        return view('home', $data);
    }
}
