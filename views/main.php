
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>SerbianSportSpot</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<? echo ROOT_PATH; ?>assests/style/style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:300,200&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Slabo+27px&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather&subset=latin,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Jura:400,500&subset=latin-ext,cyrillic,latin' rel='stylesheet' type='text/css'>
    <link href="<? echo ROOT_PATH; ?>assests/style/bootstrap.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div id="wrapper"   >
    <div id="head">

    </div><!--head-->
    <div class="header "  >

        <?php

        if(!isset($_SESSION['is_logged_in'])==true){
            echo
                '<div class="login" style="margin-top:50px;">
        <a href="'. ROOT_URL.'users/register"><div id="button">
      Registracija
       </div></a>
       <a href="'. ROOT_URL.'users/login"><div id="button">
       Logovanje</div></a>  
       </div>';
        }else{

            echo'<div class="login" style="margin-top:50px;">';

            ?>
            <img src='<? echo ROOT_PATH; ?>images/<?php
            if(!empty($_SESSION['user_data']['img'])){
                echo $_SESSION['user_data']['img'];
            }else{
                $defaultImg="default.png";
                echo $defaultImg; } ?>' style='float:left; border:1px solid grey; width:32px;  height:32px;'/>
            <?

            echo'<a href="'. ROOT_URL.'users/userAccount/'. $_SESSION['user_data']['id'].'">
	 <div id="button" style="width:140px;"><p>Tvoj nalog '. ucfirst($_SESSION['user_data']['uname']).' </p></div></a>
<a href="'.ROOT_URL.'shares/add">'; ?>

            <?php if( $_SESSION['user_data']['status'] !=4 AND $_SESSION['user_data']['status'] !=1){
                echo '<div id="button"><p>Objavi</p></div></a>';
            }?><?
            if(($_SESSION['user_data']['status'])==3){
                echo '
		<a href="'. ROOT_URL.'shares/addCategory"><div id="button" style="width:140px;"><p>Dodaj kategorije</p></div></a>
		 <a href="'. ROOT_URL.'users/rollAccount"><div id="button"><p>Korisnici</p></div></a>
		  <a href="'. ROOT_URL.'users/request"><div id="button" style="width:120px; overflow:hidden;"><p style="float:left; ">Zahtevi</p><img src="'. ROOT_URL.'img/requests.png" width="45px" height="30px" style="padding:5px; float:left;"/></div></a>
		</div>';
            }
        }



        ?>


        <?


        ?>
    </div>


    <div class="container" style="background-color:white;">
        <div class="navbar-header navbar-default navbar-fixed-top" style="background-color:#959983;">

            <a class="navbar-brand" style="background-color:rgba(252, 251, 242,0.55);" href="#">Sport u Srbiji</a><img src='<? echo ROOT_PATH; ?>/img/news.jpg' height="50px;"/>


        </div>

        <div id="navbar" class="collapse navbar-collapse" style=" background-color:#CECFC0;">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<? echo ROOT_URL;?>">Pocetna</a></li>
                <li><a href="#about">Pravila koriscenja</a></li>
                <li><a href="<? echo ROOT_URL; ?>shares/">Sve objave</a></li>
                <li><a href="<? echo ROOT_URL; ?>users/userRequest">Pitaj administratora</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($_SESSION['user_data'])): ?>
	
	   <li><a href="<? echo ROOT_URL; ?>users/logout">LOG OUT</li></a>
	   <?php else: ?>
            <li class="active"><a href="<? echo ROOT_URL;?>users/register">Registracija</a></li>
            <li><a href="<? echo ROOT_URL; ?>users/login">Logovanje</a></li>
          <? endif; ?>
            </ul>
        </div><!--/.nav-collapse --></div>
</div>

<div class="container" style="margin-top:3px;">
    <div class="pretraga">

        <div class="search2" >


            <div class="row" >

                <? Messages::display();?>

            </div>
        </div>
    </div><?php
    require($view);
    ?>
</div><!-- and container -->
</body>
</html>