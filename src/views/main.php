<html>

<head>
  <title>ClassMate</title>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="<?php echo ROOT_PATH; ?>static-libs/fontawesome-all.min.js"></script>
  <script src="<?php echo ROOT_PATH; ?>static/assets/landing-page/js/jquery.min.js"></script>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
</head>

<body>
  <style>
    #loading {
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      position: fixed;
      display: block;
      background-color: #fff;
      z-index: 99;
      text-align: center;
    }

    #loading-image {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 200px;
      transform: translate(-50%, -50%);
      z-index: 100;
    }

  </style>
  <div id="loading">
    <img id="loading-image" src="<?php echo ROOT_PATH; ?>static/assets/loading.gif" alt="">
  </div>
  <div class="main-container">
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
              Welcome
              <?= $_SESSION['user_data']['first_name']; ?>
            </a>
            <div class="navbar-dropdown is-boxed">
              <a class="navbar-item" href="<?php echo ROOT_URL; ?>users/profile/<?= $_SESSION['user_data']['id']; ?>">
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
    <div class="main-container is-fluid" style="max-width:1500px; margin: 0 auto;">
      <!--page start-->
      <div class="row">
        <br>
        <br>
        <br>
        <div class="column">
          <article class="message is-info">
            <div class="message-header">
            </div>
            <div class="message-body">
              Please note that this site is currently under heavy development and is not fully functional. You can login and resgister
              but there is not much else at the moment. You can follow the development @ the the projects github
              <a href="https://github.com/harps116/classmate"> repo
                <i class="fab fa-github"></i>.</a>
              This is a personal project and I am still fleshing out some ideas. Open to suggestions and/or pull requests.
            </div>
          </article>
        </div>
        <div class="column is-4 is-offset-1">
          <?php Messages::display(); ?>
        </div>
        <?php require($view); ?>
      </div>

    </div>
    <!-- /.container -->
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
    <script src="<?php echo ROOT_PATH; ?>dist/build.js" defer></script>
  </div>
  <footer class="footer remove-all-styles">
    <div class="container">
      <div class="content has-text-centered">
        <p>
          <strong class="remove-all-styles">Classmate</strong> by
          <a href="https://adamharpur.com">Adam Harpur</a>. The source code is licensed
          <a href="http://opensource.org/licenses/mit-license.php">MIT</a> and available: .
          <ul class="icons">
            <li>
              <a href="https://github.com/harps116/classmate">
                <i class="fab fa-github"></i>
              </a>
            </li>
            <li>
              <a href="https://www.linkedin.com/in/adam-harpur/">
                <i class="fab fa-linkedin"></i>
              </a>
            </li>
          </ul>
          Our
          <a href="info/privacy">Privacy policy</a>. The website content is licensed
          <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
          <span>©</span>
          <span>
            <?php echo date("Y"); ?>
          </span>
          <span>-</span>
          <span>ClassMate</span>
        </p>
      </div>
    </div>
  </footer>
  <script>
    $(window).load(function () {
      setTimeout(() => {
        $('#loading').fadeOut('slow');
      });
    });

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
</body>

</html>
