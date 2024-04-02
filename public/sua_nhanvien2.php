<?php
require_once __DIR__ . '/../src/connect.php';

$maNV = isset($_REQUEST['maNV']) ?
    $_REQUEST['maNV'] : '';

$sql = "CALL hthiThongTinNV(:maNV)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['maNV' => $maNV]);
$nhanvien = $stmt->fetch(PDO::FETCH_ASSOC);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $maNV = $_POST['maNV'];
    $tenNV = $_POST['tenNV'];
    $ngaySinh = $_POST['ngaySinh'];
    $soDT = $_POST['soDT'];

    $sql = "SELECT capNhatNV(:maNV, :tenNV, :ngaySinh, :soDT)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'maNV' => $maNV,
        'tenNV' => $tenNV,
        'ngaySinh' => $ngaySinh,
        'soDT' => $soDT,

    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
    if ($result === false || $result === null || $result === 0) {
        // Cập nhật dữ liệu không thành công
        $error_message = "Cập nhật dữ liệu không thành công. Vui lòng kiểm tra lại thông tin tác giả, thể loại và nhà xuất bản.";
    } else {
        // Cập nhật dữ liệu thành công
        redirect("nhanvien2.php");
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
            <h2 class="text-center">Cập nhật nhân viên</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3 m-b-3">

                <input type="hidden" name="maNV" value="<?= $maNV ?>">

                <!-- Mã nhân viên-->
                <div class="form-group">
                    <label for="maNV">Mã nhân viên</label>
                    <input type="text" name="maNV" class="form-control" maxlen="10" id="maNV"
                        placeholder="Nhập mã nhân viên" value="<?= html_escape($nhanvien['maNV']) ?>" readonly />


                </div>

                <!-- Tên nhân viên -->
                <div class="form-group">
                    <label for="tenNV">Tên nhân viên </label>
                    <input type="text" name="tenNV" class="form-control" maxlen="50" id="tenNV"
                        placeholder="Nhập tên nhân viên" value="<?= html_escape($nhanvien['tenNV']) ?>" required />


                </div>

                <!-- Ngày sinh -->
                <div class="form-group">
                    <label for="ngaySinh">Ngày sinh </label>
                    <input type="date" name="ngaySinh" class="form-control" id="ngaySinh"
                        value="<?= html_escape($nhanvien['ngaySinh']) ?>" />


                </div>

                <!-- số điện thoại -->
                <div class="form-group">
                    <label for="soDT">Số điện thoại </label>
                    <input type="int" name="soDT" class="form-control" id="soDT" maxlen="11"
                        placeholder="Nhập số điện thoại" value="<?= html_escape($nhanvien['soDT']) ?>" required />


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