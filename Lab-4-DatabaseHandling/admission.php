<?php
/**
 * Name: Hamayoon
 * ID: R01014419
 * Part two: Admission
 */

require 'db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read and trim inputs
    $full_name   = trim($_POST['full_name'] ?? '');
    $father_name = trim($_POST['father_name'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $phone       = trim($_POST['phone'] ?? '');
    $program     = trim($_POST['program'] ?? '');

    // Validate required fields
    if (empty($full_name) || empty($father_name) || empty($email) || empty($phone) || empty($program)) {
        $errors[] = "All fields are required.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // If no errors, insert using prepared statement
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO applications (full_name, father_name, email, phone, program) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            $errors[] = "Prepare failed: " . $conn->error;
        } else {
            $stmt->bind_param("sssss", $full_name, $father_name, $email, $phone, $program);
            if ($stmt->execute()) {
                $stmt->close();
                // Redirect to avoid duplicate submission on refresh
                header("Location: admission.php");
                exit;
            } else {
                $errors[] = "Insert failed: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

// ------------------------------------------------------------------
// Fetch all applications (newest first) – always executed
// ------------------------------------------------------------------
$sql = "SELECT * FROM applications ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Admission Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Student Admission Application</h1>

        <!-- Display validation errors -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Admission Form -->
        <div class="card mb-5">
            <div class="card-header bg-primary text-white">
                Application Form
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required
                                   value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="father_name" class="form-label">Father's Name</label>
                            <input type="text" class="form-control" id="father_name" name="father_name" required
                                   value="<?php echo htmlspecialchars($_POST['father_name'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                   value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required
                                   value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="program" class="form-label">Program</label>
                        <select class="form-select" id="program" name="program" required>
                            <option value="" disabled <?php echo empty($_POST['program']) ? 'selected' : ''; ?>>-- Select Program --</option>
                            <option value="Information Systems" <?php echo (($_POST['program'] ?? '') === 'Information Systems') ? 'selected' : ''; ?>>Information Systems</option>
                            <option value="Software Engineering" <?php echo (($_POST['program'] ?? '') === 'Software Engineering') ? 'selected' : ''; ?>>Software Engineering</option>
                            <option value="Computer Science" <?php echo (($_POST['program'] ?? '') === 'Computer Science') ? 'selected' : ''; ?>>Computer Science</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Application</button>
                </form>
            </div>
        </div>

        <!-- Submitted Applications Table -->
        <h2 class="mb-3">Submitted Applications</h2>
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Father's Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Program</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['father_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td><?php echo htmlspecialchars($row['program']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">No applications submitted yet.</div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>