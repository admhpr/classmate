<p>Here is a list of all users:</p>

<?php foreach($users as $user) { ?>
  <p>
    <?php echo $user->first_name; ?>
    <a href='?presenter=users&action=show&id=<?php echo $user->id; ?>'>See content</a>
  </p>
<?php } ?>