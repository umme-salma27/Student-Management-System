<?php
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Grades';

$result = mysqli_query(
    $conn,
    'SELECT g.grade_id, g.grade, s.student_name, c.course_name
     FROM grade g
     JOIN enrollment e ON g.enrollment_id = e.enrollment_id
     JOIN student s ON e.student_id = s.student_id
     JOIN course c ON e.course_id = c.course_id
     ORDER BY s.student_name, c.course_name'
);
$grades = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];

require_once __DIR__ . '/../includes/header.php';
?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h2 style="margin:0;">Grades</h2>
        <p style="color:#6b7280;">Track the results assigned to each enrolment.</p>
    </div>
    <a class="btn" href="create.php">Add Grade</a>
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
                <th>Grade</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($grades)): ?>
            <tr>
                <td colspan="5" style="text-align:center;padding:26px;color:#6b7280;">No grades recorded.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($grades as $grade): ?>
            <tr>
                <td><?php echo htmlspecialchars($grade['grade_id']); ?></td>
                <td><?php echo htmlspecialchars($grade['student_name']); ?></td>
                <td><?php echo htmlspecialchars($grade['course_name']); ?></td>
                <td><?php echo htmlspecialchars($grade['grade']); ?></td>
                <td style="text-align:right;">
                    <a class="btn secondary" href="edit.php?id=<?php echo urlencode($grade['grade_id']); ?>">Edit</a>
                    <a class="btn" style="background:#dc2626;" href="delete.php?id=<?php echo urlencode($grade['grade_id']); ?>" onclick="return confirm('Delete this grade?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
