<?php
require_once __DIR__ . '/../src/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maTL'])) {
    $maTL = $_POST['maTL'];

    // Gọi function để xóa sách và xử lý lỗi ràng buộc
    $sql = "SELECT xoaTL(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$maTL]);

    // Lấy kết quả trả về từ function
    $result = $stmt->fetchColumn();
    if ($result === false || $result === null || $result === 0) {
        // Xóa thành công
        echo "<script>
            alert('Không thể xóa Tác giả do tồn tại ràng buộc.');
            window.location.href = 'theloai2.php';
        </script>";
    } else {
        // Xóa thành công
        redirect("theloai2.php");
    }
}