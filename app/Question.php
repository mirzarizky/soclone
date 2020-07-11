<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'title', 'content', 'user_id'
    ];

    public function delete()
    {
        $this->answers()->delete();

        return parent::delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'question_tag', 'question_id', 'tag_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
