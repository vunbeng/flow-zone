<?php

// initialize sessions
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict', 1);

//
session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();

// session regeneration
if (!isset($_SESSION['last_regeneration'])) {
    regenerate_session_id();
} else {
    $interval = 60 * 30; // 30 minutes
    if (time() - $_SESSION['last_regeneration'] < $interval) {
        regenerate_session_id();
    }

}
// generates a session id and record the timestamp
function regenerate_session_id() {
    session_regenerate_id();
    $_SESSION['last_regeneration'] = time();
}