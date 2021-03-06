<?php
/**
* Study Material class file. Contains the StudyMaterial class which is an Eloquent model for the study_materials relation.
*/

namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

/**
* This is an Elloquent model class for the study_materials database relation.
* The StudyMaterial class provides the following mass fillable properties of the model.
* level             : The level/order of the study material, used when there are multiple study materials in a single teaching unit.
* order             : The postion/order where the material is placed amongst others, betermines, when this study material is shown to the user. 
* title             : Title of the study material. 
* description       : Main content of the study material
* teaching_unit_id  : The id of the teaching unit to which this study material is belongs. 
*/
class StudyMaterial extends Model
{
    /** Mass fillable peroperties of the StudyMaterial Model. 
    * @var array
    */
    protected $fillable = ['level','order','title', 'description', 'teaching_unit_id'];
    
    /** 
    * Defines the relattionship between study materials and teachinh units. Its defines a Many-to-One relationship. That is 
    * A study material belongs to only one teaching unit, while a teaching unit can have one or more study materials.
    */
    public function teachingUnit() {
        return $this->belongsTo('CmcEssentials\TeachingUnit');
    }
}
