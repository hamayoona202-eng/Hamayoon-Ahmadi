<?php
/**
 * Part A – Create Database
 * Uses MySQLi Object-Oriented with exception handling.
 */
$message = '';
$alertType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $databaseName = trim($_POST['database_name']);

    // Validate: only letters, numbers, underscores
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $databaseName)) {
        $message = 'Invalid database name. Only letters, numbers, underscores allowed.';
        $alertType = 'danger';
    } else {
        try {
            // Connect to MySQL (no database selected)
            // If your root has a password, set it here (e.g., 'your_password')
            $conn = new mysqli('localhost', 'root', 'Hamayoon123$5');

            // If using exception mode, this line won't be reached on failure.
            // But we check anyway.
            if ($conn->connect_error) {
                throw new Exception($conn->connect_error);
            }

            $sql = "CREATE DATABASE IF NOT EXISTS `$databaseName`";
            if ($conn->query($sql) === TRUE) {
                $message = "Database '$databaseName' created successfully (or already exists).";
                $alertType = 'success';
                // Store in session for later use (optional)
                session_start();
                $_SESSION['db_name'] = $databaseName;
            } else {
                throw new Exception($conn->error);
            }
            $conn->close();
        } catch (Exception $e) {
            $message = 'Error: ' . $e->getMessage();
            $alertType = 'danger';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Part A – Create Database</h1>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $alertType; ?> alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="database_name" class="form-label">Database Name</label>
                        <input type="text" class="form-control" id="database_name" name="database_name"
                               placeholder="e.g., wis_lab" required
                               pattern="[A-Za-z0-9_]+"
                               title="Only letters, numbers, and underscores allowed.">
                        <div class="form-text">Allowed: letters, numbers, underscores.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Database</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>