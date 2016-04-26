<?php 
namespace CmcEssentials\Http\Views\Composers;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MasterComposer {
    protected $request;
    
    public function __construct(Request $request) {
        $this->request = $request;
    }
    
    public function compose(View $view) {
        $view->with('username', $this->getSessionUsername());
    }
    
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