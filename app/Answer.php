<?php

namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['content','rank', 'correct', 'question_id'];
    
    public function question() {
        return $this->belongsTo('CmcEssentials\Question');
    }
    
}