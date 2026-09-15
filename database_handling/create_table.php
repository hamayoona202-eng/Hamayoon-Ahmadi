<?php
/**
 * Part B – Create students Table
 * Connects to 'wis_lab' and creates the table.
 */
$message = '';
$alertType = '';
$dbName = 'wis_lab'; // Change if you used a different database name

try {
    // If your root has a password, set it here.
    $conn = new mysqli('localhost', 'root', 'Hamayoon123$5', $dbName);
    if ($conn->connect_error) {
        throw new Exception($conn->connect_error);
    }

    $sql = "CREATE TABLE IF NOT EXISTS students (
                id INT PRIMARY KEY AUTO_INCREMENT,
                full_name VARCHAR(100) NOT NULL,
                email VARCHAR(120) NOT NULL,
                department VARCHAR(80) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";

    if ($conn->query($sql) === TRUE) {
        $message = "Table 'students' created successfully in database '$dbName'.";
        $alertType = 'success';
    } else {
        throw new Exception($conn->error);
    }
    $conn->close();
} catch (Exception $e) {
    $message = 'Error: ' . $e->getMessage();
    $alertType = 'danger';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Students Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Part B – Create students Table</h1>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $alertType; ?> alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <p>Connecting to database: <strong><?php echo htmlspecialchars($dbName); ?></strong></p>
                <p>Click below to create the <code>students</code> table.</p>
                <form method="POST" action="">
                    <button type="submit" class="btn btn-success">Create Table</button>
                </form>
                <p class="mt-3 text-muted small"><strong>Note:</strong> If the table already exists, nothing changes.</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>