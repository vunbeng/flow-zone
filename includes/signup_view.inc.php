<?php

function show_errors() {
    // checks if there are any signup errors in the global variable
    if (isset($_SESSION['signup_errors'])) {
        // stores the super variable into a local one for access
        $errors = $_SESSION['signup_errors'];

        echo "<br>";

        foreach ($errors as $error) {
            echo "<p>". $error ."</p>";
        }

        unset($_SESSION["signup_errors"]);
    }
};