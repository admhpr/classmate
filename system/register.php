<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */

// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

// Escape all $_POST variables to protect against SQL injections
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$salt = md5( rand(0,1000) );
var_dump($first_name);
// Check if user exists
$query = "SELECT * FROM users WHERE email=:email";
$statement = $db->prepare($query);
$statement->bindValue(':email', $email, PDO::PARAM_STR);
$statement->execute();

if ( $statement->rowCount() > 0 ){ // User doesn't exist send to system error handler
    $_SESSION['message'] = "User with that email already exists!";
    header("location: system/error.php");
}
else { // Email doesn't already exist in a database, proceed...
    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `salt`)  
    VALUES (:first_name,:last_name,:email,:password,:salt)";
    $statement = $db->prepare($sql);
    var_dump($statement);
    $success = $statement->execute(array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email" => $email,
        "password" => $password,
        "salt" => $salt,
    ) );
     var_dump($statement);


    // Add user to the database
    if ( $success ){

        $_SESSION['is_active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =
                
                 "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";

        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Account Verification ( clevertechie.com )';
        $message_body = '
        Hello '.$first_name.',

        Thank you for signing up!

        Please click this link to activate your account:

        http://localhost/login-system/verify.php?email='.$email.'&hash='.$salt;  

        mail( $to, $subject, $message_body );

        header("location: profile.php"); 

    }

    else {
        // $_SESSION['message'] = 'Registration failed!';
        // header("location: system/error.php");
        var_dump($success);
    }

}