<?php
  function call($presenter, $action) {
    require_once('presenters/' . $presenter . '_presenter.php');

    switch($presenter) {
      case 'pages':
        $presenter = new PagePresenter();
      break;
      case 'users':
        // we need the model to query the database later in the presenter
        require_once('models/user.php');
        $presenter = new UserPresenter();
      break;
    }

    $presenter->{ $action }();
  }

  // we're adding an entry for the new presenter and its actions
  $presenters = array('pages' => ['home', 'error'],
                       'users' => ['index', 'show']);

  if (array_key_exists($presenter, $presenters)) {
    if (in_array($action, $presenters[$presenter])) {
      call($presenter, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>