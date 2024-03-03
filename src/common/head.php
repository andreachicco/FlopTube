<?php

    require_once(dirname(__FILE__) . "/constants.php");
    require_once(dirname(__FILE__) . "/../models/database.php");
    require_once(dirname(__FILE__) . "/../services/user.service.php");
    require_once(dirname(__FILE__) . "/../services/cookie.service.php");
    require_once(dirname(__FILE__) . "/../services/auth.service.php");       
    
    session_start();

    $db = new db_connection();

    $user_service = new user_service($db);
    $cookie_service = new cookie_service($db);
    $auth_service = new auth_service($user_service, $cookie_service);

    $is_user_logged = $auth_service->is_user_logged();

    function set_title(string $title) {
        print("<title>FlopTube | $title</title>");
    }
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php print(ROOT_PATH) ?>/assets/images/floptube_logo.svg">
<link rel="stylesheet" href="<?php print(ROOT_PATH) ?>/assets/style/css/common.css">
<script src="https://kit.fontawesome.com/1bf282f4e1.js" crossorigin="anonymous"></script>