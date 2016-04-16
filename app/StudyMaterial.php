<?php

namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    protected $fillable = ['level','order','title', 'description', 'teaching_unit_id'];
    
    public function teachingUnit() {
        return $this->belongsTo('CmcEssentials\TeachingUnit');
    }
}
