<?php 
    class Table {
        protected DBConnection $db;

        public function __construct(DBConnection $db) {
            $this->db = $db;
        }
    }
?>