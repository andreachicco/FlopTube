<?php 

    class service { 
        protected db_connection $db;

        public function __construct(db_connection $db) {
            $this->db = $db;
        }

        protected function insert(mysqli_stmt $statement, callable $filter) {
            $success = $statement->execute();
            if(!$success || !$filter($statement)) throw new mysqli_sql_exception($statement->error);
        }

        private function execute_one(mysqli_stmt $statement) {
            $statement->execute();
            if($statement->affected_rows != 1) throw new mysqli_sql_exception($statement->error);
        }

        protected function select_one(mysqli_stmt $statement) {
            $statement->execute();
            $result = $statement->get_result();
            if($result->num_rows != 1) return null;
            return $result->fetch_assoc();
        }

        protected function select_multiple(mysqli_stmt $statement) {
            $statement->execute();
            $result = $statement->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        protected function insert_one(mysqli_stmt $statement){
            $this->execute_one($statement);
        }

        protected function update_one(mysqli_stmt $statement){
            $this->execute_one($statement);
        }

        protected function delete_one(mysqli_stmt $statement){
            $this->execute_one($statement);
        }

        protected function select(mysqli_stmt $statement, callable $filter): ?array {
            $success = $statement->execute();
            
            if(!$success) throw new mysqli_sql_exception($statement->error);
            
            $result = $statement->get_result();
            if(!$filter($result)) return null;

            return $result->fetch_assoc();
        }
    }

?>