<?php 
    class error_handler {
        public static function set_error(string $message, int $status_code = 400) {
            $_SESSION["error"] = json_encode(array("message" => $message, "status_code" => $status_code));
        }

        public static function has_error() {
            return isset($_SESSION["error"]);
        }

        public static function get_error() {
            $error = json_decode($_SESSION["error"], true);
            unset($_SESSION["error"]);
            return $error;
        }
    }
?>