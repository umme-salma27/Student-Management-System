<?php
$pageTitle = 'Dashboard';
require_once __DIR__ . '/includes/header.php';
?>
<h2 style="margin-bottom:12px;">Welcome to the dashboard</h2>
<p style="color:#4b5563;margin-bottom:24px;">Quick links to manage your university records.</p>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px;">
    <div class="card">
        <h3 style="margin-top:0;">Students</h3>
        <p style="color:#6b7280;">Add names and enrollment years.</p>
        <a class="btn" href="student/index.php">Manage Students</a>
    </div>
    <div class="card">
        <h3 style="margin-top:0;">Courses</h3>
        <p style="color:#6b7280;">Create course titles and credit values.</p>
        <a class="btn" href="course/index.php">Manage Courses</a>
    </div>
    <div class="card">
        <h3 style="margin-top:0;">Enrolments</h3>
        <p style="color:#6b7280;">Link students to the courses they take.</p>
        <a class="btn" href="enrollment/index.php">Manage Enrolments</a>
    </div>
    <div class="card">
        <h3 style="margin-top:0;">Grades</h3>
        <p style="color:#6b7280;">Store the results for each student.</p>
        <a class="btn" href="grade/index.php">Manage Grades</a>
    </div>
</div>

<div style="margin-top:24px;">
    <div class="card">
        <h3 style="margin-top:0;">Student Grade Report</h3>
        <p style="color:#6b7280;">Open the JOIN-based report to review all grades at a glance.</p>
        <a class="btn secondary" href="report/student_report.php">View Result</a>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
