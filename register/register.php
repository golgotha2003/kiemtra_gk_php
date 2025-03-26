<?php
require_once "../db/dbConnect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["MaHP"])) {
    $MaHP = $_GET["MaHP"];
}

// Xử lý đăng ký học phần
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST["MaSV"];
    $MaHP = $_POST["MaHP"];

    try {
        $sql = "INSERT INTO DangKy (MaSV, MaHP) VALUES (:MaSV, :MaHP)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['MaSV' => $MaSV, 'MaHP' => $MaHP]);
        echo "<p>Đăng ký thành công!</p>";
    } catch (PDOException $e) {
        echo "<p>Lỗi: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ĐĂNG KÝ HỌC PHẦN</title>
    <link rel="stylesheet" href="../css/style.css">
    
</head>
<body>
<h2>ĐĂNG KÝ HỌC PHẦN</h2>
<form method="POST">
    <label for="MaSV">Mã Sinh Viên:</label>
    <input type="text" name="MaSV" required>
    <input type="hidden" name="MaHP" value="<?= htmlspecialchars($MaHP) ?>">
    <button type="submit">Xác Nhận</button>
</form>
</body>
</html>
