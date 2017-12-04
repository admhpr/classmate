<html>
<head>
	<title>ClassMate</title>
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>dist/css/fonts/css/font-awesome.min.css">
</head>
<body>
  <div class="pattern"></div>
    <nav class="navbar is-transparent">
    <div class="navbar-brand">
      <a class="navbar-item" href="https://bulma.io">
        <p>Classmate</p>
      </a>
      <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
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
                  <a class="navbar-item" href="<?= ROOT_PATH ?>questions/add">
                    Ask a Question
                  </a>
                  <a class="navbar-item" href="<?php echo ROOT_URL; ?>questions/category">
                    Categories
                  </a>
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
          <!-- <div class="field is-grouped">
            <p class="control">
              <a class="bd-tw-button button" data-social-network="Twitter" data-social-action="tweet" data-social-target="http://localhost:4000" target="_blank" href="https://twitter.com/intent/tweet?text=Bulma: a modern CSS framework based on Flexbox&amp;hashtags=bulmaio&amp;url=http://localhost:4000&amp;via=jgthms">
                <span class="icon">
                  <i class="fa fa-twitter"></i>
                </span>
                <span>
                  Tweet
                </span>
              </a>
            </p>
            <p class="control">
              <a class="button is-primary" href="https://github.com/jgthms/bulma/archive/0.5.1.zip">
                <span class="icon">
                  <i class="fa fa-download"></i>
                </span>
                <span>Download</span>
              </a>
            </p>
          </div> -->
        <!-- </div> -->
      </div>
    </div>
  </nav>  
  <div class="container is-fluid"> <!--page start-->
    <div class="row">
      <br>
      <br>
      <br>
      <div class="col-md-offset-1">
        <?php Messages::display(); ?>
        <?php require($view); ?>
      </div>
    </div>

  </div><!-- /.container -->

       	<!-- Vue instance -->
      <div id="vue">

        <home></home>
      
      </div>
     <script src="<?php echo ROOT_URL; ?>dist/build.js"></script>
</body>
</html>