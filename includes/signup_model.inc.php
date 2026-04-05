<?php

declare(strict_types=1);

// gets the username from the database
// used to check if the username is taken or not
function get_username(object $pdo, string $username) {
    $query = "SELECT username FROM users WHERE username = :username;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
};

// gets the email
// returns the associative array if found; returns false if not
function get_email(object $pdo, string $email) {
    $query = "SELECT email FROM users WHERE email = :email;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
};

function set_user(object $pdo, string $username, string $email, string $pwd) {
    $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $pwd);

    $stmt->execute();
};