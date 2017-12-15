<html>
<head>
	<title>ClassMate</title>
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>dist/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>dist/css/fonts/css/font-awesome.min.css">
</head>
<body>
  <div class="pattern"></div>
    <nav class="navbar is-transparent">
    <div class="navbar-brand animated fadeInLeft">
      <a class="navbar-item" href="/">
       <img src="<?php echo ROOT_PATH; ?>dist/img/logo-sm.png" alt="ClassMate logo"> ClassMate 
    </a>
      <div class="navbar-burger burger" data-target="">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div id="main-menu" class="navbar-menu nav-con">
      <div class="navbar-start">
        <a class="navbar-item" href="<?php echo ROOT_URL; ?>">
          Home
        </a>
        <a class="navbar-item" href="<?php echo ROOT_URL; ?>questions">
          Questions  
        </a>
        </div>
        <div class="navbar-end">
          <?php if(isset($_SESSION['is_logged_in'])) : ?>
              <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" href="#">
                  Welcome <?= $_SESSION['user_data']['first_name']; ?>
                </a>
                <div class="navbar-dropdown is-boxed">
                  <a class="navbar-item" href="<?php echo ROOT_URL; ?>users/profile/<?= $_SESSION['user_data']['id']; ?>" >
                    Profile
                  </a>
                  <!-- <a class="navbar-item" href="<?php echo ROOT_URL; ?>questions/category">
                    Categories
                  </a> -->
                  <a class="navbar-item" href="<?php echo ROOT_URL; ?>users/logout">
                    Logout
                  </a>
                </div>
            <?php else : ?>
              <div class="navbar-item has-dropdown is-hoverable cm-navbar-margin">
                <a class="navbar-link" href="#">
                  Enter
                </a>
                <div class="navbar-dropdown is-boxed">
                  <a class="navbar-item" href="<?php echo ROOT_URL; ?>users/login">
                  Login
                  </a>
                  <a class="navbar-item" href="<?php echo ROOT_URL; ?>users/register">
                   Register
                  </a>
                </div>
              </div>
            <?php endif; ?>
      </div>
      </div>
    </div>
  </nav>  
  <div class="container is-fluid"> <!--page start-->
    <div class="row">
      <br>
      <br>
      <br>
      <div class="">
        <?php Messages::display(); ?>
        <?php require($view); ?>
      </div>
    </div>

  </div><!-- /.container -->
    	<!-- prepping the PHP data to keep Vue happy --> 
      <script>
        <?php if( isset($_SESSION['is_logged_in'])): ?>
          var userData = <?php echo(json_encode($_SESSION['user_data'])); ?>;
        <?php endif; ?>	
      </script>
       	<!-- Vue instance -->
      <div id="vue">

        <home :user-data="userData"></home>
      
      </div>
     <script src="<?php echo ROOT_URL; ?>dist/build.js"></script>
</body>
</html>