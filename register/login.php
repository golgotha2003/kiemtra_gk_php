<?php
require_once "../db/dbConnect.php";
require_once "../index.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST["MaSV"];

    $sql = "SELECT * FROM SinhVien WHERE MaSV = :MaSV";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['MaSV' => $MaSV]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        session_start();
        $_SESSION["MaSV"] = $MaSV;
        header("Location: index.php");
        exit();
    } else {
        echo "<p>Mã sinh viên không hợp lệ!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ĐĂNG NHẬP</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h2>ĐĂNG NHẬP</h2>
    <form method="POST">
        <label for="MaSV">MãSV:</label>
        <input type="text" name="MaSV" required>
        <button type="submit">Đăng Nhập</button>
    </form>
</body>

</html>