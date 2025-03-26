<?php
require_once "../db/dbConnect.php";
require_once "../index.php";


$MaSV = $_GET['MaSV'] ?? ''; // Lấy mã sinh viên từ URL
if (!$MaSV) {
    die("Không có mã sinh viên!");
}

$sql = "SELECT * FROM SinhVien WHERE MaSV = :MaSV";
$stmt = $conn->prepare($sql);
$stmt->execute([':MaSV' => $MaSV]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("Không tìm thấy sinh viên!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];
    $Hinh = $_POST['Hinh'];

    $sql = "UPDATE SinhVien SET HoTen = :HoTen, GioiTinh = :GioiTinh, NgaySinh = :NgaySinh, Hinh = :Hinh, MaNganh = :MaNganh WHERE MaSV = :MaSV";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':HoTen' => $HoTen, ':GioiTinh' => $GioiTinh, ':NgaySinh' => $NgaySinh, ':Hinh' => $Hinh, ':MaNganh' => $MaNganh, ':MaSV' => $MaSV]);

    header("Location: student.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sinh viên</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/student/student_edit.css">
</head>
<body>
    <h2>Chỉnh sửa thông tin sinh viên</h2>
    <form action="" method="POST">
        <label for="HoTen">Họ và Tên:</label>
        <input type="text" name="HoTen" value="<?= htmlspecialchars($student['HoTen']) ?>" required><br>

        <label for="GioiTinh">Giới tính:</label>
        <select name="GioiTinh" required>
            <option value="Nam" <?= $student['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= $student['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
        </select><br>

        <label for="NgaySinh">Ngày sinh:</label>
        <input type="date" name="NgaySinh" value="<?= $student['NgaySinh'] ?>" required><br>

        <label for="MaNganh">Mã Ngành:</label>
        <input type="text" name="MaNganh" value="<?= htmlspecialchars($student['MaNganh']) ?>" required><br>

        <label for="Hinh">Hình ảnh URL:</label>
        <input type="text" name="Hinh" value="<?= htmlspecialchars($student['Hinh']) ?>"><br>

        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
