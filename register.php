<?php 
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';

?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h3>Sign up</h3>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="text" name="email" placeholder="E-mail">
            <input type="password" name="pwd" placeholder="Password">


            <button>Sign Up</button>
        </form>
        <?php show_errors() ?>
    </body>
</html>