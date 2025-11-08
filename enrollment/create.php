<?php
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Add Enrolment';
$studentId = $_POST['student_id'] ?? '';
$courseId = $_POST['course_id'] ?? '';
$error = '';

$studentsResult = mysqli_query($conn, 'SELECT student_id, student_name FROM student ORDER BY student_name');
$studentList = $studentsResult ? mysqli_fetch_all($studentsResult, MYSQLI_ASSOC) : [];

$coursesResult = mysqli_query($conn, 'SELECT course_id, course_name FROM course ORDER BY course_name');
$courseList = $coursesResult ? mysqli_fetch_all($coursesResult, MYSQLI_ASSOC) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($studentId === '' || $courseId === '') {
        $error = 'Please select both a student and a course.';
    } else {
        $safeStudent = (int) $studentId;
        $safeCourse = (int) $courseId;
        $sql = "INSERT INTO enrollment (student_id, course_id) VALUES ($safeStudent, $safeCourse)";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?message=Enrolment added successfully.');
            exit;
        }
        $error = 'Unable to save the enrolment. Please try again.';
    }
}

require_once __DIR__ . '/../includes/header.php';
?>
<h2>Add Enrolment</h2>
<p style="color:#6b7280;margin-bottom:20px;">Choose a student and a course to link them together.</p>
<?php if (!$studentList || !$courseList): ?>
    <div class="alert alert-warning">Add at least one student and one course before creating enrolments.</div>
<?php else: ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="post" class="card">
        <div class="form-group">
            <label for="student_id">Student</label>
            <select name="student_id" id="student_id" required>
                <option value="">-- Select student --</option>
                <?php foreach ($studentList as $student): ?>
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
                <?php foreach ($courseList as $course): ?>
                    <option value="<?php echo htmlspecialchars($course['course_id']); ?>" <?php echo ($courseId == $course['course_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($course['course_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="actions">
            <a class="btn secondary" href="index.php">Back</a>
            <button type="submit" class="btn">Add Enrolment</button>
        </div>
    </form>
<?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
