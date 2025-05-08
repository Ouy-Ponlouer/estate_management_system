<?php

//  if no session_start() it will be session_start()
  if (session_status() == PHP_SESSION_NONE) {  //session_status :  returns the current status of the session.
    session_start();     //  PHP_SESSION_NONE : Sessions are enabled, but no session has been started yet
}
   define("base_url","http://localhost/estate_management_system/homeland");
  //  require "../configs/config.php"; // Error 
   require dirname(dirname(__FILE__))."/configs/config.php";
  //  echo dirname(dirname(__FILE__));

  // ==========  select category start ================//
  $category = $con ->prepare("SELECT * FROM `category`");
  $category->execute();
  $all_categories=$category->fetchAll(PDO::FETCH_OBJ);
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Homeland</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500"> 
    <link rel="stylesheet" href="<?php echo base_url; ?>/fonts/icomoon/style.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>/css/mediaelementplayer.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>/css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>/css/fl-bigmug-line.css">
    
  
    <link rel="stylesheet" href="<?php echo base_url; ?>/css/aos.css">

    <link rel="stylesheet" href="<?php echo base_url; ?>/css/style.css">
    
  </head>
  <body>
  <!--  Header Start -->
<div class="site-loader"></div>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->

    <!-- Navbar start -->
    <div class="site-navbar mt-4">
        <div class="container py-1">
          <div class="row align-items-center">
            <div class="col-8 col-md-8 col-lg-4">
              <h1 class="mb-0"><a href="<?php echo base_url ?>" class="text-white h2 mb-0"><strong>Homeland<span class="text-danger">.</span></strong></a></h1>
            </div>
            <div class="col-4 col-md-4 col-lg-8">
              <nav class="site-navigation text-right text-md-right" role="navigation">

                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

                <ul class="site-menu js-clone-nav d-none d-lg-block">
                  <li class="active">
                    <a href="<?php echo base_url ?>">Home</a>
                  </li>
                  <li><a href="<?php echo base_url ?>/buy.php?type=sale">Sale</a></li>
                  
                  <li><a href="<?php echo base_url ?>/rent.php?type=rent">Rent</a></li>
                  <li><a href="<?php echo base_url ?>/about.php">About</a></li>
                  <li><a href="<?php echo base_url ?>/contact.php">Contact</a></li>
                  <li class="has-children">
                    <a href="<?php echo base_url ?>/properties.php">Properties</a>
                    <ul class="dropdown arrow-top">
                      <?php foreach ($all_categories as $categorys) :?>
                      <li><a href="<?php echo base_url ?>/categories/category.php?name=<?php echo $categorys->name; ?>"><?php echo str_replace("-"," ","$categorys->name")  ?></a></li>                      
                    <?php endforeach ;?>
                    </ul>
                  </li>
                  <!-- ------------------- -->
                  <!--  Login Logout Start -->
                  <!-- ------------------- -->

                  <?php if (isset($_SESSION['name'])): ?>
                  <li class="has-children">
                    <a href="# "><?php echo $_SESSION['name'] ?></a>
                    <ul class="dropdown arrow-top">
                      <li><a href="<?php echo base_url ?>/user/favorite.php">Favorite</a></li>
                      <li><a href="<?php echo base_url ?>/user/request.php">Request</a></li>
                      <li><a href="<?php echo base_url ?>/auths/logout.php">Logout</a></li>

                    </ul>
                  </li>
                  <?php else : ?>
                  <li><a href="<?php echo base_url ?>/auths/login.php">Login</a></li>
                  <li><a href="<?php echo base_url ?>/auths/register.php">Register</a></li>
                  <?php endif ; ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

 <!-- Header end  -->