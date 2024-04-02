<?php
require_once __DIR__ . '/../src/connect.php';

$maNXB = isset($_REQUEST['maNXB']) ?
    $_REQUEST['maNXB'] : '';

$sql = "CALL hthiThongTinNXB(:maNXB)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['maNXB' => $maNXB]);
$nhaXuatBan = $stmt->fetch(PDO::FETCH_ASSOC);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $maNXB = $_POST['maNXB'];
    $tenNXB = $_POST['tenNXB'];
    $diaChi = $_POST['diaChi'];
    $email = $_POST['email'];
    $ttNguoiDaiDien = $_POST['ttNguoiDaiDien'];


    $sql = "SELECT capNhatNXB(:maNXB, :tenNXB, :diaChi, :email, :ttNguoiDaiDien)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'maNXB' => $maNXB,
        'tenNXB' => $tenNXB,
        'diaChi' => $diaChi,
        'email' => $email,
        'ttNguoiDaiDien' => $ttNguoiDaiDien
    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
    if ($result === false || $result === null || $result === 0) {
        // Cập nhật dữ liệu không thành công
        $error_message = "Cập nhật dữ liệu không thành công. Vui lòng kiểm tra lại thông tin mã NXB và tên NXB";
    } else {
        // Cập nhật dữ liệu thành công
        redirect("nxb2.php");
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
            <h2 class="text-center">Cập nhật nhà xuất bản</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="maNXB" value="<?= $maNXB ?>">

                <!-- Mã NXB -->
                <div class="form-group">
                    <label for="maNXB">Mã nhà xuất bản</label>
                    <input type="text" name="maNXB" class="form-control" maxlen="10" id="maNXB"
                        placeholder="Nhập nhà xuất bản" value="<?= html_escape($nhaXuatBan['maNXB']) ?>" readonly />


                </div>

                <!-- Tên NXB-->
                <div class="form-group">
                    <label for="tenNXB">Tên nhà xuất bản</label>
                    <input type="text" name="tenNXB" class="form-control" maxlen="50" id="tenNXB"
                        placeholder="Nhập tên nhà xuất bản" value="<?= html_escape($nhaXuatBan['tenNXB']) ?>"
                        required />


                </div>

                <!-- diaChi -->
                <div class="form-group">
                    <label for="diaChi">Tên địa chỉ</label>
                    <input type="text" name="diaChi" class="form-control" maxlen="100" id="diaChi"
                        placeholder="Nhập địa chỉ" value="<?= html_escape($nhaXuatBan['diaChi']) ?>" />


                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" name="email" class="form-control" maxlen="50" id="email"
                        placeholder="Nhập email" value="<?= html_escape($nhaXuatBan['email']) ?>" />


                </div>

                <!-- ttNguoiDaiDien -->
                <div class="form-group">
                    <label for="ttNguoiDaiDien">Thông tin người đại diện </label>
                    <input type="text" name="ttNguoiDaiDien" class="form-control" maxlen="255" id="ttNguoiDaiDien"
                        placeholder="Nhập thông tin người đại diện"
                        value="<?= html_escape($nhaXuatBan['ttNguoiDaiDien']) ?>" />

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