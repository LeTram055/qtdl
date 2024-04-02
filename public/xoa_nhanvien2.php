<?php
require_once __DIR__ . '/../src/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maNV'])) {
    $maNV = $_POST['maNV'];

    // Gọi function để xóa sách và xử lý lỗi ràng buộc
    $sql = "SELECT xoaNV(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$maNV]);

    // Lấy kết quả trả về từ function
    $result = $stmt->fetchColumn();
    if ($result === false || $result === null || $result === 0) {
    // Xóa thành công
        echo "<script>
            alert('Không thể xóa sách do tồn tại ràng buộc.');
            window.location.href = 'nhanvien2.php';
        </script>";
    
    } else {
        // Xóa thành công
        redirect("nhanvien2.php");
        
    }
}

?>