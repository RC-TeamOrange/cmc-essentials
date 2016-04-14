<?php

namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    protected $fillable = ['level','order','content'];
    
    public function teachingUnit() {
        return $this->belongsTo('CmcEssentials\TeachingUnit');
    }
}
