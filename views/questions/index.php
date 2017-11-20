<div>
	<?php if(isset($_SESSION['is_logged_in'])) : ?>
	<a class="btn btn-success btn-question" href="<?= ROOT_PATH ?>questions/add">Question Something</a>
	<?php endif; ?>
	<?php var_dump($viewmodel); ?>
	<!-- cleaning that dirty PHP data to keep Vue happy --> 
	<script>
		var json = <?php echo(json_encode($viewmodel)) ?>;
	
	</script>
	<!-- see ./src/components/QuestionList.vue -->
	<div id="vue">
		<question-list :json="json"></question-list>
	</div>

</div>
