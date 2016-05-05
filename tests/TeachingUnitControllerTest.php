<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use CmcEssentials\Http\Requests;
use CmcEssentials\TeachingUnit;
use CmcEssentials\StudyMaterial;
use CmcEssentials\Quiz;
use CmcEssentials\Question;
use CmcEssentials\Answer;

use CmcEssentials\Http\Controllers\QuizQuestionController;
use CmcEssentials\Http\Controllers\TeachingUnitController;
use CmcEssentials\Http\Controllers\StudyMaterialController;

class TeachingUnitControllerTest extends TestCase
{
    
    use WithoutMiddleware;
    use DatabaseTransactions;
    
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public $quiz;
    public $teachingUnit;
    public function testNumberOfQuestions(){
        $teachingUnit = factory(TeachingUnit::class)->create();
        $this->quiz = factory(Quiz::class)->create(['teaching_unit_id' => $teachingUnit->id ]);
        $questions = factory(Question::class, 3)
           ->create()
           ->each(function($q) {
                $q->quiz_id = $this->quiz->id;
            });
        $this->assertEquals($this->quiz->teaching_unit_id, $teachingUnit->id);
        $this->route('GET', 'teaching-units::show', ['slug' => $teachingUnit->slug]);
        $this->assertEquals('teaching-unit-test-slug', $teachingUnit->slug);
        $this->assertViewHas('numberOfQuestions', 0);
    }
    
    function testGetTeachingUnit(){
        $teachingUnit = factory(TeachingUnit::class)->create();
        
        $teachingUnitController = new TeachingUnitController();
        $testTeachingUnit = $teachingUnitController->getTeachingUnit($teachingUnit->slug, 'slug');
        $this->assertInstanceOf('CmcEssentials\TeachingUnit', $testTeachingUnit);
    }
    
    /**
    * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException 
    */
    function testGetTeachingUnitNotFoundException(){
        $teachingUnitController = new TeachingUnitController();
        $teachingUnitController->getTeachingUnit('test-unavailable-teaching-unit-slug', 'slug');
    }
    
    function testGetStudyMaterial(){
        $studyMaterial = factory(StudyMaterial::class)->create();
        
        $studyMaterialController = new StudyMaterialController();
        $testStudyMaterial = $studyMaterialController->getStudyMaterial($studyMaterial->id);
        $this->assertInstanceOf('CmcEssentials\StudyMaterial', $testStudyMaterial);
    }
    
    /**
    * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException 
    */
    function testGetStudyMaterialNotFoundException(){
        $studyMaterialController = new StudyMaterialController();
        $studyMaterialController->getStudyMaterial(654);
    }
    
    function testGetQuiz(){
        $quiz = factory(Quiz::class)->create();
        
        $quizQuestionController = new QuizQuestionController();
        $testQuiz = $quizQuestionController->getQuiz($quiz->slug, 'slug');
        $this->assertInstanceOf('CmcEssentials\Quiz', $testQuiz);
    }
    
    /**
    * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException 
    */
    function testGetQuizNotFoundException(){
        $quizQuestionController = new QuizQuestionController();
        $quizQuestionController->getQuiz('test-unvailable-slug', 'slug');
    }
    
    function testGetQuestion(){
        $question = factory(Question::class)->create();
        
        $quizQuestionController = new QuizQuestionController();
        $testQuestion = $quizQuestionController->getQuestion($question->id);
        $this->assertInstanceOf('CmcEssentials\Question', $testQuestion);
    }
    
    /**
    * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException 
    */
    function testGetQuestionNotFoundException(){
        $quizQuestionController = new QuizQuestionController();
        $quizQuestionController->getQuestion(345);
    }
    
    function testGetAnswer(){
        $answer = factory(Answer::class)->create();
        
        $quizQuestionController = new QuizQuestionController();
        $testAnswer = $quizQuestionController->getAnswer($answer->id);
        $this->assertInstanceOf('CmcEssentials\Answer', $testAnswer);
    }
    
    /**
    * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException 
    */
    function testGetAnswerNotFoundException(){
        $quizQuestionController = new QuizQuestionController();
        $quizQuestionController->getAnswer(654);
    }
    
}
