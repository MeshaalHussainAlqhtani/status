 CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    status TINYINT(1) DEFAULT 0
);
<?php
$host = 'localhost';
$db   = 'your_database_name';
$user = 'your_username';
$pass = 'your_password';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['age'])) {
        $stmt = $pdo->prepare("INSERT INTO users (name, age) VALUES (?, ?)");
        $stmt->execute([$_POST['name'], $_POST['age']]);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

    // Fetch all users
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("DB error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form input { margin-right: 10px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        .toggle { cursor: pointer; padding: 5px 10px; background: #007bff; color: white; border: none; }
    </style>
</head>
<body>

<h2>User Entry Form</h2>
<form method="POST">
    <input type="text" name="name" required placeholder="Name">
    <input type="number" name="age" required placeholder="Age">
    <button type="submit">Submit</button>
</form>

<h3>Users Table</h3>
<table>
    <thead>
        <tr><th>ID</th><th>Name</th><th>Age</th><th>Status</th><th>Toggle</th></tr>
    </thead>
    <tbody id="userTable">
        <?php foreach ($users as $user): ?>
            <tr id="row-<?= $user['id'] ?>">
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= $user['age'] ?></td>
                <td class="status"><?= $user['status'] ?></td>
                <td><button class="toggle" onclick="toggleStatus(<?= $user['id'] ?>)">Toggle</button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
function toggleStatus(userId) {
    fetch('toggle.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'id=' + userId
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.querySelector(`#row-${userId} .status`).textContent = data.new_status;
        }
    });
}
</script>

</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $host = 'localhost';
    $db   = 'your_database_name';
    $user = 'your_username';
    $pass = 'your_password';
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);

        $id = (int)$_POST['id'];
        $stmt = $pdo->prepare("SELECT status FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $newStatus = $user['status'] == 1 ? 0 : 1;
            $stmt = $pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
            $stmt->execute([$newStatus, $id]);

            echo json_encode(['success' => true, 'new_status' => $newStatus]);
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'DB Error']);
    }
}
