<html>
<head>
	<title>ClassMate</title>
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>dist/css/style.css">
  <script src="https://cdn.polyfill.io/v2/polyfill.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">ClassMate</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo ROOT_URL; ?>">Home</a></li>
            <li><a href="<?php echo ROOT_URL; ?>questions">Questions</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <?php if(isset($_SESSION['is_logged_in'])) : ?>
            <li><a href="<?php echo ROOT_URL; ?>users/profile/<?= $_SESSION['user_data']['id']; ?>">Welcome <?= $_SESSION['user_data']['first_name']; ?></a></li>
            <li><a href="<?php echo ROOT_URL; ?>users/logout">Logout</a></li>
          <?php else : ?>
            <li><a href="<?php echo ROOT_URL; ?>users/login">Login</a></li>
            <li><a href="<?php echo ROOT_URL; ?>users/register">Register</a></li>
          <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

     <div class="row">
      <?php Messages::display(); ?>
     	<?php require($view); ?>
     </div>

    </div><!-- /.container -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.3/vue.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.1/axios.min.js"></script>
     <script src="https://cdn.jsdelivr.net/bootstrap.native/1.0.4/bootstrap-native.js"></script>
     <script src="<?php echo ROOT_URL; ?>src/main.js"></script>
</body>
</html>