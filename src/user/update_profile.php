<!DOCTYPE html>
<html lang="en">
<head>
    <?php 

        require_once("../services/image.service.php");
        require_once("../common/redirector.php");
        require_once("../common/error_reporter.php");
        require_once("../common/error_handler.php");
        require_once("../components/error_pop_up.php");
        
        require_once("../common/head.php");

        if(!$is_user_logged) die(change_location("auth/login.php"));
        $image_service = new image_service($db);
        
        set_title("Update Profile");
    ?>

    <link rel="stylesheet" href="<?php print(ROOT_PATH); ?>/assets/style/css/form.css">
</head>
<body>
    <?php 
        require_once("../common/header.php");
        require_once("../common/validator.php");

        function are_fields_equal(array $fields, array $values) {
            foreach($fields as $key => $value) {
                if($value !== $values[$key] && $key !== "submit") return false;
            }

            return true;
        }

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $required_fields = array("firstname", "lastname");
            if(!validator::is_valid_array($_POST, $required_fields)) {
                error_handler::set_error("Make sure to fill in all the fields");
                die(change_location("user/update_profile.php"));
            }

            $new_file = $image_service->handle_file_upload("profile-pic", "user/update_profile.php");

            try {
                $db->start_transaction();
                if(!are_fields_equal($_POST, $_SESSION)) $user_service->update_user_profile(sanitizer::sanitize_array($_POST));

                if($new_file) {
                    if($_SESSION["img_name"] === DEFAULT_PROFILE_IMG)  {
                        $image_service->create($new_file["name"], $new_file["extension"], "profile");
                        $user_service->update_user_image($new_file["name"], $_SESSION["id"]);
                    }
                    else {
                        $image_service->update_by_name($_SESSION["img_name"], $new_file);
                        
                        if(!unlink(dirname(__FILE__ ) . "/.." . PROFILE_IMG_PATH . "/" . $_SESSION["img_name"])) {
                            $message = "Error: cannot delete file " . dirname(__FILE__) . "/.." . PROFILE_IMG_PATH . "/" . $_SESSION["img_name"];
                            error_reporter::report_message($message);
                            $db->rollback();

                            error_handler::set_error("An error occurred, try again", 500);
                            die(change_location("user/update_profile.php"));
                        }
                    }
                    
                }

                $final_user = $user_service->find_one_by_id($_SESSION["id"]);
                $db->commit();

                //session reset
                $auth_service->init_session($final_user);

            } catch (mysqli_sql_exception $e) {
                $db->rollback();

                $error_code = $e->getCode();

                switch($error_code) {
                    case ERR_DUP_ENTRY:
                        error_handler::set_error("Email already exists", 409);
                        break;
                    default:
                        error_handler::set_error("An error occurred, try again", 500);
                }

                die(change_location("user/update_profile.php"));

            }

            die(change_location("user/show_profile.php"));
        }
    ?>

    <div class="form-container">
        <div>
            <?php  
                (new error_pop_up())->render();
                require_once("update_form.php"); 
            ?>
        </div>
    </div>

    <?php
        require_once("../common/footer.php");
    ?>