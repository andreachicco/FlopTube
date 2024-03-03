<?php 

    require_once(dirname(__FILE__) . "/../common/error_reporter.php");

    class db_connection {
        protected mysqli $connection;

        public function __construct() {
            $credentials = file_get_contents(dirname(__FILE__) . "/credentials.json");
            $json = json_decode($credentials, true);
            
            // Set the error reporting level to throw exceptions
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            try {
                $this->connection = new mysqli($json["host"], $json["username"], $json["password"], $json["database"], $json["port"]);
                $this->connection->set_charset('utf8');
            } catch (mysqli_sql_exception $e) {
                error_reporter::report($e);
                die(header("Location: error/400.php"));
            }
        }

        public function start_transaction() {
            $this->connection->begin_transaction();
        }

        public function commit() {
            $this->connection->commit();
        }

        public function rollback() {
            $this->connection->rollback();
        }

        public function get_connection() {
            return $this->connection;
        }

        public function __destruct() {
            $this->connection->close();
        }
    }
?> 