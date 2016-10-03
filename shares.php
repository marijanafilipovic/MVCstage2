<?php
class Shares extends Controller{
    
protected function Index()
{
$viewmodel = new ShareModel();
$this->returnView($viewmodel->Index(), true);
$viewmodel = new ShareModel();
$this->returnView($viewmodel->getAll($model='info'), false);

    }
  
protected function add()
{
    if(!isset($_SESSION['user_data'])){
        header('Location: '.ROOT_URL.'shares');
    }
    if(isset($_POST['share'])){
$viewmodel = new ShareModel();

$this->returnView($viewmodel->add($_GET['sid'],$_GET['vid'],$_GET['type']), true);
}
   if(!isset($_POST['share'])){
$viewmodel = new ShareModel();

$this->returnView($viewmodel->getSportovi(), true);
   }

    }
    
protected function addCategory(){
  
    if(!isset($_POST['addSport'])){
$viewmodel = new ShareModel();

$this->returnView($viewmodel->getSportovi(), true);
   }
   if(isset($_POST['addSport'])){
$viewmodel = new ShareModel();

$this->returnView($viewmodel->addSport(), true);
    
   }
   
      if(isset($_POST['addVrsta'])){
$viewmodel = new ShareModel();

$this->returnView($viewmodel->addVrsta($_GET['sid']), true);
    
   }
}
    
    protected function selectPost(){
       
        $viewmodel = new ShareModel();
        $this->returnView($viewmodel->selectPost($_GET['id']), true);
       
       
    }
    protected function selectCategory(){
           if(isset($_POST['submit'])){
    if(empty($_POST['value'])){
       Messages::setMsg('Unesite vrednost za pretragu.', 'errorMsg');	
    }else{
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->SearchResult( $model="vesti", $key="title",$post['value']), true);
        if(empty($viewmodel)){
             Messages::setMsg('Nema podataka za uneti pojam.', 'errorMsg');
          
        }
    }}
    
         if(!isset($_POST['submit'])){
        $viewmodel = new ShareModel();
        $this->returnView($viewmodel->selectCategory($_GET['id']), true);
       
    }
    }
       protected function render(){
    
        $viewmodel = new ShareModel();
        $this->returnView($viewmodel->render($_GET['id']), true);
   
if(isset($_POST['submit'])){
       $viewmodel = new ShareModel();
        $this->returnView($viewmodel->insertComentar($_GET['id']), false);
    }    
    }

    
    
}

?>