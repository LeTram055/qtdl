<?php
require_once __DIR__ . '/../src/connect.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maMT = isset($_POST['maMT']) ? $_POST['maMT'] : '';
    $maSach = isset($_POST['maSach']) ? $_POST['maSach'] : '';
    $maNV = isset($_POST['maNV']) ? html_escape($_POST['maNV']) : '';
    $soThe = isset($_POST['soThe']) ? html_escape($_POST['soThe']) : '';
    $ngayMuon = isset($_POST['ngayMuon']) ? html_escape($_POST['ngayMuon']) : null;
    $ghiChu = isset($_POST['ghiChu']) ? html_escape($_POST['ghiChu']) : '';


    $sql = "SELECT themMuonTra(:maMT, :maSach, :maNV, :soThe, :ngayMuon, :ghiChu)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'maMT' => $maMT,
        'maSach' => $maSach,
        'maNV' => $maNV,
        'soThe' => $soThe,
        'ngayMuon' => $ngayMuon,
        'ghiChu' => $ghiChu
    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
if ($result === false || $result === null || $result === 0) {
    // Cập nhật dữ liệu không thành công
    $error_message = "Thêm dữ liệu không thành công. Vui lòng kiểm tra lại thông tin.";
} else {
    // Cập nhật dữ liệu thành công
    redirect("muontra.php");
    
}
}


if ($error_message) {
    include __DIR__ . '/../src/partials/show_error.php';
}



if(isset($_SESSION['username']) && $_SESSION['username'] === 'admin'){
    include_once __DIR__. '/../src/partials/header2.php';
} else {
    include_once __DIR__. '/../src/partials/header.php';
};
?>


<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="text-center">Thêm thông tin mượn sách</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="maMT" value="<?= $maMT ?>">

                <!-- Mã mượn trả -->
                <div class="form-group">
                    <label for="maMT">Mã mượn trả</label>
                    <input type="text" name="maMT" class="form-control" maxlen="10" id="maMT"
                        placeholder="Nhập mã mượn trả"
                        value="<?= isset($_POST['maMT']) ? html_escape($_POST['maMT']) : '' ?>" required />
                </div>

                <!-- Mã sách -->
                <div class="form-group">
                    <label for="maSach">Mã sách</label>
                    <input type="text" name="maSach" class="form-control" maxlen="10" id="maSach"
                        placeholder="Nhập mã sách"
                        value="<?= isset($_POST['maSach']) ? html_escape($_POST['maSach']) : '' ?>" required />
                </div>

                <!-- Mã nhân viên -->
                <div class="form-group">
                    <label for="maNV">Mã nhân viên</label>
                    <input type="text" name="maNV" class="form-control" maxlen="10" id="maNV"
                        placeholder="Nhập tên nhân viên"
                        value="<?= isset($_POST['maNV']) ? html_escape($_POST['maNV']) : '' ?>" required />
                </div>

                <!-- Số thẻ -->
                <div class="form-group">
                    <label for="soThe">Số thẻ</label>
                    <input type="text" name="soThe" class="form-control" maxlen="10" id="soThe"
                        placeholder="Nhập số thẻ thư viện"
                        value="<?= isset($_POST['soThe']) ? html_escape($_POST['soThe']) : '' ?>" required />
                </div>

                <!-- Ngày mượn -->
                <div class="form-group">
                    <label for="ngayMuon">Ngày mượn</label>
                    <input type="date" name="ngayMuon" class="form-control" id="ngayMuon" placeholder="Nhập ngày mượn"
                        value="<?= isset($_POST['ngayMuon']) ? html_escape($_POST['ngayMuon']) : null ?>" required />
                </div>

                <!-- Ghi chú -->
                <div class="form-group">
                    <label for="ghiChu">Ghi chú</label>
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
include_once __DIR__. '/../src/partials/footer.php'
?>