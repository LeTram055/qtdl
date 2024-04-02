<?php
require_once __DIR__ . '/../src/connect.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $maNV = isset($_POST['maNV']) ? $_POST['maNV'] : '';
    $tenNV = isset($_POST['tenNV']) ? $_POST['tenNV'] : '';
    $ngaySinh = isset($_POST['ngaySinh']) ? $_POST['ngaySinh'] : '';
    $soDT = isset($_POST['soDT']) ? $_POST['soDT'] : '';


    $sql = "SELECT themNV(:maNV, :tenNV, :ngaySinh, :soDT)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'maNV' => $maNV,
        'tenNV' => $tenNV,
        'ngaySinh' => $ngaySinh,
        'soDT' => $soDT
    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
    if ($result === false || $result === null || $result === 0) {
        // Cập nhật dữ liệu không thành công
        $error_message = "Thêm dữ liệu không thành công. Vui lòng kiểm tra lại thông tin.";
    } else {
        // Cập nhật dữ liệu thành công
        redirect("nhanvien2.php");
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
            <h2 class="text-center">Thêm nhân viên</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="maNV" value="<?= $maNV ?>">

                <!-- Mã nhân viên -->
                <div class="form-group">
                    <label for="maNV">Mã nhân viên</label>
                    <input type="text" name="maNV" class="form-control" maxlen="10" id="maNV"
                        placeholder="Nhập mã nhân viên"
                        value="<?= isset($_POST['maNV']) ? html_escape($_POST['maNV']) : '' ?>" required />


                </div>

                <!-- Tên nhân viên   -->
                <div class="form-group">
                    <label for="tenNV">Tên nhân viên </label>
                    <input type="text" name="tenNV" class="form-control" maxlen="50" id="tenNV"
                        placeholder="Nhập tên  nhân viên "
                        value="<?= isset($_POST['tenNV']) ? html_escape($_POST['tenNV']) : '' ?>" required />


                </div>

                <!-- ngaySinh -->
                <div class="form-group">
                    <label for="ngaySinh">Ngày sinh </label>
                    <input type="date" name="ngaySinh" class="form-control" id="ngaySinh" placeholder="Nhập ngày sinh"
                        value="<?= isset($_POST['ngaySinh']) ? html_escape($_POST['ngaySinh']) : '' ?>" />


                </div>

                <!-- Số điện thoại-->
                <div class="form-group">
                    <label for="soDT">Số điện thoại </label>
                    <input type="int" name="soDT" class="form-control" id="soDT" placeholder="Nhập số điện thoại"
                        value="<?= isset($_POST['soDT']) ? html_escape($_POST['soDT']) : '' ?>" required />

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