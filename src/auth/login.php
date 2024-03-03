<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once("../common/redirector.php");
        require_once("../components/error_pop_up.php");

        
        require_once("../common/head.php");
        if($is_user_logged) die(change_location(""));

        set_title("Login");
    ?>

    <link rel="stylesheet" href="<?php print(ROOT_PATH); ?>/assets/style/css/auth-form.css">
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once("../common/validator.php");

            $required_fields = array("email", "pass");
            if(!validator::is_valid_array($_POST, $required_fields)) {
                error_handler::set_error("Make sure to fill in all the fields");
                die(change_location("auth/login.php"));
            }

            $auth_service->sign_in();
        }

        require_once("../common/header.php");
    ?>

    <div class="form-container">
        <div>
            <h1 class="form-title">Login</h1>
            <?php  
                (new error_pop_up())->render();
                require_once("login_form.php"); 
            ?>
        </div>
    </div>
        
    <?php
        require_once("../common/footer.php");
    ?>