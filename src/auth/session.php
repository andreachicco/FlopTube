<?php 
    class Session {
        private string $id;
        private string $email;
        private string $firstname;
        private string $lastname;

        public function __construct(string $id, string $email, string $firstname, string $lastname) {
            $this->id = $id;
            $this->email = $email;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
        }

        public function get_id(): string {
            return $this->id;
        }

        public function get_email(): string {
            return $this->email;
        }

        public function get_firstname(): string {
            return $this->firstname;
        }

        public function get_lastname(): string {
            return $this->lastname;
        }

        public function get_fields(): array {
            return [
                "id" => $this->id,
                "email" => $this->email,
                "firstname" => $this->firstname,
                "lastname" => $this->lastname
            ];
        }
    }
?>