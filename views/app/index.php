<div class="text-center">
	<img src="<?php echo ROOT_PATH; ?>dist/img/logo.png" alt="ClassMate logo">
	<h1>Welcome To ClassMate</h1>
	<p class="lead">Leave class and still have questions? Ask your classmates, answer their questions and view other answers.</p>
	<a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>questions">Ask your classmates</a>

	<div id="vue">
		<new-module></new-module>
	</div>

	<?php echo($_SESSION["user_data"]["first_name"]) ?>
</div>