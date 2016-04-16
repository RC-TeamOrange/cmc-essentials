<?php

namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['level','slug','title', 'teaching_unit_id'];
    
    public function teachingUnit() {
        return $this->belongsTo('CmcEssentials\TeachingUnit');
    }
}
