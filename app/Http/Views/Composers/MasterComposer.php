<?php 
/**
* This file contains the MasterComposer class, which serves variables shared with all views. 
*/
namespace CmcEssentials\Http\Views\Composers;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
* MasterComposer class, which serves variables shared with all views.
*/
class MasterComposer {
    protected $request;
    
    /**
    * Constructor of the MasterComposer class. 
    *
    * @param Illuminate\Http\Request $request. An Illuminate request object (the current request.).
    */
    public function __construct(Request $request) {
        $this->request = $request;
    }
    
    /** 
    * Composes the view and passes variables ( the username for the current session. ) to the view. 
    * 
    * @param Illuminate\Contracts\View\View $view 
    */
    public function compose(View $view) {
        $view->with('username', $this->getSessionUsername());
    }
    
    /**
     * Gets the username set for this session. 
     * Returns the username if username is set or the string "Annonymous" otherwise. 
     * 
     * @return string the username for the current session.
     */
    private function getSessionUsername(){
        $sessionData = json_decode($this->request->cookie('CmcESession'), true);
        $username = 'Annonymous';
        if(!empty($sessionData) && !empty($sessionData['username'])){
            $username = $sessionData['username'];
        }elseif( !empty($this->request->get('username'))){
            $username = $this->request->get('username');
        }
        return $username;
    }
}