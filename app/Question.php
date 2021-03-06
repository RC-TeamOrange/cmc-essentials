<?php
/**
* Question class file. Contains the Question class which is an Eloquent model for the questions relation.
*/
namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

/**
* This is an Elloquent model class for the questions database relation.
* The Question class provides the following fillable properties of the model.
* content       : The content of the Question
* quiz_id       : The corresponding id of the quiz to which this question belongs. 
*/
class Question extends Model
{
    /** Array of database fileds that are mass fillable for the the questions relation.  
    * @var array
    */
    protected $fillable = ['content', 'quiz_id'];
    
    /**
    * The quiz method, sets the relationship between questions and quizzes. It sets a Many-to-One relationship, that is
    * A question belongs to a quiz.
    *
    * @return object relationship
    */
    public function quiz() {
        return $this->belongsTo('CmcEssentials\Quiz');
    }
    
    /**
    * The answers method, sets the relationship between questions and answers. It sets a Many-to-One relationship, that is
    * A question can have one or many answers.
    *
    * @return object relationship
    */
    public function answers(){
        return $this->hasMany('CmcEssentials\Answer');
    }
}
