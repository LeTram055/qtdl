<?php
require_once __DIR__ . '/../src/connect.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $maSach = isset($_POST['maSach']) ? $_POST['maSach'] : '';
    $tenSach = isset($_POST['tenSach']) ? $_POST['tenSach'] : '';
    $tenTG = isset($_POST['tenTG']) ? $_POST['tenTG'] : '';
    $tenTL = isset($_POST['tenTL']) ? $_POST['tenTL'] : '';
    $tenNXB = isset($_POST['tenNXB']) ? $_POST['tenNXB'] : '';
    $namXuatBan = isset($_POST['namXuatBan']) ? $_POST['namXuatBan'] : '';


    $sql = "SELECT themSach(:maSach, :tenSach, :tenTG, :tenTL, :tenNXB, :namXuatBan)";
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
    $error_message = "Thêm dữ liệu không thành công. Vui lòng kiểm tra lại thông tin.";
} else {
    // Cập nhật dữ liệu thành công
    redirect("qlsach2.php");
    
}
}


if ($error_message) {
    include __DIR__ . '/../src/partials/show_error.php';
}



include_once __DIR__. '/../src/partials/header.php'
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
                        placeholder="Nhập mã sách"
                        value="<?= isset($_POST['maSach']) ? html_escape($_POST['maSach']) : '' ?>" required />


                </div>

                <!-- Tên sách -->
                <div class="form-group">
                    <label for="tenSach">Tên sách</label>
                    <input type="text" name="tenSach" class="form-control" maxlen="50" id="tenSach"
                        placeholder="Nhập tên sách"
                        value="<?= isset($_POST['tenSach']) ? html_escape($_POST['tenSach']) : '' ?>" required />


                </div>

                <!-- Tên tác giả -->
                <div class="form-group">
                    <label for="tenTG">Tên tác giả </label>
                    <input type="text" name="tenTG" class="form-control" maxlen="50" id="tenTG"
                        placeholder="Nhập tên tác giả"
                        value="<?= isset($_POST['tenTG']) ? html_escape($_POST['tenTG']) : '' ?>" required />


                </div>

                <!-- Tên thể loại -->
                <div class="form-group">
                    <label for="tenTL">Tên thể loại </label>
                    <input type="text" name="tenTL" class="form-control" maxlen="50" id="tenTL"
                        placeholder="Nhập tên thể loại"
                        value="<?= isset($_POST['tenTL']) ? html_escape($_POST['tenTL']) : '' ?>" required />


                </div>

                <!-- Tên nhà xuất bản -->
                <div class="form-group">
                    <label for="tenNXB">Tên nhà xuất bản </label>
                    <input type="text" name="tenNXB" class="form-control" maxlen="50" id="tenNXB"
                        placeholder="Nhập tên nhà xuất bản"
                        value="<?= isset($_POST['tenNXB']) ? html_escape($_POST['tenNXB']) : '' ?>" required />


                </div>

                <!-- Năm xuất bản -->
                <div class="form-group">
                    <label for="namXuatBan">Năm xuất bản </label>
                    <input type="text" name="namXuatBan" class="form-control" maxlen="50" id="namXuatBan"
                        placeholder="Nhập năm xuất bản"
                        value="<?= isset($_POST['namXuatBan']) ? html_escape($_POST['namXuatBan']):'' ?>" />


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