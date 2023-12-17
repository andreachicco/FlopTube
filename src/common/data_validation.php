<?php 
    class DataValidation {
        public static function fields_exist(array $array, array $fields) {
            
            if(count($array) < count($fields)) return false;

            foreach($fields as $field) {
                if(!isset($array[$field])) {
                    return false;
                }
            }

            return true;
        }

        public static function sanitize(string $input): string {
            return htmlspecialchars(trim($input));
        }
    }
?>