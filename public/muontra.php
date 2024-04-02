<?php
require_once __DIR__ . '/../src/connect.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Đường dẫn tới autoload.php của thư viện PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

function exportToExcel($data) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Thiết lập header
    $header = ['Mã mượn trả', 'Mã sách', 'Mã nhân viên', 'Số thẻ', 'Ngày mượn', 'Ngày trả', 'Đã trả', 'Ghi chú'];
    $sheet->fromArray($header, NULL, 'A1');

    // Ghi dữ liệu
    $rowIndex = 2;
    foreach ($data as $row) {
        $sheet->fromArray($row, NULL, 'A' . $rowIndex);
        $rowIndex++;
    }

    // Thiết lập response header để tải file về
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="muontra.xls"');
    header('Cache-Control: max-age=0');

    // Tạo một file Excel tạm thời và ghi dữ liệu vào nó
    $writer = new Xls($spreadsheet);
    $writer->save('php://output');
    exit;
}


// Gọi procedure 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sort'])) {
    // Gọi procedure để sắp xếp sách theo tên
    $sql = "CALL sapXepMuonTra()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
    $sql = "CALL timKiemMuonTra(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$keyword]);
}
else {
    // Nếu không có yêu cầu sắp xếp, hiển thị thông tin sách bình thường
    $sql = "CALL hthiMuonTra()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
 
}

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export'])) {
  // Xuất file Excel
  exportToExcel($rows);
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
    include_once __DIR__. '/../src/partials/header2.php';
} else {
    include_once __DIR__. '/../src/partials/header.php';
}

?>
<div class="container">
    <div class="row mb-3">
        <div class="col d-flex justify-content-center ">
            <form class="d-flex align-items-center" method="GET" action="/muontra.php" class="w-100">
                <input class="m-2" type="search" placeholder="Nhập từ khóa" aria-label="search" name="keyword"
                    value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <a href="/them_muontra.php" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Thêm mượn sách
            </a>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <form method="post">
                <button class="btn btn-secondary" type="submit" name="sort">
                    Sắp xếp
                </button>
            </form>
            <div style="width: 10px;"></div>
            <form method="post">
                <button class="btn btn-success" type="submit" name="export">
                    Xuất Excel
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">


            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th>Mã mượn trả</th>
                        <th>Mã sách</th>
                        <th>Mã nhân viên</th>
                        <th>Số thẻ</th>
                        <th>Ngày mượn</th>
                        <th>Ngày trả</th>
                        <th>Đã trả</th>
                        <th>Ghi chú</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>

                    <tr>
                        <td><?= html_escape($row['maMT']) ?></td>
                        <td><?= html_escape($row['maSach']) ?></td>
                        <td><?= html_escape($row['maNV']) ?></td>
                        <td><?= html_escape($row['soThe']) ?></td>
                        <td><?= html_escape($row['ngayMuon']) ?></td>
                        <td><?= html_escape($row['ngayTra']) ?></td>
                        <td class="text-center"><?= html_escape($row['daTra']) ?></td>
                        <td><?= html_escape($row['ghiChu']) ?></td>
                        <td class="d-flex justify-content-center">
                            <a href="<?= 'sua_muontra.php?maMT=' . $row['maMT'] .'&maSach=' .$row['maSach']?>"
                                class="btn btn-xs btn-warning m-1">
                                Sửa</a>
                            <div style="width: 10px;"></div>
                            <form class="form-inline m-1" action="/xoa_muontra.php" method="POST">
                                <input type="hidden" name="maMT" value="<?= $row['maMT'] ?>">
                                <input type="hidden" name="maSach" value="<?= $row['maSach'] ?>">
                                <button id="delete-sach-btn" type="button" class="btn btn-xs btn-danger  delete-mt-btn"
                                    data-toggle="modal" name="delete-sach" data-target="#delete-confirm">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>


                    <?php endforeach ?>
                </tbody>
            </table>

            <div id="delete-confirm" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Xác nhận</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Xóa</button>
                            <button type="button" data-dismiss="modal" class="btn btn-default">Hủy</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<?php
include_once __DIR__. '/../src/partials/footer.php'
?>