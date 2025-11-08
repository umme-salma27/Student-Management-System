<?php
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Students';

$result = mysqli_query($conn, 'SELECT student_id, student_name, enrollment_year FROM student ORDER BY student_name');
$students = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];

require_once __DIR__ . '/../includes/header.php';
?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h2 style="margin:0;">All Students</h2>
        <p style="color:#6b7280;">List of registered students with their enrollment year.</p>
    </div>
    <a class="btn" href="create.php">Add Student</a>
</div>
<?php if (isset($_GET['message'])): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($_GET['message']); ?></div>
<?php endif; ?>
<div class="card">
    <table class="table">
        <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Enrollment Year</th>
                <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($students)): ?>
            <tr>
                <td colspan="4" style="text-align:center;padding:26px;color:#6b7280;">No students found.</td>
            </tr>
                <?php else: ?>
                    <?php foreach ($students as $student): ?>
                    <tr>
                <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                <td><?php echo htmlspecialchars($student['student_name']); ?></td>
                <td><?php echo htmlspecialchars($student['enrollment_year']); ?></td>
                <td style="text-align:right;">
                    <a class="btn secondary" href="edit.php?id=<?php echo urlencode($student['student_id']); ?>">Edit</a>
                    <a class="btn" style="background:#dc2626;" href="delete.php?id=<?php echo urlencode($student['student_id']); ?>" onclick="return confirm('Delete this student?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
