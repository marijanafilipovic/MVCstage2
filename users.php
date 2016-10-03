<?php
class Users extends Controller{

protected function register(){
   
    $viewmodel = new UserModel();
    $this->returnView($viewmodel->register(), true);
    
    }
    
protected function login(){
    $viewmodel = new UserModel();
    $this->returnView($viewmodel->login(), true);
    
    }
    
 protected function logout(){
    unset($_SESSION['is_log_in']);
    unset($_SESSION['user_data']);
    session_destroy();
    header('Location:'.ROOT_URL);
 }

 
 public function rollAccount(){
  if(isset($_POST['submit'])){
    if(empty($_POST['value'])){
       Messages::setMSg("Unesite vrednost za pretragu.");	
    }else{
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->SearchResult( $model="users", $key="uname",$post['value']), true);
        if(empty($viewmodel)){
            echo "Nema korisnika sa korisnickim imenom: ". $post['value'];
        }
    }}
    if(!isset($_POST['submit'])){
    $viewmodel = new UserModel();
    $this->returnView($viewmodel->rollAccount(), true);
}
  
}

 public function userAccount($uid=""){

    $viewmodel = new UserModel();
    $this->returnView($viewmodel->userAccount($_GET['id']), true);
    
    if(isset($_POST['submit'])){
         $viewmodel = new UserModel();
            $this->returnView($viewmodel->imgUpdate($_GET['id']), false);
  
    }
}
public function userActivity(){
    $viewmodel = new UserModel();
    $this->returnView($viewmodel->getWhere($model='users', $key='uid',$_GET['id']), true);
}

 public function userRequest(){
       $viewmodel = new UserModel();
        $this->returnView($viewmodel->userRequest(), true);
        
    }
    
public function request(){

    $viewmodel = new UserModel();
    $this->returnView($viewmodel->getAll($model='userrequest'), true);
    if(isset($_POST['submit'])){
    $viewmodel = new UserModel();
    $this->returnView($viewmodel->setRespond(), true);
    
    }
    
}

}

?>