<?php 
    class User {
        private string $id;
        private string $firstname;
        private string $lastname;
        private string $email;
        private string $password;
        private string $bio;
        private string $profile_img_name;
        private int $role_id;
        private DateTime $banned_at;
        private DateTime $created_at;
        private DateTime $updated_at;

        public function __construct() {
            $arguments = func_get_args();
            $n_arguments = func_num_args();

            $constructor = method_exists($this, $f = '__construct' . $n_arguments);
            if(!$constructor) throw new Exception("Constructor with $n_arguments arguments not found in class " . get_class($this) . ".");

            call_user_func_array(array($this, $f), $arguments);
        }

        public function __construct4(string $firstname, string $lastname, string $email, string $password) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = $password;
        }

        public function __construct5(string $id, string $firstname, string $lastname, string $email, string $password) {
            $this->id = $id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = $password;
        }

        public function get_id() {
            return $this->id;
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

        public function __toString() {
            return "User: " . $this->firstname . " " . $this->lastname . " " . $this->email;
        }
    }
?>