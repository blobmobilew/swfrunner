<?php
    session_start();

    $username = "";
    $email = "";
    $errors = array();

    // Connect
    $db = mysqli_connect('localhost', 'root', '', 'registration');

    if(isset($_POST['register'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

        if (empty($username)) {
            array_push($errors, "Username is required..."); // Username not named
        }
        if (empty($email)) {
            array_push($errors, "Email is required..."); // Email not named
        }
        if (empty($password_1)) {
            array_push($errors, "Password is required..."); // Username not named
        }
        if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match...");
        }
        // No Errors go on
        if (count($errors) == 0) {
            $erank = "Member";
            $password = md5($password_1); // encrypted password
            $sql = "INSERT INTO users (username, email, 1password, erank) 
                        VALUES ('$username', '$email', '$password', '$erank')";
            mysqli_query($db, $sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }
    }

    // login
    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "Username is required..."); // Username not named
        }
        if (empty($password)) {
            array_push($errors, "Password is required..."); // Email not named
        }
        if (count($errors) == 0) {
            $password = md5($password); // encrypted password
            $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 1) {
                // Login
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $id;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');
            } else {
                array_push($errors, "Wrong username/password combination");
                header("location: login.php");
            }
        }
    }

    // Logout
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>