<?php
require_once __DIR__ . '/../src/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maSach'])) {
    $maSach = $_POST['maSach'];

    // Xóa sách khỏi cơ sở dữ liệu
    $sql = "DELETE FROM sach WHERE maSach = :maSach";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute(['maSach' => $maSach])) {
        // Xóa thành công
        redirect("qlsach.php");
    } else {
        // Xóa không thành công, hiển thị thông báo lỗi
        $error_message = "Không thể xóa sách. Vui lòng thử lại sau.";
    }

}
?>
<!-- Hiển thị thông báo lỗi nếu có -->
<?php if (isset($error_message)) : ?>
<div class="alert alert-danger" role="alert">
    <?= $error_message ?>
</div>
<?php endif; ?>