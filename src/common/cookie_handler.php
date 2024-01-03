<?php 
    class CookieHandler {
        public static function generate_token(int $lenght) {
            return bin2hex(random_bytes($lenght));
        }

        public static function parse_token(string $token) {
            $parts = explode(":", $token);

            if(count($parts) != 2) return null;

            return [
                "selector" => $parts[0],
                "validator" => $parts[1]
            ];
        }

        public static function generate_expiry(int $days) {
            $expired_seconds = time() + 60 * 60 * 24 * $days;
            return [date("Y-m-d H:i:s", $expired_seconds), $expired_seconds];
        }
    }
?>