<p>Here is a list of all users:</p>
<?php var_dump($users)?>
<?php foreach($users as $user) { ?>
  <p>
    <?php echo $user->first_name; ?>
    <a href='<?php __ROOT__?><?php echo $user->id; ?>'>See content</a>
  </p>
<?php } ?>