<?php
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Edit Enrolment';

$id = $_GET['id'] ?? '';
if ($id === '') {
    header('Location: index.php?message=Enrolment not found.');
    exit;
}

$id = (int) $id;
$result = mysqli_query($conn, "SELECT enrollment_id, student_id, course_id FROM enrollment WHERE enrollment_id = $id LIMIT 1");
$enrolment = $result ? mysqli_fetch_assoc($result) : null;

if (!$enrolment) {
    header('Location: index.php?message=Enrolment not found.');
    exit;
}

$studentId = $_POST['student_id'] ?? $enrolment['student_id'];
$courseId = $_POST['course_id'] ?? $enrolment['course_id'];
$error = '';

$studentsRes = mysqli_query($conn, 'SELECT student_id, student_name FROM student ORDER BY student_name');
$students = $studentsRes ? mysqli_fetch_all($studentsRes, MYSQLI_ASSOC) : [];

$coursesRes = mysqli_query($conn, 'SELECT course_id, course_name FROM course ORDER BY course_name');
$courses = $coursesRes ? mysqli_fetch_all($coursesRes, MYSQLI_ASSOC) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($studentId === '' || $courseId === '') {
        $error = 'Please select both a student and a course.';
    } else {
        $safeStudent = (int) $studentId;
        $safeCourse = (int) $courseId;
        $updateSql = "UPDATE enrollment SET student_id = $safeStudent, course_id = $safeCourse WHERE enrollment_id = $id";
        if (mysqli_query($conn, $updateSql)) {
            header('Location: index.php?message=Enrolment updated successfully.');
            exit;
        }
        $error = 'Unable to update the enrolment. Please try again.';
    }
}

require_once __DIR__ . '/../includes/header.php';
?>
<h2>Edit Enrolment</h2>
<p style="color:#6b7280;margin-bottom:20px;">Update the student-course link and save.</p>
<?php if (!$students || !$courses): ?>
    <div class="alert alert-warning">Add at least one student and one course before editing enrolments.</div>
<?php else: ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="post" class="card">
        <div class="form-group">
            <label for="student_id">Student</label>
            <select name="student_id" id="student_id" required>
                <option value="">-- Select student --</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?php echo htmlspecialchars($student['student_id']); ?>" <?php echo ($studentId == $student['student_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($student['student_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="course_id">Course</label>
            <select name="course_id" id="course_id" required>
                <option value="">-- Select course --</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?php echo htmlspecialchars($course['course_id']); ?>" <?php echo ($courseId == $course['course_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($course['course_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="actions">
            <a class="btn secondary" href="index.php">Back</a>
            <button type="submit" class="btn">Update Enrolment</button>
        </div>
    </form>
<?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>

