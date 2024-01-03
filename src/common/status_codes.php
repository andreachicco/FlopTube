<?php 

    require_once("alert_type.php");

    class Status {
        protected string $message;
        protected string $type;
        protected string $color;
        
        public function __construct(string $message, string $type) {
            $this->message = $message;
            $this->type = $type;
        }

        public function get_message(): string {
            return $this->message;
        }

        public function get_type(): string {
            return $this->type;
        }

        public function get_color(): string {
            return $this->color;
        }
    }

    class ErrorStatus extends Status {
        public function __construct(string $message) {
            parent::__construct($message, "error");
            $this->color = AlertType::ERROR;
        }
    }

    class StatusCode {
        public static function get(int $code) {
            $codes = array(
                0 => new ErrorStatus("Something went wrong"),
                1 => new ErrorStatus("Email already in use"),
                2 => new ErrorStatus("Passwords do not match"),
                3 => new ErrorStatus("Please fill in all fields"),
                4 => new ErrorStatus("Invalid email or password"),
            );

            return $codes[$code];
        }
    }
?>