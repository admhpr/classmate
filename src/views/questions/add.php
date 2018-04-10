<div class="column is-6 is-offset-3">
		<div class="panel card">
		<div class="panel-heading">
			<h3 class="panel-title">Question Something!</h3>
		</div>
		<div class="panel-block">
			<form method="post" action="#" class="l-full">
				<div class="field">
					<label>Question</label>
					<input type="text" name="title" class="input" />
				</div>
				<div class="field">
					<label>Details</label>
					<textarea name="content" class="input"></textarea>
				</div>
				<div class="field">
					<label>Category</label>
					<div class="control">
					<div class="select">
						<select name="category_id">
							<option value="1">Advanced Web Dev</option>
							<option value="2">Advanced Topics in Programing</option>
							<option value="3">Android Development</option>
							<option value="4">Generals</option>
						</select>
						</div>
					</div>
				</div>
				<div class="is-grouped">
					<input class="btn btn-primary" name="submit" type="submit" value="Submit" />
					<a class="button is-text" href="<?php echo ROOT_URL; ?>questions">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>
