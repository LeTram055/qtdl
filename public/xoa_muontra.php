<?php
require_once __DIR__ . '/../src/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maMT']) && isset($_POST['maSach'])) {
    $maMT = $_POST['maMT'];
    $maSach = $_POST['maSach'];

    // Gọi function để xóa sách và xử lý lỗi ràng buộc
    $sql = "SELECT xoaMuonTra(:maMT, :maSach)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "maMT" => $maMT,
        "maSach"=> $maSach
    ]);

    // Lấy kết quả trả về từ function
    $result = $stmt->fetchColumn();
    if ($result === false || $result === null || $result === 0) {
    // Xóa không thành công
        echo "<script>
            alert('Không thể xóa.');
            window.location.href = 'muontra.php';
        </script>";
    
    } else {
        // Xóa thành công
        redirect("muontra.php");
        
    }
}

?>