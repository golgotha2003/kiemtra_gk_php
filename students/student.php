<?php
require_once "../db/dbConnect.php";
require_once "../index.php";

$sql = "SELECT * FROM SinhVien";
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Sinh Viên</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/student/student.css">
</head>
<body>
    <div class="container">
        <h2 class="title">TRANG SINH VIÊN</h2>
        <a href="student_add.php" class="add-student">➕ Add Student</a>
        <table class="student-table">
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình</th>
                    <th>Mã Ngành</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['MaSV']) ?></td>
                    <td><?= htmlspecialchars($student['HoTen']) ?></td>
                    <td><?= htmlspecialchars($student['GioiTinh']) ?></td>
                    <td><?= htmlspecialchars($student['NgaySinh']) ?></td>
                    <td>
                        <img src="<?= htmlspecialchars($student['Hinh']) ?>" class="student-img">
                    </td>
                    <td><?= htmlspecialchars($student['MaNganh']) ?></td>
                    <td>
                        <a href="/kiemtra_gk_php/students/student_edit.php?MaSV=<?= $student['MaSV'] ?>" class="edit">Edit</a> |
                        <a href="/kiemtra_gk_php/students/student_detail.php?MaSV=<?= $student['MaSV'] ?>" class="detail">Details</a> |
                        <a href="/kiemtra_gk_php/students/student_delete.php?MaSV=<?= $student['MaSV'] ?>" class="delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
