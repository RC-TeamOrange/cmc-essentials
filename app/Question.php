<?php

namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['content', 'quiz_id'];
    
    public function quiz() {
        return $this->belongsTo('CmcEssentials\Quiz');
    }
}
