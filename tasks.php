<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    $username = $_POST["username"];

    try {
        // connects to database object and executes query to insert data
        require_once "includes/dbh.inc.php";

        // *** change the ID to match the user in the future
        if ($action === "add") {
            $taskName = $_POST["task-name"];
            $sessionsNeeded = $_POST["sessions-expected"];
            $id = $_POST["id"];
            $description = $_POST["detail"];

            // find user_id with username
            $query = "SELECT id FROM users WHERE username = :username;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":username", $username);

            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $userId = $user["id"];
            

            if (empty($id)) {
                $query = "INSERT INTO tasks (name, user_id, sessions_needed, description) VALUES (:taskname, :user_id, :sessions_needed, :description);";

                $stmt = $pdo->prepare($query);
                $stmt->bindValue(":taskname", $taskName);
                $stmt->bindValue(":sessions_needed", $sessionsNeeded);
                $stmt->bindValue(":user_id", $userId);
                $stmt->bindValue(":description", $description);


                $stmt->execute();
            } else {
                $query = "INSERT INTO tasks (name, user_id, sessions_needed, id) VALUES (:taskname, 1, :sessions_needed, :id);";

                $stmt = $pdo->prepare($query);
                $stmt->bindValue(":taskname", $taskName);
                $stmt->bindValue(":sessions_needed", $sessionsNeeded);
                $stmt->bindValue(":id", $id);


                $stmt->execute();
            }

        } else if ($action === "update") {
            $taskName = $_POST["task-name"];
            $sessionsNeeded = $_POST["sessions-expected"];
            $description = $_POST["details"];
            $id = (int) $_POST["id"];

            $query = "UPDATE tasks  SET name = :taskName, sessions_needed = :sessionsNeeded, description = :description WHERE id = :id;";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":taskName", $taskName);
            $stmt->bindValue(":sessionsNeeded", $sessionsNeeded);
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":description", $description);

            $stmt->execute();
        } else if ($action === "delete") {
            $id = (int) $_POST["id"];

            $query = "DELETE FROM tasks WHERE id = :id;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
        }
        
        

        $pdo=null;
        $stmt=null;

        header("Location: ./dashboard.php");
        
        die();


    } catch (\PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    
} else {
    echo "";
};