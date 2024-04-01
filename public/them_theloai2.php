<?php
require_once __DIR__ . '/../src/connect.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $maTL = isset($_POST['maTL']) ? $_POST['maTL'] : '';
    $tenTL = isset($_POST['tenTL']) ? $_POST['tenTL'] : '';


    $sql = "SELECT themTL(:maTL, :tenTL)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'maTL' => $maTL,
        'tenTL' => $tenTL
    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
    if ($result === false || $result === null || $result === 0) {
        // Cập nhật dữ liệu không thành công
        $error_message = "Thêm dữ liệu không thành công. Vui lòng kiểm tra lại thông tin.";
    } else {
        // Cập nhật dữ liệu thành công
        redirect("theloai2.php");
    }
}


if ($error_message) {
    include __DIR__ . '/../src/partials/show_error.php';
}



include_once __DIR__ . '/../src/partials/header.php'
?>




<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="text-center">Thêm thể loại</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="maTL" value="<?= $maTL ?>">

                <!-- Mã Thể loại -->
                <div class="form-group">
                    <label for="maTL">Mã thể loại</label>
                    <input type="text" name="maTL" class="form-control" maxlen="10" id="maTL"
                        placeholder="Nhập mã thể loại"
                        value="<?= isset($_POST['maTL']) ? html_escape($_POST['maTL']) : '' ?>" required />


                </div>

                <!-- Tên thể loại -->
                <div class="form-group">
                    <label for="tenTL">Tên thể loại </label>
                    <input type="text" name="tenTL" class="form-control" maxlen="50" id="tenTL"
                        placeholder="Nhập tên thể loại"
                        value="<?= isset($_POST['tenTL']) ? html_escape($_POST['tenTL']) : '' ?>" required />


                </div>


                <!-- Submit -->
                <button type="submit" name="submit" class="btn btn-primary mt-1">Thêm</button>
            </form>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../src/partials/footer.php'
?>