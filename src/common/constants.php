<?php 

    $config = file_get_contents(dirname(__FILE__) . "/config.json");
    $json = json_decode($config, true);

    define("ROOT_PATH", $json["env"] === "development" ? "" : "/~S5128817");

    define("VIDEO_PATH", "/assets/videos");
    define("THUMBNAIL_IMG_PATH",  "/assets/images/thumbnail");
    define("DEFAULT_THUMBNAIL_IMG", "default_thumbnail.svg");
    define("PROFILE_IMG_PATH",  "/assets/images/profile");
    define("DEFAULT_PROFILE_IMG", "default_profile.png");

    //cookie
    define("REMEMBER_ME_COOKIE", "remember_me");

    //DB
    define("ERR_DUP_ENTRY", 1062);

?>