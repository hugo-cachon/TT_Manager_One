<?php 

    class Tasks {

        private $table = "task";
        private $connexion;

        public $id;
        public $user_id;
        public $title;
        public $creation_date;
        public $status;
        public $description;

        public function __construct($db)
        {
            $this->connexion = $db;
        }

        public function getAllTasks() 
        {
            $stmt = "SELECT * FROM " . $this->table . "";
    
            $query = $this->connexion->prepare($stmt);
    
            $query->execute();
    
            return $query;
        }

        public function getTaskById()
        {
            $stmt = "SELECT id, user_id, title, description, date FROM " . $this->table . " WHERE id =:id ";
    
            $query = $this->connexion->prepare($stmt);
            
            $query->bindParam(":id", $this->id);
            
            $query->execute();
    
            $row = $query->fetch(PDO::FETCH_ASSOC);
    
            $this->id = $row['id'];
            $this->user_id = $row['user_id'];
            $this->title = $row['title'];
            $this->description = $row['description'];
            $this->creation_date = $row['date'];
        
        }

        public function createTask()
        {
            $stmt = "INSERT INTO " . $this->table . " (id, user_id, title, description, date)
            VALUES (:id, :user_id, :title, :description, :date)";
    
            $query = $this->connexion->prepare($stmt);
    
            $query->bindParam(":id", $this->id);
            $query->bindParam(":user_id", $this->user_id);
            $query->bindParam(":title", $this->title);
            $query->bindParam(":description", $this->description);
            $query->bindParam(":date", date("Y-m-d"));
    
            if($query->execute())
            {
                return true;
            }
            return false;
        }

        public function updateTask()
        {
            $stmt = "UPDATE " . $this->table . " SET title=:title, description=:description WHERE id=:id ";
    
            $query = $this->connexion->prepare($stmt);
    
            $query->bindParam(":title", $this->title);
            $query->bindParam(":description", $this->description);
            $query->bindParam(":id", $this->id);
            
    
            if($query->execute())
            {
                return true;
            }
            return false;
    
        }
        public function deleteTask(){

            $stmt = "DELETE FROM " . $this->table . " WHERE id = ?";
    
            $query = $this->connexion->prepare($stmt);
    
            $query->bindParam(1, $this->id);
    
            if($query->execute())
            {
                return true;
            }        
            return false;
        }

    }

?>
