<?php
require_once __DIR__ . '/../config/db.php';

$id = $_GET['id'] ?? '';
if ($id === '') {
    header('Location: index.php?message=Enrolment not found.');
    exit;
}

$id = (int) $id;
mysqli_query($conn, "DELETE FROM enrollment WHERE enrollment_id = $id LIMIT 1");

header('Location: index.php?message=Enrolment deleted successfully.');
exit;
