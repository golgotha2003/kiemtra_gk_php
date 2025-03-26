<?php
require_once "../db/dbConnect.php";
require_once "../index.php";

$sql = "SELECT * FROM HocPhan";
$stmt = $conn->query($sql);
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DANH SÁCH HỌC PHẦN</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h2>DANH SÁCH HỌC PHẦN</h2>
<table border="1">
    <thead>
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Đăng Ký</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($courses as $course) { ?>
            <tr>
                <td><?= htmlspecialchars($course["MaHP"]) ?></td>
                <td><?= htmlspecialchars($course["TenHP"]) ?></td>
                <td><?= htmlspecialchars($course["SoTinChi"]) ?></td>
                <td>
                    <a href="index.php?page=register&MaHP=<?= urlencode($course["MaHP"]) ?>" class="btn btn-success">Đăng Ký</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>