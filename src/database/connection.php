<?php 
    class DBConnection extends mysqli {
        public function __construct() {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            parent::__construct("localhost", "root", "", "floptube", 3307);
            $this->set_charset("utf8mb4");
        }
    }
?>