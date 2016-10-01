<?php

session_start();
require('config.php');
require ('classes/Bootstrap.php');
require ('classes/Controller.php');
require ('classes/Model.php');
require ('classes/Messages.php');
require ('classes/Connect.php');


require ('models/home.php');
require ('models/user.php');
require ('models/share.php');
;

require ('controllers/home.php');
require ('controllers/users.php');
require ('controllers/shares.php');

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
    $controller->executeAction();
    
}
