<?php
class Home extends Controller{
    protected function Index(){
    if(isset($_POST['submit'])){
    if(empty($_POST['value'])){
       Messages::setMsg('Unesite vrednost za pretragu.', 'errorMsg');	
    }else{
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->SearchResult( $model="sportovi", $key="sport",$post['value']), true);
        if(empty($viewmodel)){
             Messages::setMsg('Nema podataka za uneti pojam.', 'errorMsg');
          
        }
    }}
        
    if(!isset($_POST['submit'])){    
        
      $viewmodel = new HomeModel();
      $this->returnView($viewmodel->Index(), true);
    }
    }
   
}

?>