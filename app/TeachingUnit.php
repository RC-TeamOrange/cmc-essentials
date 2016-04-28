<?php

namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

class TeachingUnit extends Model
{
    protected $fillable = ['slug','level','title', 'description', 'duration'];
    
    public function teachingUnit() {
        return $this->hasMany('CmcEssentials\StudyMaterial', 'CmcEssentials\Source');
    }
    
    public function quizzes(){
        return $this->hasMany('CmcEssentials\Quiz');
    }
}
