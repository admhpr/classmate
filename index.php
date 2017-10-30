<?php
require_once('includes/db_connection.php');

// Note that this index.php file is going to receive all the requests
// The if statement is gonna check whether we have the parameters presenter and action set and store them in variables. 
// If we do not have such parameters we just make pages the default presenter and home the default action


//we could maybe authenticate here?
  if (isset($_GET['presenter']) && isset($_GET['action'])) {
    $presenter = $_GET['presenter'];
    $action     = $_GET['action'];
  } else {
    $presenter = 'pages';
    $action     = 'home';
  }

  require_once('views/layout.php');
?>