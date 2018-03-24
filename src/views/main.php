<html>
  <head>
    <title>ClassMate</title>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>dist/css/fonts/css/font-awesome.min.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="/static-libs/fontawesome-all.min.js"></script>
  </head>
  <body>
    <div class="pattern"></div>
      <nav class="navbar is-transparent">
      <div class="navbar-brand animated fadeInLeft">
        <a class="navbar-item" href="/">
        <img src="<?php echo ROOT_PATH; ?>dist/img/logo-sm.png" alt="ClassMate logo"> ClassMate 
        </a>
        <div id="burger" class="navbar-burger burger" data-target="main-menu">
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
        <footer class="footer remove-all-styles">
          <div class="container">
            <div class="content has-text-centered">
              <p>
                <strong class="remove-all-styles">Classmate</strong> by <a href="https://adamharpur.com">Adam Harpur</a>. The source code is licensed
                <a href="http://opensource.org/licenses/mit-license.php">MIT</a> and available: . 
                <ul class="icons">
                  <li><a href="https://github.com/harps116/classmate"><i class="fab fa-github"></i></a></li>
                  <li><a href="https://www.linkedin.com/in/adam-harpur/"><i class="fab fa-linkedin"></i></a></li>
                </ul>
                Our <a href="info/privacy">Privacy policy</a>.
                The website content
                is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
                <span>©</span>
                <span><?php echo date("Y"); ?></span>
                <span>-</span>
                <span>ClassMate</span>
              </p>
            </div>
          </div>
        </footer>
        <script>
          document.addEventListener('DOMContentLoaded', function () {

              // Get all "navbar-burger" elements
              var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

              // Check if there are any navbar burgers
              if ($navbarBurgers.length > 0) {

                // Add a click event on each of them
                $navbarBurgers.forEach(function ($el) {
                  $el.addEventListener('click', function () {

                    // Get the target from the "data-target" attribute
                    var target = $el.dataset.target;
                    var $target = document.getElementById(target);

                    // Toggle the class on both the "navbar-burger" and the "navbar-menu"
                    $el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                  });
                });
              }

            });
        </script>
      <script src="<?php echo ROOT_PATH; ?>dist/build.js"></script>
  </body>
</html>