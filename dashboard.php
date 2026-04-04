<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<!-- TIMER -->
<div class="timer">
    <p id="time-display">25:00</p>

    <div>
        <button id="work-btn">Work</button>
        <button id="break-btn">Break</button>
        <button id="longbreak-btn">Long Break</button>
    </div>

    <div>
        <button id="startpause-btn">Start/Pause</button>
        <button id="skip-btn">Skip</button>
    </div>
</div>

<!-- bunveng, alitaofwater -->
<?php $username = "alitaofwater"?>
<input type="hidden" form="addForm" name="username" value="<?= $username?>">

<!-- ADD TASK -->
<div class="task">
    <h3>Add Task</h3>
    <form id="addForm" action="tasks.php" method="post">
        <input type="hidden" name="action" value="add">

        <input name="task-name" type="text" placeholder="Task name..." required>

        <input name="sessions-expected" type="number" placeholder="Sessions" min="1">

        <textarea name="detail" placeholder="Description..."></textarea>

        <button type="submit">Add</button>
    </form>
</div>

<?php
require_once "includes/dbh.inc.php";

// find user_id with username
$query = "SELECT id FROM users WHERE username = :username;";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":username", $username);

$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$userId = $user["id"];

$query = "SELECT * FROM tasks WHERE user_id = :userId;";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":userId", $userId);
$stmt->execute();

foreach ($stmt as $row):
    $taskId = $row["id"];
?>

<!-- VIEW MODE -->
<div id="view-<?= $taskId ?>" class="task">
    <p><strong><?= htmlspecialchars($row["name"]) ?></strong></p>

    <p>
        <?= htmlspecialchars($row["total_sessions"]) ?> /
        <?= htmlspecialchars($row["sessions_needed"]) ?> sessions
    </p>

    <p>
        <?= htmlspecialchars($row["description"])?>
    </p>

    <button onclick="">Done</button>
    <button onclick="toggleEdit(<?= $taskId ?>)">Edit</button>
</div>

<!-- EDIT MODE -->
<div id="edit-<?= $taskId ?>" class="task" style="display:none;">
    <form action="tasks.php" method="post">
        <input type="hidden" name="action" value="update">
        <input name="task-name" type="text"
            value="<?= htmlspecialchars($row["name"]) ?>" required>

        <input name="sessions-expected" type="number"
            value="<?= htmlspecialchars($row["sessions_needed"]) ?>">

        <textarea name="details"><?= htmlspecialchars($row["description"] ?? "") ?></textarea>

        <input type="hidden" name="id" value="<?= $taskId ?>">

        <button type="submit">Save</button>
        <button type="button" onclick="toggleEdit(<?= $taskId ?>)">Cancel</button>
    </form>
    <form action="tasks.php" method="post">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value="<?= $taskId?>">
        <button type="submit">Delete</button>
    </form>
</div>

<?php endforeach; ?>

<script>

function toggleEdit(id) {
    const view = document.getElementById("view-" + id);
    const edit = document.getElementById("edit-" + id);

    const isEditing = edit.style.display === "block";

    view.style.display = isEditing ? "block" : "none";
    edit.style.display = isEditing ? "none" : "block";
}
</script>

<script src="timer.js"></script>

</body>
</html>