<html>
<head>
	<title>ClassMate</title>
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>dist/css/bootstrap.css">
	<!-- <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>dist/css/style.css"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">`
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head>
<style>
    @import url("https://fonts.googleapis.com/css?family=Josefin+Slab|Raleway|Roboto+Slab");
    body {
        background: url("<?php echo ROOT_PATH; ?>/src/assets/geometry.png");
        font-family: "Raleway", serif !important;
        font-weight: 400;
    }
    .pattern{
      background: url("<?php echo ROOT_PATH; ?>/src/assets/pattern-md.png");
      padding: 0.5em;
    }

    .nav-con{
      border-bottom: 1px solid #83d5c0;
    }
    
</style>
<body>
  <div class="pattern"></div>
  <nav class="navbar navbar-default">
    <div class="container nav-con">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">ClassMate</a>
      </div>
      <div id="navbar" class="is-pulled-right collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="<?php echo ROOT_URL; ?>">Home</a></li>
          <li><a href="<?php echo ROOT_URL; ?>questions">Questions</a></li>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          <?php if(isset($_SESSION['is_logged_in'])) : ?>
          <li class="is-pulled-right"><a href="<?php echo ROOT_URL; ?>users/profile/<?= $_SESSION['user_data']['id']; ?>">Welcome <?= $_SESSION['user_data']['first_name']; ?></a></li>
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
      <br>
      <br>
      <br>
      <?php Messages::display(); ?>
      <?php require($view); ?>
    </div>

  </div><!-- /.container -->

       	<!-- Vue instance -->
      <div id="vue">

        <home></home>
      
      </div>
     <script src="<?php echo ROOT_URL; ?>dist/build.js"></script>
</body>
</html>