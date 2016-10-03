<?php
abstract class Controller{
	protected $request;
	protected $action;
        //protected $id;

	public function __construct($action, $request){
		$this->action = $action;
		$this->request = $request;
              //  $this->id = isset($_GET['id']);
              //  $this->vid= isset($_GET['vid']);
	}

	public function executeAction(){
		return $this->{$this->action}();
	}

	protected function returnView($viewmodel, $fullview){
		$view = 'views/'. get_class($this). '/' . $this->action. '.php';
		if($fullview){
			require('views/main.php');
                        
		} else {
			require($view);
		}
	}
}