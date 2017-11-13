# Adv-Web-Final-Project

## Reddit/HackerNews/StackOverflow clone

## Stack

- Maria DB
- Php 7.0
- JavaScript, CSS, HTML
***********************
### Dev Quickstart
:wrench:
`/config.php`
```
define("DEV_BUILD", true);
```
:headphones: :clapper: [Quickstart Video](https://www.youtube.com/watch?v=D2o14PY7Ums&feature=youtu.be)

## Recipe to add functionality
:book:

1. add a file to the `models` folder that queries the database:

    - create a `model` ( if one doesn't exist ) 
      > note that the `model` file names are singular

`/models/user.php`
```
	protected function profile(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->profile($_GET["id"]), true);
	}

```
      
2. add a file to the `controllers` that gets the data from the model and then returns the corresponding `viewmodel`:

    - create a `controller`that respresents the data you want to get ( if one doesn't exist ).  
    - add a `method` to the `controller` that will call the corresponding `method` of the `model`.
     > don't forget to require them both in `index.php`
       note controllers are plural

`/controllers/users.php`
```
	public function profile($id){
		// Example only 
		// Add DB logic here

		if($_SESSION['is_logged_in']){
			$sql = 'SELECT * FROM users
					WHERE id = :id';

			$id = intval($id);		
			$this->query($sql);
			$this->bind(':id', $id);
			$row = $this->single();
			return $row;
		}
	}
```

3. add a corresponding `view` folder named after the controller with a file for the `method`. 

    - This holds pages that reflect a method in the `controller`. If the param passed to the controller `returnView` is true the view will be full page and include `main.php` otherwise it will just be the `view`.

     > :warning: !important the view should have the same name as the method in the controller

`/views/users/profile.php`
```
    // Example only
    <?php var_dump($viewmodel); ?>
```
### End Quickstart

***********************

###