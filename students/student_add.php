<?php
require_once "../db/dbConnect.php";
require_once "../index.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = htmlspecialchars($_POST['MaSV']);
    $HoTen = htmlspecialchars($_POST['HoTen']);
    $GioiTinh = htmlspecialchars($_POST['GioiTinh']);
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = htmlspecialchars($_POST['MaNganh']);

    // Kiểm tra nếu có file ảnh được upload
    if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == 0) {
        $uploadDir = "../images/";
        $fileName = basename($_FILES['Hinh']['name']);
        $targetFilePath = $uploadDir . $fileName;

        // Kiểm tra định dạng file
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($fileType), $allowedTypes)) {
            move_uploaded_file($_FILES['Hinh']['tmp_name'], $targetFilePath);
            $Hinh = $fileName; // Lưu tên file vào database
        } else {
            $error = "Chỉ chấp nhận file JPG, JPEG, PNG, GIF!";
        }
    } else {
        $Hinh = "default.png"; // Nếu không có ảnh, dùng ảnh mặc định
    }

    if (!isset($error)) {
        $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :MaNganh)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':MaSV' => $MaSV,
            ':HoTen' => $HoTen,
            ':GioiTinh' => $GioiTinh,
            ':NgaySinh' => $NgaySinh,
            ':Hinh' => $Hinh,
            ':MaNganh' => $MaNganh
        ]);

        header("Location: student.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/student/student_add.css">
</head>
<body>
    <div class="container">
        <h2>Thêm Sinh Viên</h2>
        
        <!-- Hiển thị lỗi nếu có -->
        <?php if (isset($error)): ?>
            <p class="error-message"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label for="MaSV">Mã SV:</label>
            <input type="text" name="MaSV" required><br>

            <label for="HoTen">Họ Tên:</label>
            <input type="text" name="HoTen" required><br>

            <label for="GioiTinh">Giới Tính:</label>
            <select name="GioiTinh">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select><br>

            <label for="NgaySinh">Ngày Sinh:</label>
            <input type="date" name="NgaySinh"><br>

            <label for="MaNganh">Ngành:</label>
            <input type="text" name="MaNganh"><br>

            <label for="Hinh">Hình Ảnh:</label>
            <input type="file" name="Hinh" accept="image/*"><br>

            <button type="submit">Thêm</button>
        </form>
    </div>
</body>
</html>
