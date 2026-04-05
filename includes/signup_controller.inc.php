<?php

// validation rules:
    // all input must be filled before submitting
    // valid email
    // no same username
    // unregistered email
    // password more than 8 characters

declare(strict_types= 1);

function is_input_empty(string $username, string $pwd, string $email) {
    if (empty($username) || empty($pwd) || empty($email)) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email) {
    // returns true if the filter cannot validate the email
    // meaning it's not valid, marking the error
    return filter_var($email, FILTER_VALIDATE_EMAIL) === false;
}

function is_username_taken(object $pdo, string $username) {
    if (get_username($pdo, $username)) {
        return true;
    } else {
        return false;
    }
}

function is_email_registered(object $pdo, string $email) {
    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $username, string $pwd, string $email) {
    set_user($pdo, $username, $email, $pwd);
}