<?php
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Add Student';
$error = '';
$name = '';
$year = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['student_name'] ?? '');
    $year = trim($_POST['enrollment_year'] ?? '');

    if ($name === '' || $year === '') {
        $error = 'Please fill in every field.';
    } elseif (!preg_match('/^\d{4}$/', $year)) {
        $error = 'Enrollment year must be a 4-digit year.';
    } else {
        $safeName = mysqli_real_escape_string($conn, $name);
        $safeYear = (int) $year;
        $sql = "INSERT INTO student (student_name, enrollment_year) VALUES ('$safeName', $safeYear)";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?message=Student added successfully!');
            exit;
        }
        $error = 'Something went wrong. Please try again.';
    }
}

require_once __DIR__ . '/../includes/header.php';
?>
<h2>Add Student</h2>
<p style="color:#6b7280;margin-bottom:20px;">Enter the student information below.</p>
<?php if (isset($_GET['message'])): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($_GET['message']); ?></div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form method="post" class="card">
    <div class="form-group">
        <label for="student_name">Student name</label>
        <input type="text" name="student_name" id="student_name" value="<?php echo htmlspecialchars($name); ?>" required>
    </div>
    <div class="form-group">
        <label for="enrollment_year">Enrollment year</label>
        <input type="number" name="enrollment_year" id="enrollment_year" min="2000" max="2099" value="<?php echo htmlspecialchars($year); ?>" required>
    </div>
    <div class="actions">
        <a class="btn secondary" href="index.php">Back</a>
        <button type="submit" class="btn">Add Student</button>
    </div>
</form>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
