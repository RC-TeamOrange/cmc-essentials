<?php
/**
* Answer class file. Contains the Answer class which is an Eloquent model for the answers relation.
*/

namespace CmcEssentials;

use Illuminate\Database\Eloquent\Model;

/**
* This is an Elloquent model class for the answers database relation.
* The Answer class provides the following fillable properties of the model.
* content       : The content of the Answer
* rank          : The position of the answer in the list of answer choices.
* correct       : An integer value to indicate if the answer is correct. 0 if its wrong and 1 if its correct. 
* question_id   : The id of the question to which this answer is associated. 
*/
class Answer extends Model
{
    /**  Array of mass fillable fields of this relation. 
    * @var array
    */
    protected $fillable = ['content','rank', 'correct', 'question_id'];
    
    /**
    * The question method, sets the relationship between answers and questions. It sets a Many-to-One relationship, that is
    * An answer belongs to a question, the question can have one or many answers (answer choices).
    *
    * @return object relationship
    */
    public function question() {
        return $this->belongsTo('CmcEssentials\Question');
    }
    
}
