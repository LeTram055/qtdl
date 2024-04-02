<?php
require_once __DIR__ . '/../src/connect.php';

$maDG = isset($_REQUEST['maDG']) ?
    $_REQUEST['maDG'] : '';

$sql = "CALL hthiThongTinDG(:maDG)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['maDG' => $maDG]);
$docgia = $stmt->fetch(PDO::FETCH_ASSOC);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $maDG = $_POST['maDG'];
    $tenDG = $_POST['tenDG'];
    $diaChi = $_POST['diaChi'];
    $soThe = $_POST['soThe'];

    $sql = "SELECT capNhatDG(:maDG, :tenDG, :diaChi, :soThe)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'maDG' => $maDG,
        'tenDG' => $tenDG,
        'diaChi' => $diaChi,
        'soThe' => $soThe,

    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
    if ($result === false || $result === null || $result === 0) {
        // Cập nhật dữ liệu không thành công
        $error_message = "Cập nhật dữ liệu không thành công. Vui lòng kiểm tra lại thông tin độc giả và số thẻ";
    } else {
        // Cập nhật dữ liệu thành công
        redirect("docgia2.php");
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
            <h2 class="text-center">Cập nhật độc giả</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3 m-b-3">

                <input type="hidden" name="maDG" value="<?= $maDG ?>">

                <!-- Mã độc giả-->
                <div class="form-group">
                    <label for="maDG">Mã độc giả</label>
                    <input type="text" name="maDG" class="form-control" maxlen="10" id="maDG"
                        placeholder="Nhập mã độc giả" value="<?= html_escape($docgia['maDG']) ?>" readonly />


                </div>

                <!-- Tên độc giả-->
                <div class="form-group">
                    <label for="tenDG">Tên độc giả </label>
                    <input type="text" name="tenDG" class="form-control" maxlen="50" id="tenDG"
                        placeholder="Nhập tên độc giả" value="<?= html_escape($docgia['tenDG']) ?>" required />


                </div>

                <!-- Địa chỉ-->
                <div class="form-group">
                    <label for="diaChi">Địa Chi </label>
                    <input type="text" name="diaChi" class="form-control" maxlen="100" id="diaChi"
                        placeholder="Nhập địa Chi" value="<?= html_escape($docgia['diaChi']) ?>" required />


                </div>

                <!-- Số thẻ -->
                <div class="form-group">
                    <label for="soThe">Số thẻ </label>
                    <input type="text" name="soThe" class="form-control" maxlen="10" id="soThe"
                        placeholder="Nhập số thẻ" value="<?= html_escape($docgia['soThe']) ?>" required />


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