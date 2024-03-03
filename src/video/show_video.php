<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once("../services/video.service.php");
        require_once("../common/constants.php");
        require_once("../common/redirector.php");
        require_once("../components/video_card.php");
        
        require_once("../common/head.php");
        $video_service = new video_service($db);
        
        if(!isset($_GET["id"])) die(change_location(ROOT_PATH));
        $video_id = $_GET["id"];

        $video = $video_service->get_video_by_id($video_id);
        if($video == null) die(change_location(ROOT_PATH));

        set_title($video->get_title());
        ?>

    <link rel="stylesheet" href="<?php print(ROOT_PATH . "/assets/style/css/show-video.css"); ?>">
</head>
<body>
    <?php 
        require_once("../common/header.php");


        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["comment"])) {
                if($is_user_logged) {
                    $sanitized_comment = sanitizer::sanitize($_POST["comment"]);
                    $video_service->create_comment($sanitized_comment, $video_id);
                }
                else die(change_location(ROOT_PATH . "/auth/login.php"));
            }
        }
        
    ?>

    <main>
        <section id="video-section">

            <div class="video-container">
                <video controls>
                    <source src="<?php print(ROOT_PATH . VIDEO_PATH . "/" . $video->get_name() . "." . $video->get_extension()); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="video-info">
                <h1><?php print($video->get_title()); ?></h1>
                <a href="<?php print(ROOT_PATH . "/user/show_profile.php?id=" . $video->get_author()->get_id()); ?>" class="author">
                    <div class="profile-picture">
                        <img src="<?php print(ROOT_PATH . PROFILE_IMG_PATH . "/" . $video->get_author()->get_profile_pic()->get_name() . "." . $video->get_author()->get_profile_pic()->get_extension()); ?>" alt="profile picture">
                    </div>
                    <p><?php print($video->get_author()->get_first_name() . " " . $video->get_author()->get_last_name()); ?></p>
                </a>
                <div class="description-container">
                    <p class="description"><?php print($video->get_description()); ?></p>
                </div>
            </div>
        </section>
        <section class="comments-section">
            <button class="load-comments-btn" value="load comments">Load Comments</button>

            <?php if($is_user_logged) {?>
                <form class="comment-form" action="<?php print(ROOT_PATH); ?>/video/show_video.php?id=<?php print($video_id); ?>" method="post">
                    <input type="text" name="comment" placeholder="Add a comment" aria-label="add comment">
                </form>
            <?php } ?>

            <div class="comments-container">
                
            </div>
        </section>
    </main>
    
    <script src="<?php print(ROOT_PATH . "/assets/js/load-comments.js"); ?>"></script>
    <?php
        require_once("../common/footer.php");
    ?>