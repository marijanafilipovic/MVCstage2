<?php

class ShareModel extends Model {
public $id;

        
public function Index(){
    $this->query('SELECT * FROM vesti');
    $rows = $this->resultSet();
    return $rows;
 
}

public function add($selected_sid, $selected_vid, $selected_type){
 
  $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  if(isset($_POST['share'])){
    if($post['title'] == '' || $post['text'] == '' || $post['uvod']== ''){
        Messages::setMsg('Sva polja su obavezna', 'error');
        return;
    }else{
        
$this->query("INSERT INTO $selected_type(  sid, vid,  title, uvod, text, autor,time_added) VALUES(:sid, :vid,  :title, :uvod, :text, :author, NOW())");
$this->bind(':sid', $selected_sid);
$this->bind(':vid', $selected_vid);
$this->bind(':title', $post['title']);
$this->bind(':uvod', $post['uvod']);
$this->bind(':text', $post['text']);

$this->bind(':author', $_SESSION['user_data']['id']);
    $this->execute();
      if($this->lastInsertId()){
        header('Location:' . ROOT_URL .'shares');
      }
   }
      
  }
  return;
}

public function selectPost($sel_id){
    
          $this->query("SELECT * FROM vrsta_sporta WHERE sid = :id");
          $this->bind(':id',$sel_id);
    $cats= $this->resultSet();
    
          $this->query("SELECT * FROM  info WHERE sid = :id");
          $this->bind(':id',$sel_id);
    $info= $this->resultSet();

           $this->query("SELECT * FROM vesti WHERE sid = :id");
           $this->bind(':id',$sel_id);
    $vesti= $this->resultSet();

            $this->query("SELECT * FROM comments ");
       
    $comment = $this->resultSet();
    
    return array('vesti'=>$vesti, 'info'=>$info, 'cats'=>$cats, 'comment'=>$comment);

}
public function selectCategory($sel_id){

        
            $this->query("SELECT * FROM vesti LEFT OUTER JOIN comments
                    ON vesti.id = comments.id_vest  LEFT OUTER JOIN users
                    ON comments.id_user = users.uid WHERE vesti.vid = :id");
            $this->bind(':id', $sel_id);
    $vesti = $this->resultSet();
    
     
    
    return array('vesti'=>$vesti );
    
}
public function render($sel_id){
    $this->query("SELECT * FROM comments LEFT OUTER JOIN users ON comments.id_user = users.uid WHERE comments.id_vest = :id");
        $this->bind(':id',$sel_id);
        $comment= $this->resultSet();
      
      $this->query("SELECT * FROM vesti WHERE id = :id");
        $this->bind(':id',$sel_id);
        $vest= $this->resultSet();
      return array('vesti'=>$vest, 'comment'=>$comment);
 

}


}

