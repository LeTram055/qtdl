<?php
require_once __DIR__ . '/../src/connect.php';

$maTG = isset($_REQUEST['maTG']) ?
    $_REQUEST['maTG'] : '';

$sql = "CALL hthiThongTinTG(:maTG)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['maTG' => $maTG]);
$tacgia = $stmt->fetch(PDO::FETCH_ASSOC);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $maTGh = $_POST['maTG'];
    $tenTG = $_POST['tenTG'];
    $website = $_POST['website'];
    $ghiChu = $_POST['ghiChu'];

    $sql = "SELECT capNhatTG(:maTG, :tenTG, :website, :ghiChu)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'maTG' => $maTG,
        'tenTG' => $tenTG,
        'website' => $website,
        'ghiChu' => $ghiChu,

    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
    if ($result === false || $result === null || $result === 0) {
        // Cập nhật dữ liệu không thành công
        $error_message = "Cập nhật dữ liệu không thành công. Vui lòng kiểm tra lại thông tin tác giả, thể loại và nhà xuất bản.";
    } else {
        // Cập nhật dữ liệu thành công
        redirect("tacgia2.php");
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
            <h2 class="text-center">Cập nhật sách</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3 m-b-3">

                <input type="hidden" name="maTG" value="<?= $maTG ?>">

                <!-- Mã Tác giả -->
                <div class="form-group">
                    <label for="maTG">Mã Tác giả</label>
                    <input type="text" name="maTG" class="form-control" maxlen="10" id="maTG"
                        placeholder="Nhập mã tác giả" value="<?= html_escape($tacgia['maTG']) ?>" required />


                </div>

                <!-- Tên tác giả -->
                <div class="form-group">
                    <label for="tenTG">Tên tác giả </label>
                    <input type="text" name="tenTG" class="form-control" maxlen="50" id="tenTG"
                        placeholder="Nhập tên tác giả" value="<?= html_escape($tacgia['tenTG']) ?>" required />


                </div>

                <!-- Tên thể loại -->
                <div class="form-group">
                    <label for="website">Website </label>
                    <input type="text" name="website" class="form-control" maxlen="50" id="website"
                        placeholder="Nhập website" value="<?= html_escape($tacgia['website']) ?>" required />


                </div>

                <!-- Tên nhà xuất bản -->
                <div class="form-group">
                    <label for="ghiChu">Ghi chú </label>
                    <input type="text" name="ghiChu" class="form-control" maxlen="250" id="ghiChu"
                        placeholder="Nhập ghi chú" value="<?= html_escape($tacgia['ghiChu']) ?>" required />


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