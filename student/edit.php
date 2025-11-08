<?php
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Edit Student';

$id = $_GET['id'] ?? '';
if ($id === '') {
    header('Location: index.php?message=Student not found.');
    exit;
}

$id = (int) $id;
$result = mysqli_query($conn, "SELECT student_id, student_name, enrollment_year FROM student WHERE student_id = $id LIMIT 1");
$student = $result ? mysqli_fetch_assoc($result) : null;

if (!$student) {
    header('Location: index.php?message=Student not found.');
    exit;
}

$name = $student['student_name'];
$year = $student['enrollment_year'];
$error = '';

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
        $sql = "UPDATE student SET student_name = '$safeName', enrollment_year = $safeYear WHERE student_id = $id";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?message=Student updated successfully.');
            exit;
        }
        $error = 'Could not update the record. Please try again.';
    }
}

require_once __DIR__ . '/../includes/header.php';
?>
<h2>Edit Student</h2>
<p style="color:#6b7280;margin-bottom:20px;">Update the student information and save.</p>
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
        <button type="submit" class="btn">Update Student</button>
    </div>
</form>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
