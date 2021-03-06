<?php
/**
* Quiz class file. Contains the Quiz class which is an Eloquent model for the quizzes relation.
*/
namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

/**
* This is an Elloquent model class for the quizzes database relation.
* The Quiz class provides the following fillable properties of the model.
* level             : The level/order of the quiz, used when there are multiple quizzes in a single teaching unit.
* slug              : A unique string which is used in the url for the quiz page.
* title             : Title of the quiz. 
* teaching_unit_id  : The id of the teaching unit to which this quiz is associated. 
*/
class Quiz extends Model
{
    /** Array of database fileds that are mass fillable for the quiz relation.  
    * @var array
    */
    protected $fillable = ['level','slug','title', 'teaching_unit_id'];
    
    /**
    * The teachingUnit method, sets the relationship between quizzes and teaching units. It sets a Many-to-One relationship, that is
    * A quiz belongsto only one teaching unit.
    *
    * @return object relationship
    */
    public function teachingUnit() {
        return $this->belongsTo('CmcEssentials\TeachingUnit');
    }
    
    /**
    * The questions method, sets the relationship between quizzes and questions. It sets a Many-to-One relationship, that is
    * A quiz can have one or many questions.
    *
    * @return object relationship
    */
    public function questions(){
        return $this->hasMany('CmcEssentials\Question');
    }
}
