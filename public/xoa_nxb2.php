<?php
require_once __DIR__ . '/../src/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maNXB'])) {
    $maNXB = $_POST['maNXB'];

    // Gọi function để xóa sách và xử lý lỗi ràng buộc
    $sql = "SELECT xoaNXB(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$maNXB]);

    // Lấy kết quả trả về từ function
    $result = $stmt->fetchColumn();
    if ($result === false || $result === null || $result === 0) {
        // Xóa thành công
        echo "<script>
            alert('Không thể xóa Tác giả do tồn tại ràng buộc.');
            window.location.href = 'nxb2.php';
        </script>";
    } else {
        // Xóa thành công
        redirect("nxb2.php");
    }
}