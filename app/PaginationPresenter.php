<?php 
/**
* Pagination presenter class used for pagination presentation.
*/

namespace CmcEssentials;

use Illuminate\Support\HtmlString;
use Illuminate\Pagination\BootstrapThreePresenter;

/**
* This class controlls the presentation of pagination.
* It is used in for displaying the navigation bottons between study content in teaching units, and 
* navigation between questions in a quiz. 
* It extends the default laravel BootstrapThreePresenter
*/
class PaginationPresenter extends BootstrapThreePresenter {

/**
* The render method, which generates the HTML markup for navitation links/buttons for a Teaching unit or quiz.
*
* @param object $teachingUnit Teaching unit object.
* @param object $quiz Quiz object
*
* @return string HTML markup for navigation links, previous, next and "Take Quiz" or "Show Quiz Results" buttons were accordingly.
*/
    public function render($teachingUnit = null, $quiz = null)
    {
        if ($this->hasPages()) {
            $next = $this->getNextButton();
            if(strpos($next, 'disabled') !== false){
                if(!empty($quiz)){
                    $next = '<a href="'.route('teaching-units::quizzes::results', ['slug'=>$teachingUnit->slug, 'quizSlug' => $quiz->slug]).'" rel="next">Finish/Results</a>';
                }elseif(!empty($teachingUnit)){
                    $next = '<a href="'.route('teaching-units::quizzes::showall', ['slug'=>$teachingUnit->slug]).'" rel="next">Take Quiz</a>';
                }
            }
            return new HtmlString(sprintf(
                '<ul class="pagination">%s %s</ul>',
                $this->getPreviousButton(),
                $next
            ));
        }

        return '';
    }

}