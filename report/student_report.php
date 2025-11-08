<?php
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Student Grade Report';
require_once __DIR__ . '/../includes/header.php';

$studentFilter = trim($_GET['student'] ?? '');

$baseSql = 'SELECT s.student_name, c.course_name, c.credits, g.grade
            FROM grade g
            JOIN enrollment e ON g.enrollment_id = e.enrollment_id
            JOIN student s ON e.student_id = s.student_id
            JOIN course c ON e.course_id = c.course_id';

if ($studentFilter !== '') {
    $safeFilter = mysqli_real_escape_string($conn, $studentFilter);
    $baseSql .= " WHERE s.student_name LIKE '%$safeFilter%'";
}

$baseSql .= ' ORDER BY s.student_name, c.course_name';
$result = mysqli_query($conn, $baseSql);
$rows = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Student Grade Report</h1>
    <a href="../index.php" class="btn btn-secondary">Back to dashboard</a>
</div>
<form method="get" class="row g-2 align-items-end mb-4">
    <div class="col-md-4">
        <label for="student" class="form-label">Filter by student</label>
        <input type="text" name="student" id="student" class="form-control" value="<?php echo htmlspecialchars($studentFilter); ?>" placeholder="Enter student name">
    </div>
    <div class="col-md-auto">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
    <?php if ($studentFilter !== ''): ?>
        <div class="col-md-auto">
            <a href="student_report.php" class="btn btn-outline-secondary">Clear</a>
        </div>
    <?php endif; ?>
</form>
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Credits</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($rows)): ?>
                    <tr><td colspan="4" class="text-center py-4">No records found.</td></tr>
                <?php else: ?>
                    <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['credits']); ?></td>
                        <td><?php echo htmlspecialchars($row['grade']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
