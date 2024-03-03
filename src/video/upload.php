<!DOCTYPE html>
<html lang="en">
<head>
    <?php 

        require_once("../services/image.service.php");
        require_once("../services/video.service.php");
        require_once("../common/redirector.php");
        require_once("../common/error_reporter.php");
        require_once("../common/error_handler.php");
        require_once("../components/error_pop_up.php");
        
        require_once("../common/head.php");

        if(!$is_user_logged) die(change_location("auth/login.php"));

        $image_service = new image_service($db);
        $video_service = new video_service($db);
        
        set_title("Upload Video");
    ?>

    <link rel="stylesheet" href="<?php print(ROOT_PATH); ?>/assets/style/css/form.css">
</head>
<body>
    <?php 
        require_once("../common/header.php");
        require_once("../common/validator.php");

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $required_fields = array("title", "desc");
            if(!validator::is_valid_array($_POST, $required_fields)) {
                error_handler::set_error("Make sure to fill in all the fields");
                die(change_location("video/upload.php"));
            }

            $new_thumbnail = $image_service->handle_file_upload("thumbnail", "video/upload.php");
            $new_video = $video_service->handle_file_upload("video", "video/upload.php");

            try {
                $db->start_transaction();

                if(!$new_thumbnail || !$new_video) {
                    error_handler::set_error("Thumbnail and video required", 500);
                    die(change_location("video/upload.php"));
                }

                $image_service->create($new_thumbnail["name"], $new_thumbnail["extension"], "thumbnail");
                $created_thumbnail = $image_service->find_thumbnail_by_full_name($new_thumbnail["name"], $new_thumbnail["extension"]);
                if(!$created_thumbnail) {
                    error_handler::set_error("An error occurred, try again", 500);
                    die(change_location("video/upload.php"));
                }
                $video_service->create($new_video["name"], $new_video["extension"], sanitizer::sanitize($_POST["title"]), sanitizer::sanitize($_POST["desc"]), $created_thumbnail);

                $db->commit();
            } catch (mysqli_sql_exception $e) {
                $db->rollback();

                error_handler::set_error("An error occurred, try again", 500);
                die(change_location("video/update.php"));

            }

            die(change_location("user/show_profile.php"));
        }
    ?>

    <div class="form-container">
        <div>
            <?php  
                (new error_pop_up())->render();
                require_once("upload_form.php"); 
            ?>
        </div>
    </div>

    <?php
        require_once("../common/footer.php");
    ?>