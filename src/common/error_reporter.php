<?php 
    class error_reporter {
        protected static string $file_path = "/../logs/errors.log"; 

        
        public static function report(Exception $e) {
            $message = "Error: " . $e->getMessage() . " (" . $e->getCode() . ")";
            error_reporter::report_message($message);
        }

        public static function report_message(string $message) {
            $date = gmdate("Y-m-d H:i:s");
            error_log($date . " " . $message . "\n", 3, dirname(__FILE__) . static::$file_path);
        }
    }
?>