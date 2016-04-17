<?php

namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = ['title','content','url'];
    
    public function teachingUnit() {
        return $this->belongsTo('CmcEssentials\TeachingUnit');
    }
}