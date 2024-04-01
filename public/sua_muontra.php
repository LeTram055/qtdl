<?php
require_once __DIR__ . '/../src/connect.php';

$maMT = isset($_REQUEST['maMT']) ?
    $_REQUEST['maMT'] : '';

$maSach = isset($_REQUEST['maSach']) ?
    $_REQUEST['maSach'] : '';

$sql = "CALL hthiThongTinMuonTra(:maMT, :maSach)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'maMT' => $maMT, 
    'maSach' => $maSach
]);
$muontra = $stmt->fetch(PDO::FETCH_ASSOC);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $maNV = $_POST['maNV'];
    $soThe = $_POST['soThe'];
    $ngayMuon = $_POST['ngayMuon'];
    $ngayTra = $_POST['ngayTra'];
    $ghiChu = $_POST['ghiChu'];

    $sql = "SELECT capNhatMuonTra(:maMT, :maSach, :maNV, :soThe, :ngayMuon, :ngayTra, :ghiChu)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'maMT' => $maMT,
        'maSach' => $maSach,
        'maNV' => $maNV,
        'soThe' => $soThe,
        'ngayMuon' => $ngayMuon,
        'ngayTra' => $ngayTra,
        'ghiChu' => $ghiChu
    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
if ($result === false || $result === null || $result === 0) {
    // Cập nhật dữ liệu không thành công
    $error_message = "Cập nhật dữ liệu không thành công. Vui lòng kiểm tra lại thông tin.";
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
            <h2 class="text-center">Cập nhật mượn trả</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="maMT" value="<?= $maMT ?>">
                <input type="hidden" name="maSach" value="<?= $maSach ?>">

                <!-- Mã mượn trả -->
                <div class="form-group">
                    <label for="maSach">Mã mượn trả</label>
                    <input type="text" name="maMT" class="form-control" maxlen="10" id="maMT" value="<?= $maMT ?>"
                        readonly />
                </div>

                <!-- Mã sách -->
                <div class="form-group">
                    <label for="maSach">Mã sách</label>
                    <input type="text" name="maSach" class="form-control" maxlen="10" id="maSach" value="<?= $maSach ?>"
                        readonly />
                </div>

                <!-- Mã nhân viên -->
                <div class="form-group">
                    <label for="maNV">Mã nhân viên</label>
                    <input type="text" name="maNV" class="form-control" maxlen="10" id="maNV"
                        placeholder="Nhập mã nhân viên" value="<?= html_escape($muontra['maNV']) ?>" required />
                </div>

                <!-- Số thẻ -->
                <div class="form-group">
                    <label for="soThe">Số thẻ</label>
                    <input type="text" name="soThe" class="form-control" maxlen="10" id="soThe"
                        placeholder="Nhập số thẻ thư viện" value="<?= html_escape($muontra['soThe']) ?>" required />
                </div>

                <!-- Ngày mượn -->
                <div class="form-group">
                    <label for="ngayMuon">Ngày mượn</label>
                    <input type="date" name="ngayMuon" class="form-control" id="ngayMuon"
                        value="<?= html_escape($muontra['ngayMuon']) ?>" required />
                </div>

                <!-- Ngày trả -->
                <div class="form-group">
                    <label for="ngayTra">Ngày trả</label>
                    <input type="date" name="ngayTra" class="form-control" id="ngayTra"
                        value="<?= html_escape($muontra['ngayTra']) ?>" />

                </div>

                <!-- Ghi chú -->
                <div class="form-group">
                    <label for="ghiChu">Ghi chú</label>
                    <input type="text" name="ghiChu" class="form-control" maxlen="255" id="ghiChu"
                        placeholder="Nhập ghi chú" value="<?= html_escape($muontra['ghiChu']) ?>" />
                </div>

                <!-- Submit -->
                <button type="submit" name="submit" class="btn btn-primary mt-1">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

<?php
include_once __DIR__. '/../src/partials/footer.php'
?>