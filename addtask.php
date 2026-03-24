<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskName = $_POST["task-name"];
    $sessionsNeeded = $_POST["sessions-expected"];

    try {
        // connects to database object and executes query to insert data
        require_once "includes/dbh.inc.php";

        // *** change the ID to match the user in the future
        $query = "INSERT INTO tasks (name, user_id, sessions_needed) VALUES (:taskname, 1, :sessions_needed);";

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":taskname", $taskName);
        $stmt->bindValue(":sessions_needed", $sessionsNeeded);


        $stmt->execute();

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