<?php 

    require_once(dirname(__FILE__) . "/../models/video.php");
    require_once(dirname(__FILE__) . "/../common/date_converter.php");

    class video_card {

        private video_preview $video_preview;

        public function __construct(video_preview $video_preview) {
            $this->video_preview = $video_preview;
        }

        private function trim_title() {
            $title = $this->video_preview->get_title();
            if(strlen($title) > 18) {
                $title = substr($title, 0, 18) . "...";
            }
            return $title;
        }
        
        public function render(bool $render_author = true) {
            $video = $this->video_preview;
            $elapsed_time = date_converter::get_elapsed_time($video->get_upload_date());
            ?>
                <div class="video-preview">
                    <a href="<?php print(ROOT_PATH . "/video/show_video.php?id=" . $video->get_id()); ?>">
                        <div class="thumbnail">
                            <img src="<?php print(ROOT_PATH . THUMBNAIL_IMG_PATH . "/" . $video->get_thumbnail()->get_name() . "." . $video->get_thumbnail()->get_extension()); ?>" alt="<?php print($video->get_title()) ?> thumbnail">
                            <p class="upload-time"><?php print($elapsed_time); ?></p>
                        </div>
                        <h3 class="video-title"><?php print($this->trim_title()); ?></h3>
                        <p class="title-pop-up display-none"><?php print($this->video_preview->get_title()); ?></p>
                    </a>
                    <?php if($render_author) { ?>
                        <a class="author" href="<?php print(ROOT_PATH . "/user/show_profile.php?id=" . $video->get_author()->get_id()); ?>">
                            <div class="profile-picture">
                                <img src="<?php print(ROOT_PATH . PROFILE_IMG_PATH . "/" . $video->get_author()->get_profile_pic()->get_name() . "." . $video->get_author()->get_profile_pic()->get_extension()); ?>" alt="profile picture">
                            </div>
                            <p><?php print($video->get_author()->get_first_name() . " " . $video->get_author()->get_last_name()); ?></p>
                        </a> <?php } ?>
                </div>
            <?php
        }
    }
?>