<?php 
    class DBConnection extends mysqli {
        public function __construct() {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            try {
                parent::__construct("localhost", "root", "", "floptube", 3307);
                $this->set_charset("utf8mb4");
            }
            catch(mysqli_sql_exception $e) {
                exit(header("Location: /errors/500.php"));
            }
        }
    }
?>