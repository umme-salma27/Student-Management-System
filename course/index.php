<?php
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Courses';

$result = mysqli_query($conn, 'SELECT course_id, course_name, credits FROM course ORDER BY course_name');
$courses = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];

require_once __DIR__ . '/../includes/header.php';
?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h2 style="margin:0;">Courses</h2>
        <p style="color:#6b7280;">Manage all courses and their credits.</p>
    </div>
    <a class="btn" href="create.php">Add Course</a>
</div>
<?php if (isset($_GET['message'])): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($_GET['message']); ?></div>
<?php endif; ?>
<div class="card">
    <table class="table">
        <thead>
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Credits</th>
                <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($courses)): ?>
            <tr>
                <td colspan="4" style="text-align:center;padding:26px;color:#6b7280;">No courses found.</td>
            </tr>
                <?php else: ?>
                    <?php foreach ($courses as $course): ?>
                    <tr>
                <td><?php echo htmlspecialchars($course['course_id']); ?></td>
                <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                <td><?php echo htmlspecialchars($course['credits']); ?></td>
                <td style="text-align:right;">
                    <a class="btn secondary" href="edit.php?id=<?php echo urlencode($course['course_id']); ?>">Edit</a>
                    <a class="btn" style="background:#dc2626;" href="delete.php?id=<?php echo urlencode($course['course_id']); ?>" onclick="return confirm('Delete this course?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
