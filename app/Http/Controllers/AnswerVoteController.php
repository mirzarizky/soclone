<?php

namespace App\Http\Controllers;

use App\AnswerVote;
use Illuminate\Http\Request;

class AnswerVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AnswerVote  $answerVote
     * @return \Illuminate\Http\Response
     */
    public function show(AnswerVote $answerVote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AnswerVote  $answerVote
     * @return \Illuminate\Http\Response
     */
    public function edit(AnswerVote $answerVote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnswerVote  $answerVote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnswerVote $answerVote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnswerVote  $answerVote
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnswerVote $answerVote)
    {
        //
    }
    
//     Usernya ( count_reputation) - PertanyaanVote ( up, down, pertanyaan_id, user_id)
// tinggal count up*10 - down*1 = count_reputation

}
