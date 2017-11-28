<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Register User</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    	<div class="field">
    		<label>First Name</label>
    		<input type="text" name="first_name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'] ?>" class="form-control" />
    	</div>
				<div class="form-group">
    		<label>Last Name</label>
    		<input type="text" name="last_name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'] ?>" class="form-control" />
    	</div>
    	<div class="form-group">
    		<label>Email</label>
    		<input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" class="form-control" />
    	</div>
    	<div class="form-group">
    		<label>Password</label>
    		<input type="password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" class="form-control" />
    	</div>
    	<input class="btn btn-primary" name="submit" type="submit" value="Submit" />
    </form>
  </div>
</div>