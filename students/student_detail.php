<?php
require_once "../db/dbConnect.php";
require_once "../index.php";


$MaSV = $_GET['MaSV'];
$sql = "SELECT * FROM SinhVien WHERE MaSV = :MaSV";
$stmt = $conn->prepare($sql);
$stmt->execute([':MaSV' => $MaSV]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Sinh Viên</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- CSS dùng chung -->
    <link rel="stylesheet" href="../css/student/student_detail.css"> <!-- CSS riêng -->
</head>
<body>
    <div class="container">
        <h2>Chi tiết Sinh Viên</h2>
        <div class="detail-info">
            <p><strong>Mã SV:</strong> <?= htmlspecialchars($student['MaSV']) ?></p>
            <p><strong>Họ Tên:</strong> <?= htmlspecialchars($student['HoTen']) ?></p>
            <p><strong>Giới Tính:</strong> <?= htmlspecialchars($student['GioiTinh']) ?></p>
            <p><strong>Ngày Sinh:</strong> <?= htmlspecialchars($student['NgaySinh']) ?></p>
            <p><strong>Ngành:</strong> <?= htmlspecialchars($student['MaNganh']) ?></p>
            <p><strong>Hình Ảnh:</strong></p>
            <img src="<?= htmlspecialchars($student['Hinh']) ?>" width="150" alt="Ảnh sinh viên">
        </div>
        <a class="back-btn" href="student.php">Quay lại</a>
    </div>
</body>
</html>
