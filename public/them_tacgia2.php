<?php
require_once __DIR__ . '/../src/connect.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $maTG = isset($_POST['maTG']) ? $_POST['maTG'] : '';
    $tenTG = isset($_POST['tenTG']) ? $_POST['tenTG'] : '';
    $website = isset($_POST['website']) ? $_POST['website'] : '';
    $ghiChu = isset($_POST['ghiChu']) ? $_POST['ghiChu'] : '';


    $sql = "SELECT themTG(:maTG, :tenTG, :website, :ghiChu)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'maTG' => $maTG,
        'tenTG' => $tenTG,
        'website' => $website,
        'ghiChu' => $ghiChu
    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
    if ($result === false || $result === null || $result === 0) {
        // Cập nhật dữ liệu không thành công
        $error_message = "Thêm dữ liệu không thành công. Vui lòng kiểm tra lại thông tin.";
    } else {
        // Cập nhật dữ liệu thành công
        redirect("tacgia2.php");
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
            <h2 class="text-center">Thêm tác giả</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="maTG" value="<?= $maTG ?>">

                <!-- Mã Tác giả -->
                <div class="form-group">
                    <label for="maTG">Mã Tác giả</label>
                    <input type="text" name="maTG" class="form-control" maxlen="10" id="maTG"
                        placeholder="Nhập mã tác giả"
                        value="<?= isset($_POST['maTG']) ? html_escape($_POST['maTG']) : '' ?>" required />


                </div>

                <!-- Tên tác giả -->
                <div class="form-group">
                    <label for="tenTG">Tên tác giả </label>
                    <input type="text" name="tenTG" class="form-control" maxlen="50" id="tenTG"
                        placeholder="Nhập tên tác giả"
                        value="<?= isset($_POST['tenTG']) ? html_escape($_POST['tenTG']) : '' ?>" required />


                </div>

                <!-- website -->
                <div class="form-group">
                    <label for="website">Website </label>
                    <input type="text" name="website" class="form-control" maxlen="50" id="website"
                        placeholder="Nhập website"
                        value="<?= isset($_POST['website']) ? html_escape($_POST['website']) : '' ?>" required />


                </div>

                <!-- ghi chú -->
                <div class="form-group">
                    <label for="ghiChu">Ghi chú </label>
                    <input type="text" name="ghiChu" class="form-control" maxlen="250" id="ghiChu"
                        placeholder="Nhập ghi chú"
                        value="<?= isset($_POST['ghiChu']) ? html_escape($_POST['ghiChu']) : '' ?>" required />

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