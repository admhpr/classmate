 <?php foreach($viewmodel as $question) { ?>
 	<div class="well">
			<h3><?php echo $question['title']; ?></h3>
			<small><?php echo $question['date_created']; ?></small>
			<hr />
			<p><?php echo $question['content']; ?></p>
		</div>
<?php } ?>
