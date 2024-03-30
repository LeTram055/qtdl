<?php
require_once __DIR__ . '/../src/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maSach'])) {
    $maSach = $_POST['maSach'];

    // Gọi function để xóa sách và xử lý lỗi ràng buộc
    $sql = "SELECT xoaSach(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$maSach]);

    // Lấy kết quả trả về từ function
    $result = $stmt->fetchColumn();
    if ($result === false || $result === null || $result === 0) {
    // Xóa thành công
        echo "<script>
            alert('Không thể xóa sách do tồn tại ràng buộc.');
            window.location.href = 'qlsach.php';
        </script>";
    
    } else {
        // Xóa thành công
        redirect("qlsach.php");
        
    }
}

?>