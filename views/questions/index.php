<div>
	<?php if(isset($_SESSION['is_logged_in'])) : ?>
	<a class="btn btn-success btn-question" href="<?php echo ROOT_PATH; ?>questions/add">Question Something</a>
	<?php endif; ?>
		<?php var_dump($viewmodel); ?>
	<?php foreach($viewmodel as $item) : ?>
	<?php var_dump($item); ?>
		<div class="well">
			<h3><?php echo $item['title']; ?></h3>
			<small><?php echo $item['date_created']; ?></small>
			<hr />
			<p><?php echo $item['content']; ?></p>
			<br />
			<a class="btn btn-default" href="questions/show/<?php $item['id']?>" target="_blank">Go To Website</a>
		</div>
	<?php endforeach; ?>
</div>