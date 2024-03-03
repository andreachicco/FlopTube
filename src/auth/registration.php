<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once("../common/redirector.php");
        require_once("../components/error_pop_up.php");
        
        
        require_once("../common/head.php");
        if($is_user_logged) die(change_location(""));
        set_title("Register");
    ?>

    <link rel="stylesheet" href="<?php print(ROOT_PATH); ?>/assets/style/css/auth-form.css">
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once("../common/validator.php");

            $required_fields = array("firstname", "lastname", "email", "pass", "confirm");
            if(!validator::is_valid_array($_POST, $required_fields)) {
                error_handler::set_error("Make sure to fill in all the fields");
                die(change_location("auth/registration.php")); 
            }

            $is_email_valid = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
            if(!$is_email_valid) {
                error_handler::set_error("Invalid email format", 400);
                die(change_location("auth/registration.php"));
            }

            if($_POST["pass"] != $_POST["confirm"]) {
                error_handler::set_error("Passwords do not match", 400);
                die(change_location("auth/registration.php"));
            }

            $is_password_valid = preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $_POST["pass"]);
            if(!$is_password_valid) {
                error_handler::set_error("Password must contain at least 8 characters, one uppercase letter, one lowercase letter, one number and one special character", 400);
                die(change_location("auth/registration.php"));
            }

            $auth_service->sign_up();
        }

        require_once("../common/header.php");
    
    ?>

    <div class="form-container">
        <div>
            <h1 class="form-title">Register</h1>
            <?php  
                (new error_pop_up())->render();
                require_once("registration_form.php"); 
            ?>
        </div>
    </div>
    
    <?php
        require_once("../common/footer.php");
    ?>