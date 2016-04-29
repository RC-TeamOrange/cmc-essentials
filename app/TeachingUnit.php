<?php
/**
* Teaching Unit class file. Contains the TeachingUnit class which is an Eloquent model for the teaching_unit relation.
*/
namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

/**
* This is an Elloquent model class for the teaching_unit database relation.
* The TeachingUnit class provides the following fillable properties of the model.
* slug              : A unique string which is used in the url for the teaching unit page and subpages of the teaching unit.
* level             : The level of the teaching unit, used for ordering the teaching units. Setting the order hoe the user progresses through the teaching units. 
* title             : Title of the teaching unit. 
* description       : A summary of the teaching unit.
* duration          : Duration in minutes of the teaching unit. 
*/
class TeachingUnit extends Model
{
    /** Defines mass fillable fields of the teaching unit model. 
    * @var array
    */
    protected $fillable = ['slug','level','title', 'description', 'duration'];
    
    /**
    * The teachingUnit method, defines the relationship between teaching units and study materials, teachng units and sources. 
    * It sets a Many-to-One relationship, that is a teaching unit can have one or many study materials, It can also have one or many sources.
    *
    * @return object relationship
    */
    public function teachingUnit() {
        return $this->hasMany('CmcEssentials\StudyMaterial', 'CmcEssentials\Source');
    }
    
    /**
    * The quizzes method, defines the relationship between teaching units and quizzes. 
    * It sets a Many-to-One relationship, that is a teaching unit can have one or many quizzes.
    *
    * @return object relationship
    */
    public function quizzes(){
        return $this->hasMany('CmcEssentials\Quiz');
    }
}
