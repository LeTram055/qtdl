<?php
require_once __DIR__ . '/../src/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maDG'])) {
    $maDG = $_POST['maDG'];

    // Gọi function để xóa độc giả và xử lý lỗi ràng buộc
    $sql = "SELECT xoaDG(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$maDG]);

    // Lấy kết quả trả về từ function
    $result = $stmt->fetchColumn();
    if ($result === false || $result === null || $result === 0) {
        // Xóa thành công
        echo "<script>
            alert('Không thể xóa Tác giả do tồn tại ràng buộc.');
            window.location.href = 'docgia2.php';
        </script>";
    } else {
        // Xóa thành công
        redirect("docgia2.php");
    }
}