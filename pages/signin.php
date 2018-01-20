<?php

//login.php

/**
 * Start the session.
 */

session_start();

/**
 * Include ircmaxell's password_compat library.
 */

/**
 * Include our MySQL connection.
 */
require 'connect.php';


//If the POST var "login" exists (our submit button), then we can
//assume that the user has submitted the login form.
if(isset($_POST['login'])){

    //Retrieve the field values from our login form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password'])   ? trim($_POST['password']) : null;

    //Retrieve the user account information for the given username.
    $sql = "SELECT id, username, password_hash FROM user WHERE username = :username";
    $stmt = $pdo->prepare($sql);

    //Bind value.
    $stmt->bindValue(':username', $username);

    //Execute.
    $stmt->execute();

    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //If $row is FALSE.
    if($user === false){
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        echo "<a href='/therapybox-rockphp/'>Back</a><br/>";
        die('Incorrect username / password combination!');
    } else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.

        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password_hash']);

        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){

            //Provide the user with a login session.
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();

            //Redirect to our protected page, which we called main.php
            header('Location: main.php');
            exit;

        } else{
            //$validPassword was FALSE. Passwords do not match.
            echo "<a href='/therapybox-rockphp/'>Back</a><br/>";
            die('Incorrect username / password combination!');
        }
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<div class="container">
    <h1>Login</h1>
    <form action="signin.php" method="post" style="width:40%;border: 1px solid #ccc; padding: 20px;">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control"><br>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" id="password" name="password" class="form-control"><br>
        </div>
        <input type="submit" name="login" value="Sign In" class="btn btn-primary">
    </form>
    <div>
        <span>OR </span><a href="/therapybox-rockphp/signup">Sign Up</a>
    </div>
</div>
