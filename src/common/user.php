<?php 
    class User {
        private string $firstname;
        private string $lastname;
        private string $email;
        private string $password;

        public function __construct(string $firstname, string $lastname, string $email, string $password) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }

        public function get_firstname(): string {
            return $this->firstname;
        }

        public function get_lastname(): string {
            return $this->lastname;
        }

        public function get_email(): string {
            return $this->email;
        }

        public function get_password(): string {
            return $this->password;
        }
    }
?>