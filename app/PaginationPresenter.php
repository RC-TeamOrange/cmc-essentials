<?php 
namespace CmcEssentials;

use Illuminate\Support\HtmlString;
use Illuminate\Pagination\BootstrapThreePresenter;

class PaginationPresenter extends BootstrapThreePresenter {

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