<?php 
    class sanitizer {

        public static function sanitize_array(array $input) {
            $sanitized = array();
            foreach($input as $key => $value) {
                $sanitized[$key] = self::sanitize($value);
            }
            return $sanitized;
        } 

        public static function sanitize($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
    }
?>