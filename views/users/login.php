<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">User Login</h3>
		</div>
		<div class="panel-body">
			<!-- default form action to self -->
			<form method="post" action="">
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" class="form-control" />
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" />
				</div>
				<div class="is-grouped">
					<input class="btn btn-primary" name="submit" type="submit" value="Submit" />
					<a class="button is-text" href="<?php echo ROOT_URL; ?>">Cancel</a>
					<a class="button is-text is-right" href="register/">Register</a>
				</div>
			</form>
		</div>
	</div>
</div>