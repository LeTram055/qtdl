<?php
require_once __DIR__ . '/../src/connect.php';

$soThe = isset($_REQUEST['soThe']) ?
    $_REQUEST['soThe'] : '';

$sql = "CALL hthiThongTinTTV(:soThe)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['soThe' => $soThe]);
$thethuvien = $stmt->fetch(PDO::FETCH_ASSOC);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $soTheh = $_POST['soThe'];
    $ngayBD = $_POST['ngayBD'];
    $ngayKT = $_POST['ngayKT'];
    $ghiChu = $_POST['ghiChu'];

    $sql = "SELECT capNhatTTV(:soThe, :ngayBD, :ngayKT, :ghiChu)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'soThe' => $soThe,
        'ngayBD' => $ngayBD,
        'ngayKT' => $ngayKT,
        'ghiChu' => $ghiChu,

    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
    if ($result === false || $result === null || $result === 0) {
        // Cập nhật dữ liệu không thành công
        $error_message = "Cập nhật dữ liệu không thành công. Vui lòng kiểm tra lại thông tin tác giả, thể loại và nhà xuất bản.";
    } else {
        // Cập nhật dữ liệu thành công
        redirect("thethuvien2.php");
    }
}


if ($error_message) {
    include __DIR__ . '/../src/partials/show_error.php';
}



include_once __DIR__ . '/../src/partials/header2.php'
?>




<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="text-center">Cập nhật thẻ thư viện</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3 m-b-3">

                <input type="hidden" name="soThe" value="<?= $soThe ?>">

                <!-- Số thẻ -->
                <div class="form-group">
                    <label for="soThe">Số thẻ</label>
                    <input type="text" name="soThe" class="form-control" maxlen="10" id="soThe"
                        placeholder="Nhập số thẻ" value="<?= html_escape($thethuvien['soThe']) ?>" required />


                </div>

                <!-- Ngày BD -->
                <div class="form-group">
                    <label for="ngayBD">Ngày bắt đầu </label>
                    <input type="date" name="ngayBD" class="form-control" id="ngayBD" placeholder="Nhập tên tác giả"
                        value="<?= html_escape($thethuvien['ngayBD']) ?>" required />


                </div>

                <!-- NGày KT -->
                <div class="form-group">
                    <label for="ngayKT">Ngày kết thúc </label>
                    <input type="date" name="ngayKT" class="form-control" id="ngayKT" placeholder="Nhập ngày kết thúc"
                        value="<?= html_escape($thethuvien['ngayKT']) ?>" required />


                </div>

                <!-- Tên nhà xuất bản -->
                <div class="form-group">
                    <label for="ghiChu">Ghi chú </label>
                    <input type="text" name="ghiChu" class="form-control" maxlen="250" id="ghiChu"
                        placeholder="Nhập ghi chú" value="<?= html_escape($thethuvien['ghiChu']) ?>" />


                </div>

                <!-- Submit -->
                <button type="submit" name="submit" class="btn btn-primary mt-1">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../src/partials/footer.php'
?>