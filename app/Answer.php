<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = [
        'question_id', 'user_id', 'content'
    ];

    public function delete()
    {
        $this->comments()->delete();
        $this->votes()->delete();

        return parent::delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function comments()
    {
        return $this->hasMany(AnswerComment::class);
    }

    public function votes()
    {
        return $this->hasMany(AnswerVote::class);
    }
}
