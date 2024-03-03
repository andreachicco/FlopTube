<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once("../services/video.service.php");
        require_once("../common/constants.php");
        require_once("../common/redirector.php");
        require_once("../components/video_card.php");
        
        
        require_once("../common/head.php");
        if(!isset($_GET["id"]) && !$is_user_logged) die(change_location("auth/login.php"));

        $video_service = new video_service($db);
        set_title("Show Profile");
        ?>

        <link rel="stylesheet" href="<?php print(ROOT_PATH) ?>/assets/style/css/video-grid.css">
        <link rel="stylesheet" href="<?php print(ROOT_PATH) ?>/assets/style/css/profile.css">
</head>
<body>
    <?php 

        require_once("../common/header.php");

        $user = null;

        try {
            $user = !isset($_GET["id"]) ? 
            $user_service->find_user_profile_by_email($_SESSION["email"]) :
            $user_service->find_user_profile_by_id($_GET["id"]);
        } catch (mysqli_sql_exception $e) {
            die(change_location("error/500.php"));
        }
            
        if($user == null) die(change_location("error/404.php"));

        $profile_image = $user->get_profile_pic();
        $img_name = $profile_image ? $profile_image->get_full_name() : "default.jpeg";

    ?>

    <div class="profile-container">
        <img class="profile-pic" src="<?php print(ROOT_PATH . PROFILE_IMG_PATH . "/{$img_name}") ?>" alt="Profile Picture">
        <section class="profile-infos">
            <h3 class="profile-name profile-item"><?php print($user->get_first_name() . " " . $user->get_last_name()) ?></h3>
            <p class="profile-email profile-item"><?php print($user->get_email()) ?></p>
            <p class="profile-item"><?php print($user->get_bio()) ?></p>
            <p class="profile-date profile-item">Joined on <?php print($user->get_created_at()->format("d/m/Y")) ?></p>
            <?php 
                if(!isset($_GET["id"]) || (isset($_SESSION["id"]) && $_GET["id"] == $_SESSION["id"])) {
            ?>
                <a class="profile-item" href="<?php print(ROOT_PATH . "/user/update_profile.php") ?>"><button class="update-btn">Edit Profile</button></a>
            <?php
                } 
            ?>
        </section>
    </div>

    <hr>

    <div class="video-grid">
        <?php 
            $videos = $video_service->get_video_previews(null, $user->get_id());
            $user_has_videos = false;
            foreach($videos as $video) {
                $user_has_videos = true;
                $video_card = new video_card($video);
                $video_card->render(false);
            }

            ?>
    </div>
    
    <?php
        $user_has_videos || print("<p class=\"no-videos\">The user hasn't posted yet</p>");
        require_once("../common/footer.php");
    ?>