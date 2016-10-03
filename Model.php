<?php
abstract class Model{
    protected $dbh;
    protected $stmt;
    
   public function __construct(){
       $this->dbh=Connect::getInstance();
        //$this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER,DB_PASS);
    }
public function query($query){
    $this->stmt = $this->dbh->prepare($query);
}

public function execute(){
 $this->stmt->execute();
}
public function bind($param, $value, $type = null){
    if(is_null($type)){
        switch(true){
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
                
            case is_bool($value):
            $type = PDO::PARAM_BOOL;
            break;
        
            case is_null($value):
            $type = PDO::PARAM_NULL;
            break;
        
            default:
                $type = PDO::PARAM_STR;
            }
    }
    $this->stmt->bindValue($param, $value, $type);
}
public function resultSet(){
    $this->execute(); 
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function single(){
    $this->execute();         
    return  $this->stmt->fetch(PDO::FETCH_ASSOC);    
}
public function lastInsertId(){
    return $this->dbh->lastInsertId();
}
 
public function checkName($username){
    $this->query("SELECT COUNT (*) as count FROM users WHERE uname = ':uname'");
 $this->bind(":uname", $_POST['name']);
    $result = $this->stmt->fetch(PDO::FETCH_ASSOC);
  if($result){
$count =  $stmt->fetchColumn();
  return true;
}else return false;
}

public function getAll($model=""){

		 $this->query("SELECT * FROM {$model}");
		
		$r = $this->resultSet();
		return $r;
	}
        

public function insertComentar(){
     $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $text= $post['text_comment'];
     
     $this->query("INSERT INTO comments(id_user, id_vest, text_comment) VALUES(:id_user,:id_vest, :text_comment)");
     $this->bind(':id_user', $_SESSION['user_data']['id']);
     $this->bind(':id_vest', $_GET['id']);
     //$this->bind(':id_sport', $sid);
     $this->bind(':text_comment', $text);
  
    $this->execute();
    
}

public function getWhere($model, $key, $id ){
    $this->query("SELECT * FROM $model WHERE $key = :value");

$this->bind(':value', $id);
    $result = $this->resultSet();
    return $result;
    
}

public function SearchResult($model, $key, $value=""){
     $this->query("SELECT * FROM $model WHERE $key LIKE :value");
    	$this->stmt->execute(array(':value'=> '%'.$value.'%'));
                $this->bind(':value', $value);
		$r = $this->resultSet();
		return $r;   
}
public function getSportovi(){
    
$sportovi= $this->query("SELECT * FROM sportovi");
$sportovi= $this->resultSet();

//foreach($this->resultSet() as $row){
 
 
$vrsta= $this->query("SELECT * FROM vrsta_sporta");
//$vrsta=$this->bind(":sid", $row['sid']);
$vrsta = $this->resultSet();

  //}
  return array('sportovi'=>$sportovi, 'vrsta'=>$vrsta );
}

public function imgUpdate($id){
  
     if(isset($_FILES['image']['name'])){
  
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower((end(explode('.',$_FILES['image']['name']))));
      $newName=$id .".".$file_ext;
      $expensions= array("jpeg","jpg","png");
    
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File can not be bigger then 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"images/".$newName);		
		 $uploaded=($_FILES['image']['name']);

                 
                  $q="UPDATE users SET img = :newName WHERE uid = :id";
                    $stmt=$dbh->prepare($q);
		    $stmt->bindParam(':newName', $newName);
                    $stmt->bindParam(':id', $uid);
		    $r=$stmt->execute();
                    return $r;
         echo "Success uploaded <img src='".ROOT_PATH ."images/" . $newName. "' style='width:100px; height:100px;'/>";
    Messages::setMSg("Avatar je azuriran.", "success");
     }else{
         echo($errors);
      }
}
}



public function addSport(){
   
if(isset($_POST['addSport']))
{
    $post=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
		$new=$post['Sport'];
		if(!empty($new))
		{
$this->query("INSERT INTO sportovi(sid, sport) VALUES(null, :sport)");
$this->bind(':sport', $new);
    $this->execute();
 
		}
}
}
public function addVrsta($selected_sid){
   
if(isset($_POST['addVrsta']))
{
     $post=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$newCat=$post['Vrsta'];
		if(!empty($newCat))
		{
$this->query("INSERT INTO vrsta_sporta(vid, sid, vrsta) VALUES(null, :sid, :vrsta)");
$this->bind(':sid', $selected_sid);
$this->bind(':vrsta', $newCat);
    $this->execute();
 
		}
}    
}
public function setRespond(){
      
 if(isset($_POST['submit'])){
   if(!empty($_POST['text'])){
         $this->query("UPDATE userrequest SET status_request = :status WHERE id_request = :id");
         $this->bind(':status', 2);
	 $this->bind(':id', $_POST['id_request']);
		    $this->execute();
                echo   "Odgovor je poslat";
    }else{
     echo "Odgovor mora biti validan";
 }
 }
}

}





