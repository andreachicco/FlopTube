<?php 
    class cookie {
        private int $id;
        private string $selector;   
        private string $validator;
        private string $user_id;
        private DateTime $expiry;

        public function __construct(
            int $id,
            string $selector,
            string $validator,
            string $user_id,
            DateTime $expiry
        ) {
            $this->id = $id;
            $this->selector = $selector;
            $this->validator = $validator;
            $this->user_id = $user_id;
            $this->expiry = $expiry;
        }

        public function get_id() {
            return $this->id;
        }

        public function get_selector() {
            return $this->selector;
        }

        public function get_validator() {
            return $this->validator;
        }

        public function get_user_id() {
            return $this->user_id;
        }

        public function get_expiry() {
            return $this->expiry;
        }
    }
?>