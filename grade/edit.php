<?php
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Edit Grade';

$id = $_GET['id'] ?? '';
if ($id === '') {
    header('Location: index.php?message=Grade not found.');
    exit;
}

$id = (int) $id;
$gradeResult = mysqli_query($conn, "SELECT grade_id, enrollment_id, grade FROM grade WHERE grade_id = $id LIMIT 1");
$grade = $gradeResult ? mysqli_fetch_assoc($gradeResult) : null;

if (!$grade) {
    header('Location: index.php?message=Grade not found.');
    exit;
}

$enrollmentId = $_POST['enrollment_id'] ?? $grade['enrollment_id'];
$gradeValue = $_POST['grade'] ?? $grade['grade'];
$error = '';

$enrollmentsQuery = mysqli_query(
    $conn,
    'SELECT e.enrollment_id, s.student_name, c.course_name
     FROM enrollment e
     JOIN student s ON e.student_id = s.student_id
     JOIN course c ON e.course_id = c.course_id
     ORDER BY s.student_name, c.course_name'
);
$enrollments = $enrollmentsQuery ? mysqli_fetch_all($enrollmentsQuery, MYSQLI_ASSOC) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($enrollmentId === '') {
        $error = 'Please choose an enrollment.';
    } else {
        $gradeValue = strtoupper(trim($gradeValue));
        if ($gradeValue === '') {
            $error = 'Grade value is required.';
        } elseif (!preg_match('/^[A-F][+-]?$/', $gradeValue)) {
            $error = 'Grade must be like A, B+, C-, etc.';
        }
    }

    if ($error === '') {
        $safeEnrollment = (int) $enrollmentId;
        $safeGrade = mysqli_real_escape_string($conn, $gradeValue);
        $sql = "UPDATE grade SET enrollment_id = $safeEnrollment, grade = '$safeGrade' WHERE grade_id = $id";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?message=Grade updated successfully.');
            exit;
        }
        $error = 'Could not update the grade. Please try again.';
    }
}

require_once __DIR__ . '/../includes/header.php';
?>
<h2>Edit Grade</h2>
<p style="color:#6b7280;margin-bottom:20px;">Update the grade information and save.</p>
<?php if (!$enrollments): ?>
    <div class="alert alert-warning">Please create at least one enrolment before editing grades.</div>
<?php else: ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="post" class="card">
        <div class="form-group">
            <label for="enrollment_id">Enrollment</label>
            <select name="enrollment_id" id="enrollment_id" required>
                <option value="">-- Select enrollment --</option>
                <?php foreach ($enrollments as $enrollment): ?>
                    <option value="<?php echo htmlspecialchars($enrollment['enrollment_id']); ?>" <?php echo ($enrollmentId == $enrollment['enrollment_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($enrollment['student_name'] . ' — ' . $enrollment['course_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="grade">Grade</label>
            <input type="text" name="grade" id="grade" maxlength="2" value="<?php echo htmlspecialchars(strtoupper($gradeValue)); ?>" required>
            <small style="color:#6b7280;">Accepted values: A, B+, C-, etc.</small>
        </div>
        <div class="actions">
            <a class="btn secondary" href="index.php">Back</a>
            <button type="submit" class="btn">Update Grade</button>
        </div>
    </form>
<?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
