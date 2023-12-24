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

        public static function check_code() {
            if(isset($_GET["code"])) {
                $code = $_GET["code"];
                require_once(dirname(__FILE__) . "/../components/alert_box.php");
                require_once(dirname(__FILE__) . "/../common/status_codes.php");

                $status = StatusCode::get((int)$code);
                $alertBox = new AlertBox($status->get_message(), $status->get_color());
                $alertBox->render();
            }
        }
    }
?>