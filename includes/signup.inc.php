<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_controller.inc.php';

        // validation rules:
            // validation rules:
            // all input must be filled before submitting
            // valid email
            // no same username
            // registered email cannot be used
            // password more than 8 characters

        $errors = []; // tracking errors; should be associative

        // empty_input
        if (is_input_empty($username, $pwd, $email)) {
            $errors['empty_input'] = 'Fill all inputs!';
        }

        // invalid_email
        if (is_email_invalid($email)) {
            $errors['invalid_email'] = 'Email is invalid!';
        }

        // registered_email
        if (is_email_registered($pdo, $email)) {
            $errors['registered_email'] = 'Email is already registered. Use a different one!';
        }

        require_once 'config_session.inc.php';

        // error handling using validation rules
        if ($errors) {
            // stores the errors to be called later
            $_SESSION['signup_errors'] = $errors;

            // stores the filled inputs for later if it's valid
            // better UX for users
            $signupData = [
                'username' => $username,
                'email' => $email
            ];
            $_SESSION['signup_data'] = $signupData;

            header('Location: ../register.php'); // goes back to the signup page
            

            die();
        }

        // password hashing
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT, [''=> 12]);

        create_user($pdo, $username, $hashedPwd, $email);

        header("Location: ../register.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../register.php");
}