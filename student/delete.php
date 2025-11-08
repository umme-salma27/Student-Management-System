<?php
require_once __DIR__ . '/../config/db.php';

$id = $_GET['id'] ?? '';
if ($id === '') {
    header('Location: index.php?message=Student not found.');
    exit;
}

$id = (int) $id;
$sql = "DELETE FROM student WHERE student_id = $id LIMIT 1";
$message = mysqli_query($conn, $sql) ? 'Student deleted successfully.' : 'Unable to delete the student.';

header('Location: index.php?message=' . urlencode($message));
exit;
