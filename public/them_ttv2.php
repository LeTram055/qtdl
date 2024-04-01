<?php
require_once __DIR__ . '/../src/connect.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $soThe = isset($_POST['soThe']) ? $_POST['soThe'] : '';
    $ngayBD = isset($_POST['ngayBD']) ? $_POST['ngayBD'] : '';
    $ngayKT = isset($_POST['ngayKT']) ? $_POST['ngayKT'] : '';
    $ghiChu = isset($_POST['ghiChu']) ? $_POST['ghiChu'] : '';


    $sql = "SELECT themTTV(:soThe, :ngayBD, :ngayKT, :ghiChu)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'soThe' => $soThe,
        'ngayBD' => $ngayBD,
        'ngayKT' => $ngayKT,
        'ghiChu' => $ghiChu
    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
    if ($result === false || $result === null || $result === 0) {
        // Cập nhật dữ liệu không thành công
        $error_message = "Thêm dữ liệu không thành công. Vui lòng kiểm tra lại thông tin.";
    } else {
        // Cập nhật dữ liệu thành công
        redirect("thethuvien2.php");
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
            <h2 class="text-center">Thêm thẻ thư viện</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="soThe" value="<?= $soThe ?>">

                <!-- số thẻ thư viện  -->
                <div class="form-group">
                    <label for="soThe">Số thẻ thư viện</label>
                    <input type="text" name="soThe" class="form-control" maxlen="10" id="soThe"
                        placeholder="Số thẻ thư viện"
                        value="<?= isset($_POST['soThe']) ? html_escape($_POST['soThe']) : '' ?>" required />


                </div>

                <!-- Ngày bắt đầu-->
                <div class="form-group">
                    <label for="ngayBD">Ngày bắt đầu</label>
                    <input type="date" name="ngayBD" class="form-control" id="ngayBD" placeholder="Nhập ngày bắt đầu"
                        value="<?= isset($_POST['ngayBD']) ? html_escape($_POST['ngayBD']) : '' ?>" required />


                </div>

                <!-- Ngày kết thúc -->
                <div class="form-group">
                    <label for="ngayKT">Ngày kết thúc </label>
                    <input type="date" name="ngayKT" class="form-control" id="ngayKT" placeholder="Nhập ngày kết thúc"
                        value="<?= isset($_POST['ngayKT']) ? html_escape($_POST['ngayKT']) : '' ?>" required />


                </div>

                <!-- ghi chú -->
                <div class="form-group">
                    <label for="ghiChu">Ghi chú </label>
                    <input type="text" name="ghiChu" class="form-control" maxlen="255" id="ghiChu"
                        placeholder="Nhập ghi chú"
                        value="<?= isset($_POST['ghiChu']) ? html_escape($_POST['ghiChu']) : '' ?>" />

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