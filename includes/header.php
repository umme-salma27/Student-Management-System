<?php
$pageTitle = $pageTitle ?? 'University Management System';
$baseUrl = '/student';
$logoPath = dirname(__DIR__) . '/assets/kyau-logo.png';
$logoExists = file_exists($logoPath);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <style>
        *{box-sizing:border-box;}
        body{margin:0;font-family:"Segoe UI",Arial,sans-serif;background:#f5f7fb;color:#1f2937;}
        a{text-decoration:none;color:inherit;}
        .layout{display:flex;min-height:100vh;}
        .sidebar{width:230px;background:#1f2937;color:#fff;padding:24px 20px;}
        .sidebar h1{font-size:1.3rem;margin:0 0 24px;}
        .sidebar ul{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:14px;}
        .sidebar a{display:flex;align-items:center;gap:12px;padding:10px 12px;border-radius:8px;color:#e5e7eb;background:transparent;}
        .sidebar a:hover,.sidebar a.active{background:#374151;}
        .icon{width:18px;text-align:center;font-weight:bold;}
        .content-area{flex:1;padding:32px 40px;}
        .header-bar{display:flex;align-items:center;gap:16px;margin-bottom:30px;}
        .header-bar img{width:72px;height:72px;object-fit:contain;border-radius:50%;background:#fff;padding:8px;border:1px solid #e5e7eb;}
        .header-title{font-size:1.9rem;font-weight:700;letter-spacing:0.5px;background:linear-gradient(90deg,#f97316,#facc15,#34d399,#22d3ee,#6366f1);-webkit-background-clip:text;color:transparent;}
        .card{background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:24px;}
        .btn{display:inline-block;padding:10px 18px;border-radius:8px;border:none;background:#2563eb;color:#fff;font-weight:600;cursor:pointer;}
        .btn.secondary{background:#6b7280;}
        .table{width:100%;border-collapse:collapse;}
        .table th,.table td{padding:12px 14px;border-bottom:1px solid #e5e7eb;text-align:left;}
        .table th{background:#f9fafb;font-weight:600;}
        .alert{padding:12px 16px;border-radius:8px;margin-bottom:18px;font-weight:500;}
        .alert-success{background:#dcfce7;color:#166534;border:1px solid #86efac;}
        .alert-danger{background:#fee2e2;color:#b91c1c;border:1px solid #fca5a5;}
        .alert-warning{background:#fef9c3;color:#92400e;border:1px solid #fde68a;}
        form .form-group{margin-bottom:18px;display:flex;flex-direction:column;}
        label{font-weight:600;margin-bottom:6px;}
        input,select{padding:10px 12px;border-radius:8px;border:1px solid #cbd5f5;background:#fff;}
        input:focus,select:focus{outline:none;border-color:#2563eb;box-shadow:0 0 0 2px rgba(37,99,235,0.15);}
        .actions{display:flex;gap:10px;justify-content:flex-end;margin-top:20px;}
        @media(max-width:900px){
            .layout{flex-direction:column;}
            .sidebar{width:100%;display:flex;flex-direction:row;overflow-x:auto;}
            .sidebar ul{flex-direction:row;flex-wrap:wrap;}
            .content-area{padding:24px;}
        }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <h1>UMS</h1>
        <ul>
            <li><a href="<?php echo $baseUrl; ?>/index.php"><span class="icon">🏠</span>Dashboard</a></li>
            <li><a href="<?php echo $baseUrl; ?>/student/create.php"><span class="icon">➕</span>Add Student</a></li>
            <li><a href="<?php echo $baseUrl; ?>/course/create.php"><span class="icon">📘</span>Add Course</a></li>
            <li><a href="<?php echo $baseUrl; ?>/enrollment/create.php"><span class="icon">🔗</span>Enrolment</a></li>
            <li><a href="<?php echo $baseUrl; ?>/grade/create.php"><span class="icon">⭐</span>Add Grade</a></li>
            <li><a href="<?php echo $baseUrl; ?>/report/student_report.php"><span class="icon">📊</span>View Result</a></li>
        </ul>
    </aside>
    <main class="content-area">
        <div class="header-bar">
            <?php if ($logoExists): ?>
                <img src="<?php echo $baseUrl; ?>/assets/kyau-logo.png" alt="KYAU Logo">
            <?php endif; ?>
            <div>
                <div class="header-title">Khwaja Yunus Ali University</div>
                <div style="color:#4b5563;">University Management System</div>
            </div>
        </div>
