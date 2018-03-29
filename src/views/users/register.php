<div class="column is-10 is-offset-1">
	<div class="panel card">
		<div class="panel-heading">
			<h3 class="panel-title">Register User</h3>
		</div>
		<div class="panel-block">
			<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" class="column is-10 is-offset-1">
				<div class="field">
					<label>First Name</label>
					<input type="text" name="first_name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'] ?>" class="input" />
				</div>
					<div class="field">
					<label>Last Name</label>
					<input type="text" name="last_name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'] ?>" class="input" />
				</div>
				<div class="field">
					<label>Email</label>
					<input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" class="input" />
				</div>
				<div class="field">
					<label>Password</label>
					<input type="password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" class="input" />
				</div>
				<div class="is-grouped">

					<div class="is-pulled-right">
						<div class="g-recaptcha" data-sitekey="6LeimE4UAAAAAEdA6JxZhmzF3N2T23FXxaHTxuo3"></div>
					</div>
					<br>
					<input class="button" name="submit" type="submit" value="Submit" />
					<a class="button is-text" href="<?php echo ROOT_URL; ?>">Cancel</a>
					<div class="select">
						<select name="role_id">
							<option value="1">User</option>
							<option value="2">Admin</option>
							<option value="3">Dev</option>
						</select>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>