<?php
require_once __DIR__ . '/../src/connect.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Đường dẫn tới autoload.php của thư viện PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

function exportToExcel($data) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Thiết lập header
    $header = ['Mã nhân viên', 'Tên nhân viên', 'Ngày sinh', 'Số điện thoại'];
    $sheet->fromArray($header, NULL, 'A1');

    // Ghi dữ liệu
    $rowIndex = 2;
    foreach ($data as $row) {
        $sheet->fromArray($row, NULL, 'A' . $rowIndex);
        $rowIndex++;
    }

    // Thiết lập response header để tải file về
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="nhanvien.xls"');
    header('Cache-Control: max-age=0');

    // Tạo một file Excel tạm thời và ghi dữ liệu vào nó
    $writer = new Xls($spreadsheet);
    $writer->save('php://output');
    exit;
}

// Gọi procedure 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sort'])) {
    // Gọi procedure để sắp xếp nhân viên theo tên
    $sql = "CALL sapXepNV()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $sql = "CALL timKiemNV(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$keyword]);
} else {
    // Nếu không có yêu cầu sắp xếp, hiển thị thông tin nhân viên bình thường
    $sql = "CALL hthiNV()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export'])) {
  // Xuất file Excel
  exportToExcel($rows);
}

include_once __DIR__ . '/../src/partials/header.php'
?>
<div class="container">
    <div class="row mb-3">
        <div class="col d-flex justify-content-center ">
            <div class="col d-flex justify-content-center ">
                <form class="d-flex align-items-center" method="GET" action="/nhanvien.php" class="w-100">
                    <input class="m-2" type="search" placeholder="Nhập tên nhân viên hoặc mã nhân viên"
                        aria-label="search" name="keyword"
                        value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                    <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row mb-3">

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
                        <th>Mã nhân niên</th>
                        <th>Tên nhân viên</th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>

                    <tr>
                        <td><?= html_escape($row['maNV']) ?></td>
                        <td><?= html_escape($row['tenNV']) ?></td>
                        <td><?= html_escape($row['ngaySinh']) ?></td>
                        <td><?= html_escape($row['soDT']) ?></td>

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
include_once __DIR__ . '/../src/partials/footer.php'
?>