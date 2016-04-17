<?php 
namespace CmcEssentials;

use Illuminate\Support\HtmlString;
use Illuminate\Pagination\BootstrapThreePresenter;

class PaginationPresenter extends BootstrapThreePresenter {

    public function render()
    {
        if ($this->hasPages()) {
            
            return new HtmlString(sprintf(
                '<ul class="pagination">%s %s</ul>',
                $this->getPreviousButton(),
                $this->getNextButton()
            ));
        }

        return '';
    }

}