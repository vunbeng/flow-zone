<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <!-- timer -->
        <div class="timer">
            <div class="timer__time">
                <p id="time-display">00:00</p>
            </div>
            <div class="timer__types">
                <button id="work-btn">Work</button>
                <button id="break-btn">Break</button>
                <button id="longbreak-btn">Long Break</button>
            </div>
            <div class="timer__buttons">
                <button id="startpause-btn">Start/Pause</button>
                <button id="skip-btn">Skip</button>
            </div>
        </div>

        <?php echo "logged in as bunveng";?>

        <!-- tasks list -->
        <div class="task">
            <form action="addtask.php" method="post">
                <input name="task-name" type="text" placeholder="Task name...">
                <div class="task-card__estimated-sessions">
                    <label for="sessions-expected">Estimated Sessions</label>
                    <input name="sessions-expected" type="number"  placeholder="1">
                </div>

                <textarea name="details" type="details" placeholder="Description..."></textarea>
                <button type="submit">Add task</button>
            </form>
            
        </div>
        <?php 
            require_once "includes/dbh.inc.php";

            $query = "SELECT * FROM tasks;";

            $stmt = $pdo->prepare($query);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                
                echo "<div class='task'>";

                echo "<div class='task__task-name'>";
                echo "<p>" . $row["name"] . "</p>";
                echo "</div>";

                echo "<div class='task__sessions-needed'>";
                echo "<p>Sessions</>";
                echo "<p >" . $row["total_sessions"] . " / " . $row["sessions_needed"] . "</p>";
                echo "</div>";

                echo "<button>Done?</button>";
                
                echo "</div>";
            }
        ?>
        <script src="timer.js"></script>

    </body>
</html>