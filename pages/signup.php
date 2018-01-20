<?php

//register.php

/**
 * Start the session.
 */
session_start();

/**
 * Include our MySQL connection.
 */
require 'connect.php';


//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(isset($_POST['signup'])){

    if($_POST["password_hash"]!==$_POST["confirm_password"]){
        echo "<div>Passwords dont match</div>";
    }else {

        //Retrieve the field values from our registration form.
        $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
        $email = $_POST['email'];
        $pass = !empty($_POST['password_hash']) ? trim($_POST['password_hash']) : null;

        //TO ADD: Error checking (username characters, password length, etc).
        //Basically, you will need to add your own error checking BEFORE
        //the prepared statement is built and executed.

        //Now, we need to check if the supplied username already exists.

        //Construct the SQL statement and prepare it.
        $sql = "SELECT COUNT(username) AS num FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);

        //Bind the provided username to our prepared statement.
        $stmt->bindValue(':username', $username);

        //Execute.
        $stmt->execute();

        //Fetch the row.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //If the provided username already exists - display error.
        //TO ADD - Your own method of handling this error. For example purposes,
        //I'm just going to kill the script completely, as error handling is outside
        //the scope of this tutorial.
        if ($row['num'] > 0) {
            die('That username already exists!');
        }

        //Hash the password as we do NOT want to store our passwords in plain text.
        $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

        //Prepare our INSERT statement.
        //Remember: We are inserting a new row into our users table.
        $sql = "INSERT INTO user (username, email, password_hash, date_signed_up) VALUES (:username, :email, :password_hash, CURRENT_TIMESTAMP )";
        $stmt = $pdo->prepare($sql);

        //Bind our variables.
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password_hash', $passwordHash);
        $stmt->bindValue(':email', $email);


        //Execute the statement and insert the new account.
        $result = $stmt->execute();

        //If the signup process is successful.
        if ($result) {
            //What you do here is up to you!
            echo 'Thank you for registering with our website.';
        }
    }
}

?>

<?php
    include "../inc/header.php";
?>

<div class="container">
    <h1>Sign Up Page</h1>
    <form action="signup.php" method="post" style="width: 40%;border: 1px solid #ccc;padding: 20px;">
        <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control">
        </div>

        <div class="form-group">
        <label for="password">Password</label>
        <input type="text" id="password" name="password_hash"  class="form-control">
        </div>

        <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="text" id="confirm_password" name="confirm_password"   class="form-control">
        </div>
        <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control">
        </div>
        <input type="submit" name="signup" value="Sign Up"   class="btn btn-primary">
    </form>

    <div>
        <a href="/therapybox-rockphp/">Go to Login Page</a>
    </div>
</div>

<?php
    include "../inc/footer.php";
?>