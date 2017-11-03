<?php
/* User login process, checks if user exists and password is correct */

// using pdo prepare method to protect against SQL injections
$email = $_POST['email'];
$query = "SELECT * FROM users WHERE email=:email";
$statement = $db->prepare($query);
$statement->bindValue(':email', $email, PDO::PARAM_STR);
$statement->execute();


if ( $statement->rowCount() == 0 ){ // User doesn't exist send to system error handler
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: system/error.php");
}
else { // User exists grab the data
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ( password_verify($_POST['password'], $user['password']) ) {
    
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];
        
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: app/home.php");
    }
    else {
        var_dump($user);
        die();
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: system/error.php");
    }
}

