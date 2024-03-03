<?php

    require_once(dirname(__FILE__) . "/../common/constants.php");

    function change_location($location) {
        header("Location: " . ROOT_PATH . "/" . $location);
    }
?>