<?php var_dump($viewmodel) ?>
<?php foreach($viewmodel as $categories) { ?>
 	<div id="app" class="well">
			<h3><?php echo $categories['category']; ?></h3>		
			<hr />
			<p><?php echo $categories['title']; ?></p>
            <p><?php echo $categories['content']; ?></p>
		</div>

       <!-- <?php var_dump($categories) ?> -->
<?php } ?>