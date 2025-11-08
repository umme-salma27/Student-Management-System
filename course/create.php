<?php
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Add Course';
$name = '';
$credits = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['course_name'] ?? '');
    $credits = trim($_POST['credits'] ?? '');

    if ($name === '' || $credits === '') {
        $error = 'Please complete all fields.';
    } elseif (!ctype_digit($credits) || (int) $credits <= 0) {
        $error = 'Credits must be a positive number.';
    } else {
        $safeName = mysqli_real_escape_string($conn, $name);
        $safeCredits = (int) $credits;
        $sql = "INSERT INTO course (course_name, credits) VALUES ('$safeName', $safeCredits)";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?message=Course added successfully.');
            exit;
        }
        $error = 'Unable to save the course. Please try again.';
    }
}

require_once __DIR__ . '/../includes/header.php';
?>
<h2>Add Course</h2>
<p style="color:#6b7280;margin-bottom:20px;">Fill in the course name and credits.</p>
<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form method="post" class="card">
    <div class="form-group">
        <label for="course_name">Course name</label>
        <input type="text" name="course_name" id="course_name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>
    <div class="form-group">
        <label for="credits">Credits</label>
        <input type="number" name="credits" id="credits" min="1" max="10" value="<?php echo htmlspecialchars($credits); ?>" required>
    </div>
    <div class="actions">
        <a class="btn secondary" href="index.php">Back</a>
        <button type="submit" class="btn">Add Course</button>
    </div>
</form>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
