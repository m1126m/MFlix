<?php

require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");
require_once("includes/config.php");

$account = new Account($con);

    if(isset($_POST["submitButton"])) {
       
        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

        $success = $account->login($username,$password);

        if($success){
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Netflix</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
    </head>
    <body>
       <div class="signInContainer">
       
        <div class="column">
       
            <div class="header">
                <img src="assets/images/logo.png" title="Logo" alt="Site logo"/>
                <h3>Sign In</h3>
                <span>to continue to Mflix</span>
            </div>

            <form method="POST">
                <?php echo $account->getError(Constants::$loginFailed); ?>
                <input type="text" name="username" placeholder="User name" required>

                <input type="password" name="password" placeholder="Password" required>
                
                <input type="submit" name="submitButton" value="SUBMIT">

            </form>

            <a href="register.php" class="signInMessage">Need an account? Sign up here</a>

        </div>
       </div>
    </body>
</html>