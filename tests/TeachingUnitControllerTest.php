<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use CmcEssentials\Http\Requests;
use CmcEssentials\TeachingUnit;
use CmcEssentials\Quiz;
use CmcEssentials\Question;

class TeachingUnitControllerTest extends TestCase
{
    
    use WithoutMiddleware;
    use DatabaseTransactions;
    
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNumberOfQuestions(){
        $teachingUnit = factory(TeachingUnit::class)->create();
        $this->route('GET', 'teaching-units::show',['slug'=>$teachingUnit->slug]);
        $this->assertEquals('teaching-unit-test-slug', $teachingUnit->slug);
        $this->assertViewHas('numberOfQuestions', 0);
    }
}
