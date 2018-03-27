<div class="columns">
	<div class="column is-8 is-offset-2">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">User Login</h3>
			</div>
			<div class="panel-block">
				<!-- default form action to self -->
				<form method="post" action="" class="column is-7">
					<div class="field">
						<label>Email</label>
						<div class="control">
							<input type="text" name="email" class="input"/>
						</div>
					</div>
					<div class="field">
						<label>Password</label>
						<div class="control">
							<input type="password" name="password" class="input"/>
						</div>
					</div>
					<div class="is-grouped">
						<input class="button" name="submit" type="submit" value="Submit" />
						<a class="button is-text" href="<?php echo ROOT_URL; ?>">Cancel</a>
						<a class="button is-text is-right" href="register/">Register</a>
					</div>
				</form>
				<div class="column is-4">
					<div class="media">
						<div></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
