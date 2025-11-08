<?php
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Enrollments';

$result = mysqli_query(
    $conn,
    'SELECT e.enrollment_id, s.student_name, c.course_name
     FROM enrollment e
     JOIN student s ON e.student_id = s.student_id
     JOIN course c ON e.course_id = c.course_id
     ORDER BY s.student_name, c.course_name'
);
$enrollments = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];

require_once __DIR__ . '/../includes/header.php';
?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h2 style="margin:0;">Enrolments</h2>
        <p style="color:#6b7280;">See which students are linked to each course.</p>
    </div>
    <a class="btn" href="create.php">Add Enrolment</a>
</div>
<?php if (isset($_GET['message'])): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($_GET['message']); ?></div>
<?php endif; ?>
<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Course</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($enrollments)): ?>
            <tr>
                <td colspan="4" style="text-align:center;padding:26px;color:#6b7280;">No enrolments found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($enrollments as $enrollment): ?>
            <tr>
                <td><?php echo htmlspecialchars($enrollment['enrollment_id']); ?></td>
                <td><?php echo htmlspecialchars($enrollment['student_name']); ?></td>
                <td><?php echo htmlspecialchars($enrollment['course_name']); ?></td>
                <td style="text-align:right;">
                    <a class="btn secondary" href="edit.php?id=<?php echo urlencode($enrollment['enrollment_id']); ?>">Edit</a>
                    <a class="btn" style="background:#dc2626;" href="delete.php?id=<?php echo urlencode($enrollment['enrollment_id']); ?>" onclick="return confirm('Delete this enrolment?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
