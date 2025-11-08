<?php
require_once __DIR__ . '/../config/db.php';

$id = $_GET['id'] ?? '';
if ($id === '') {
    header('Location: index.php?message=Grade not found.');
    exit;
}

$id = (int) $id;
$sql = "DELETE FROM grade WHERE grade_id = $id LIMIT 1";
$message = mysqli_query($conn, $sql) ? 'Grade deleted successfully.' : 'Unable to delete the grade.';

header('Location: index.php?message=' . urlencode($message));
exit;
