<?php
require_once __DIR__ . '/../src/connect.php';

$maSach = isset($_REQUEST['maSach']) ?
    $_REQUEST['maSach'] : '';

$sql = "CALL hthiThongTinSach(:maSach)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['maSach' => $maSach]);
$sach = $stmt->fetch(PDO::FETCH_ASSOC);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $maSach = $_POST['maSach'];
    $tenSach = $_POST['tenSach'];
    $tenTG = $_POST['tenTG'];
    $tenTL = $_POST['tenTL'];
    $tenNXB = $_POST['tenNXB'];
    $namXuatBan = $_POST['namXuatBan'];


    $sql = "SELECT capNhatSach(:maSach, :tenSach, :tenTG, :tenTL, :tenNXB, :namXuatBan)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'maSach' => $maSach,
        'tenSach' => $tenSach,
        'tenTG' => $tenTG,
        'tenTL' => $tenTL,
        'tenNXB' => $tenNXB,
        'namXuatBan' => $namXuatBan
    ]);
    $result = $stmt->fetchColumn();

    // Kiểm tra kết quả cập nhật
if ($result === false || $result === null || $result === 0) {
    // Cập nhật dữ liệu không thành công
    $error_message = "Cập nhật dữ liệu không thành công. Vui lòng kiểm tra lại thông tin tác giả, thể loại và nhà xuất bản.";
} else {
    // Cập nhật dữ liệu thành công
    redirect("qlsach2.php");
    
}
}


if ($error_message) {
    include __DIR__ . '/../src/partials/show_error.php';
}



include_once __DIR__. '/../src/partials/header2.php'
?>




<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="text-center">Cập nhật sách</h2>
            <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">

                <input type="hidden" name="maSach" value="<?= $maSach ?>">

                <!-- Mã sách -->
                <div class="form-group">
                    <label for="maSach">Mã sách</label>
                    <input type="text" name="maSach" class="form-control" maxlen="10" id="maSach"
                        placeholder="Nhập mã sách" value="<?= html_escape($sach['maSach']) ?>" required />


                </div>

                <!-- Tên sách -->
                <div class="form-group">
                    <label for="tenSach">Tên sách</label>
                    <input type="text" name="tenSach" class="form-control" maxlen="50" id="tenSach"
                        placeholder="Nhập tên sách" value="<?= html_escape($sach['tenSach']) ?>" required />


                </div>

                <!-- Tên tác giả -->
                <div class="form-group">
                    <label for="tenTG">Tên tác giả </label>
                    <input type="text" name="tenTG" class="form-control" maxlen="50" id="tenTG"
                        placeholder="Nhập tên tác giả" value="<?= html_escape($sach['tenTG']) ?>" required />


                </div>

                <!-- Tên thể loại -->
                <div class="form-group">
                    <label for="tenTL">Tên thể loại </label>
                    <input type="text" name="tenTL" class="form-control" maxlen="50" id="tenTL"
                        placeholder="Nhập tên thể loại" value="<?= html_escape($sach['tenTL']) ?>" required />


                </div>

                <!-- Tên nhà xuất bản -->
                <div class="form-group">
                    <label for="tenNXB">Tên nhà xuất bản </label>
                    <input type="text" name="tenNXB" class="form-control" maxlen="50" id="tenNXB"
                        placeholder="Nhập tên nhà xuất bản" value="<?= html_escape($sach['tenNXB']) ?>" required />


                </div>

                <!-- Năm xuất bản -->
                <div class="form-group">
                    <label for="namXuatBan">Năm xuất bản </label>
                    <input type="text" name="namXuatBan" class="form-control" maxlen="50" id="namXuatBan"
                        placeholder="Nhập năm xuất bản" value="<?= html_escape($sach['namXuatBan']) ?>" />


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