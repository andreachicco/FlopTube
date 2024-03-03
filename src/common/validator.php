<?php 

    class validator {
        public static function is_valid_array(array $array, array $required_fields): bool {
            foreach($required_fields as $field) {
                if(!isset($array[$field])) return false;
            }

            return true;
        }
    }

?>