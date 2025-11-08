<?php
require_once __DIR__ . '/../config/db.php';

$id = $_GET['id'] ?? '';
if ($id === '') {
    header('Location: index.php?message=Course not found.');
    exit;
}

$id = (int) $id;
$sql = "DELETE FROM course WHERE course_id = $id LIMIT 1";
$message = mysqli_query($conn, $sql) ? 'Course deleted successfully.' : 'Unable to delete the course.';

header('Location: index.php?message=' . urlencode($message));
exit;
