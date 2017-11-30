<div>
	<?php if(isset($_SESSION['is_logged_in'])) : ?>
		
	<?php endif; ?>
	<!-- prepping the PHP data to keep Vue happy --> 
	<script>
		var cmData = <?php echo(json_encode($viewmodel)); ?>;
		<?php if( isset($_SESSION['is_logged_in'])): ?>
			var userData = <?php echo(json_encode($_SESSION['user_data'])); ?>;
		<?php endif; ?>	
	</script>
	<!-- see ./src/components/QuestionList.vue -->
	<div id="vue">
		<question-list :cm-data="cmData" :user-data="userData"></question-list>
	</div>

</div>
