<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActionTest extends TestCase
{

        public function testWelcomePageNextButtonAction()
        {
                $this->visit('/')
                     ->click('Next')
                     ->seePageIs('/syllabus');
        }

        public function testSyllabusPageStartButtonAction()
        {
                $this->visit('/syllabus')
                     ->click('Start')
                     ->seePageIs('/session-login');
        }

        public function testSessionLoginPageStartSessionActionWithoutEnteringUsername()
        {
                $this->visit('/session-login')
                     ->press('Start session')
                     ->seePageIs('/session-login');
        }

        public function testSessionLoginPageStartSessionActionWithUsernameEntered()
        {
                $this->visit('/session-login')
                     ->type('Username', 'username')
                     ->press('Start session')
                     ->seePageIs('/teaching-units');
        }

        public function testTeachingUnitNameClickAction()
        {
                $this->withoutMiddleware()
                     ->visit('/teaching-units')
                     ->click('Theories of CMC')
                     ->seePageIs('/teaching-units/cmctheories');
        }

        public function testTeachingUnitStartButtonAction()
        {
                $this->withoutMiddleware()
                     ->visit('/teaching-units/cmctheories')
                     ->click('Start')
                     ->seePageIs('/teaching-units/cmctheories/study');
        }

        public function testQuizResultsPageNextTeachingUnitButtonAction()
        {
                $this->withoutMiddleware()
                     ->visit('/teaching-units/cmctheories/quizzes/quiz2/results')
                     ->click('Next teaching unit')
                     ->seePageIs('/teaching-units/personalconnections');
        }

        public function testQuizResultsPageTeachingUnitsButtonAction()
        {
                $this->withoutMiddleware()
                     ->visit('/teaching-units/cmctheories/quizzes/quiz2/results')
                     ->click('Teaching units')
                     ->seePageIs('/teaching-units');
        }

        public function testQuizResultsPageExitButtonAction()
        {
                $this->withoutMiddleware()
                     ->visit('teaching-units/cmctheories/quizzes/quiz2/results')
                     ->click('Exit')
                     ->seePageIs('/');
        }
}
