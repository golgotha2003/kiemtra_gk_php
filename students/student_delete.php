<?php
require_once "../db/dbConnect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['MaSV'])) {
    $MaSV = $_GET['MaSV'];

    // Xóa sinh viên theo MãSV
    $sql = "DELETE FROM SinhVien WHERE MaSV = :MaSV";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':MaSV' => $MaSV]);

    // Quay lại trang danh sách sau khi xóa
    header("Location: student.php");
    exit();
} else {
    echo "Yêu cầu không hợp lệ!";
}
?>
