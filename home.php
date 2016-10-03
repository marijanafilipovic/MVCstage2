<?php

class HomeModel extends Model  {


public function Index(){

$this->query('SELECT * FROM sportovi');
$rows = $this->resultSet();

 return $rows;     

}
}
