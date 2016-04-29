<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use CmcEssentials\TeachingUnit;

class RouteTest extends TestCase
{

        public function testRootRoute()
        {
                $this->visit('/')
                     ->see('Welcome to CMC-essentials');
        }

        public function testSyllabusRoute()
        {
                $this->visit('/syllabus')
                     ->see('Syllabus');
        }

        public function testSessionLoginRoute()
        {
                $this->visit('/session-login')
                     ->see('Session Login');
        }

        public function testTeachingUnitsRoute()
        {
                $teachingUnit = factory(TeachingUnit::class)->create();
                $this->withoutMiddleware();
                $this->route('GET', 'teaching-units::show',['slug'=>$teachingUnit->slug]);
                $this->see($teachingUnit->title);

        }

        public function testTeachingUnitRoute()
        {
                $teachingUnit = factory(TeachingUnit::class)->create();
                $this->withoutMiddleware();
                $this->route('GET', 'teaching-units::show',['slug'=>$teachingUnit->slug]);
                $this->see('Back to teaching units');
        }

        public function testQuestionsRoute()
        {
                $this->withoutMiddleware()
                     ->visit('/teaching-units/cmctheories/quizzes/quiz2/questions')
                     ->see('Theories of CMC quiz');
        }

        public function testQuizResultsRoute()
        {
                $this->withoutMiddleware()
                     ->visit('/teaching-units/cmc/quizzes/quiz2/results')
                     ->see('Quiz results');
        }

}
