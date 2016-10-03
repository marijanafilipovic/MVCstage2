 <?php
//make queries functioin
    class UserModel extends Model {
    public $id;
    public function rollAccount(){
   $result = $this->getAll($model='users');
   
    return $result; 

    }
    public function userRequest(){
    
      if(isset($_POST['submit'])){
         $this->query("INSERT INTO userrequest(id, text, uid_request) VALUES(NULL, :text, :uid_request)");
         $this->bind(':text', $_POST['text']);
	 $this->bind(':uid_request', $_SESSION['user_data']['id']);
		    $this->execute();
		    
     }  
    }
    public function userActivity(){
     if(isset($_POST['submit'])){
         $this->query("UPDATE users SET status = :status WHERE uid = :id");
         $this->bind(':status', $statuss);
	 $this->bind(':id', $uid);
		    $this->execute();
		    
     }
    }
    public function request(){
        $r=$this->getAll($model='userresquest');
       // return $r;
    if(isset($_POST['submit'])){
        if(!empty($_POST['text'])){
         $this->query("UPDATE userrequest SET status_request = :status WHERE id_request = :id");
         $this->bind(':status', 2);
	 $this->bind(':id', $id);
		    $this->execute();
        echo "Odrgovor je prosledjen.";
        }else{
            echo "Odrgovor nije dobar.";}
     }
    
    }
    public function userAccount(){

   $results=$this->getWhere($model='comments', $key='id_user', $id=$_SESSION['user_data']['id']);
    $posts=$this->getWhere($model='vesti', $key='autor', $id=$_SESSION['user_data']['id']);
    return array('results'=>$results, 'posts'=>$posts);


    }
    
    public function login(){
   $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
   
  if($post['submit']){
    $name = $post['name'];
    $password= $post['password'];
    $this->query("SELECT * FROM users WHERE uname = :uname AND password = :password");
    $this->bind(':uname',  $post['name']);
    $this->bind(':password', $password);
    $row = $this->single(); 

    if($row){
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_data'] = array(
            'id'=>$row['uid'],
            'uname'=>$row['uname'],
            'email'=>$row['uemail'],
            'fname'=>$row['fname'],
            'status'=>$row['status'],
            'img'=>$row['img']
          
        );
         header('Location:' . ROOT_URL .'home');
     
        }else{
      
        Messages::setMsg("Log nije uspesan.", "errorMsg");

    }
    
    }return;
    }
    
    


public function register(){
       $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       
        $username=  ($post['username']);
        $lname= ($post['lname']);
        $fname= ($post['fname']);
        $email= ($post['email']);
        $pass= ($post['password']);
          $token=bin2hex(openssl_random_pseudo_bytes(32));
          
   if($post['register'])
   {
if($post['username'] == '' || $post['email']== '' || $post['password']== '')
{
    Messages::setMsg("Molimo popunite sva polja za korisnicko ime, email i lozinku.", "errorMsg");
    return;
}
if($post['password']==$post['password2']){
    if(strlen($post['password'])<5){
         Messages::setMsg("Lozinka mora imati vise od 4 karaktera.", "errorMsg");
    }
}
if(!empty($post['email']))
{
        $this->query("SELECT uemail FROM users WHERE uemail = :uemail");
        $this->bind(':uemail',$email);
        $result= $this->single();
 if($result)
 {   
     Messages::setMsg("Uneti email je vec registrovan.", "errorMsg");
    return;
}

}
if(!empty($post['username']))
{
      $this->query("SELECT * FROM users WHERE uname = :uname");
 $this->bind(":uname", $post['username']);
    $result = $this->single();
  if(!empty($result)){
      Messages::setMsg('Korisnicko ime je vec registrovano.', 'errorMsg');
    return;
}

}
if($post['password']!==$post['password2']){
    Messages::setMsg('Lozinka mora da se potvrdi identicnim unosom.', 'errorMsg');
         return;
}

    if(strlen($post['password'])<5){
         Messages::setMsg('Lozinka mora imati vise od 4 karaktera.', 'errorMsg');
         return;
    }


$this->query("INSERT INTO users(uname,uemail,lastname,fname,password,active_code)VALUES(:uname,:uemail,:lname,:fname,:pass, :token)");
$this->bind(':uname', $post['username']);
$this->bind(':fname', $post['fname']);
$this->bind(':uemail', $post['email']);
$this->bind(':lname', $post['lname']);
$this->bind(':pass', $post['password']);
$this->bind(':token', $token);
 $this->execute();
      if($this->lastInsertId()){
        header('Location:' . ROOT_URL .'users/login');
      }
   }
   return;
}



}


 

