<?php
require_once __DIR__ . '/../src/connect.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $maNXB = isset($_POST['maNXB']) ? $_POST['maNXB'] : '';
    $tenNXB = isset($_POST['tenNXB']) ? $_POST['tenNXB'] : '';
    $diaChi = isset($_POST['email']) ? $_POST['email'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $ttNguoiDaiDien = isset($_POST['ttNguoiDaiDien']) ? $_POST['ttNguoiDaiDien'] : '';


    $sql = "SELECT themNXB(:maNXB, :tenNXB, :email, :email, :ttNguoiDaiDien)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'maNXB' => $maNXB,
        'tenNXB' => $tenNXB,
        'email' => $email,
        'email' => $email,
        'ttNguoiDaiDien' => $ttNguoiDaiDien
    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
    if ($result === false || $result === null || $result === 0) {
        // Cập nhật dữ liệu không thành công
        $error_message = "Thêm dữ liệu không thành công. Vui lòng kiểm tra lại thông tin.";
    } else {
        // Cập nhật dữ liệu thành công
        redirect("nxb2.php");
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
            <h2 class="text-center">Thêm nhà xuất bản</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="maNXB" value="<?= $maNXB ?>">

                <!-- Mã NXB -->
                <div class="form-group">
                    <label for="maNXB">Mã NXB</label>
                    <input type="text" name="maNXB" class="form-control" maxlen="10" id="maNXB"
                        placeholder="Nhập mã NXB"
                        value="<?= isset($_POST['maNXB']) ? html_escape($_POST['maNXB']) : '' ?>" required />


                </div>

                <!-- Tên nxb -->
                <div class="form-group">
                    <label for="tenNXB">Tên nxb </label>
                    <input type="text" name="tenNXB" class="form-control" maxlen="50" id="tenNXB"
                        placeholder="Nhập tên NXB"
                        value="<?= isset($_POST['tenNXB']) ? html_escape($_POST['tenNXB']) : '' ?>" required />


                </div>

                <!-- Diachi -->
                <div class="form-group">
                    <label for="diaChi">Địa chỉ</label>
                    <input type="text" name="diaChi" class="form-control" maxlen="100" id="diaChi"
                        placeholder="Nhập địa chỉ"
                        value="<?= isset($_POST['diaChi']) ? html_escape($_POST['diaChi']) : '' ?>" required />


                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="text" name="email" class="form-control" maxlen="50" id="email" placeholder="Nhập Email"
                        value="<?= isset($_POST['email']) ? html_escape($_POST['email']) : '' ?>" required />

                </div>

                <!-- ttNguoiDaiDien -->
                <div class="form-group">
                    <label for="ttNguoiDaiDien">Thông tin người đại diện </label>
                    <input type="text" name="ttNguoiDaiDien" class="form-control" maxlen="255" id="ttNguoiDaiDien"
                        placeholder="Nhập thông tin người đại diện"
                        value="<?= isset($_POST['ttNguoiDaiDien']) ? html_escape($_POST['ttNguoiDaiDien']) : '' ?> "
                        required />

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