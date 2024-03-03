<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once("components/video_card.php");
        require_once("components/search_form.php");
        require_once("services/video.service.php");

        require_once("common/head.php");
        set_title("Home");

        $video_service = new video_service($db);
    ?>

    <link rel="stylesheet" href="<?php print(ROOT_PATH) ?>/assets/style/css/video-grid.css">
</head>
<body>
    <?php require_once("common/header.php"); ?>
    <div class="mobile-search search">
        <?php (new search_form())->render(); ?>
    </div>
    
    <div class="video-grid">
        <?php 
            $search = isset($_GET["search"]) ? sanitizer::sanitize($_GET["search"]) : null;

            $videos_found = false;
            $videos = $video_service->get_video_previews($search);
            foreach($videos as $video) {
                $videos_found = true;
                $video_card = new video_card($video);
                $video_card->render();
            }
        ?>
    </div>

    <?php 
        if(!$videos_found) {
            print("<h1 class=\"no-video\">No videos found</h1>");
        }

        require_once("common/footer.php"); 
    ?>