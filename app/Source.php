<?php
/**
* Place holder class for sources model. NOT USED IN THIS VERSION OF THE WEB APP.
*/
namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

/**
* Place holder class for sources model. NOT USED IN THIS VERSION OF THE WEB APP.
*/
class Source extends Model
{
    /** Mass fillable properties of the sources model. */
    protected $fillable = ['title','content','url'];
    
    /** Sets the ( Many-to-One ) relationshp between sources and teaching units. 
    * @return object relationship
    */
    public function teachingUnit() {
        return $this->belongsTo('CmcEssentials\TeachingUnit');
    }
}
