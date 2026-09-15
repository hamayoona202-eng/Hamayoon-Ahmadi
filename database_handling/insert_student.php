<?php
/**
 * Part C – Insert Student (with Prepared Statement – Challenge)
 */
$message = '';
$alertType = '';
$formData = ['full_name' => '', 'email' => '', 'department' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName   = trim($_POST['full_name']);
    $email      = trim($_POST['email']);
    $department = trim($_POST['department']);

    if (empty($fullName) || empty($email) || empty($department)) {
        $message = 'All fields are required.';
        $alertType = 'danger';
        $formData = ['full_name' => $fullName, 'email' => $email, 'department' => $department];
    } else {
        $dbName = 'wis_lab'; // Change if you used a different database name
        try {
            // If your root has a password, set it here.
            $conn = new mysqli('localhost', 'root', 'Hamayoon123$5', $dbName);
            if ($conn->connect_error) {
                throw new Exception($conn->connect_error);
            }

            // Prepared statement
            $stmt = $conn->prepare("INSERT INTO students (full_name, email, department) VALUES (?, ?, ?)");
            if ($stmt === false) {
                throw new Exception($conn->error);
            }
            $stmt->bind_param('sss', $fullName, $email, $department);
            if ($stmt->execute()) {
                $message = "Student '$fullName' added successfully.";
                $alertType = 'success';
                $formData = ['full_name' => '', 'email' => '', 'department' => '']; // clear form
            } else {
                throw new Exception($stmt->error);
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            $message = 'Error: ' . $e->getMessage();
            $alertType = 'danger';
            $formData = ['full_name' => $fullName, 'email' => $email, 'department' => $department];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Part C – Insert Student Record</h1>

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
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name"
                               value="<?php echo htmlspecialchars($formData['full_name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="<?php echo htmlspecialchars($formData['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control" id="department" name="department"
                               value="<?php echo htmlspecialchars($formData['department']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Student</button>
                    <button type="reset" class="btn btn-secondary">Clear</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>