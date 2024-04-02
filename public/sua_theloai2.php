<?php
require_once __DIR__ . '/../src/connect.php';

$maTL = isset($_REQUEST['maTL']) ?
    $_REQUEST['maTL'] : '';

$sql = "CALL hthiThongTinTL(:maTL)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['maTL' => $maTL]);
$theloai = $stmt->fetch(PDO::FETCH_ASSOC);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $maTL = $_POST['maTL'];
    $tenTL = $_POST['tenTL'];


    $sql = "SELECT capNhatTL(:maTL, :tenTL)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'maTL' => $maTL,
        'tenTL' => $tenTL

    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
    if ($result === false || $result === null || $result === 0) {
        // Cập nhật dữ liệu không thành công
        $error_message = "Cập nhật dữ liệu không thành công. Vui lòng kiểm tra lại thông tin tác giả, thể loại và nhà xuất bản.";
    } else {
        // Cập nhật dữ liệu thành công
        redirect("theloai2.php");
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
            <h2 class="text-center">Cập nhật thể loại</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3 m-b-3">

                <input type="hidden" name="maTL" value="<?= $maTL ?>">

                <!-- Mã thể loại-->
                <div class="form-group">
                    <label for="maTL">Mã thể loại</label>
                    <input type="text" name="maTL" class="form-control" maxlen="10" id="maTL"
                        placeholder="Nhập mã thể loại" value="<?= html_escape($theloai['maTL']) ?>" readonly />


                </div>

                <!-- Tên thể loại-->
                <div class="form-group">
                    <label for="tenTL">Tên thể loại </label>
                    <input type="text" name="tenTL" class="form-control" maxlen="50" id="tenTL"
                        placeholder="Nhập tên thể loại" value="<?= html_escape($theloai['tenTL']) ?>" required />


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