<?php
require_once __DIR__ . '/../src/connect.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Đường dẫn tới autoload.php của thư viện PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

function exportToExcel($data) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Thiết lập header
    $header = ['Mã nhà xuất bản', 'Tên nhà xuất bản', 'Địa chỉ', 'Email', 'Thông tin người đại diện'];
    $sheet->fromArray($header, NULL, 'A1');

    // Ghi dữ liệu
    $rowIndex = 2;
    foreach ($data as $row) {
        $sheet->fromArray($row, NULL, 'A' . $rowIndex);
        $rowIndex++;
    }

    // Thiết lập response header để tải file về
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="nhaxuatban.xls"');
    header('Cache-Control: max-age=0');

    // Tạo một file Excel tạm thời và ghi dữ liệu vào nó
    $writer = new Xls($spreadsheet);
    $writer->save('php://output');
    exit;
}

// Gọi procedure 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sort'])) {
    // Gọi procedure để sắp xếp sách theo tên
    $sql = "CALL sapXepNXB()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $sql = "CALL timKiemNXB(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$keyword]);
} else {
    // Nếu không có yêu cầu sắp xếp, hiển thị thông tin sách bình thường
    $sql = "CALL hthiNXB()";
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
                <form class="d-flex align-items-center" method="GET" action="/nxb.php" class="w-100">
                    <input class="m-2" type="search" placeholder="Nhập tên nxb hoặc mã nxb" aria-label="search"
                        name="keyword" value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                    <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col d-flex justify-content-end">
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
                        <th>Mã NXB</th>
                        <th>Tên NXB</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Thông tin người đại diện</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>

                    <tr>
                        <td><?= html_escape($row['maNXB']) ?></td>
                        <td><?= html_escape($row['tenNXB']) ?></td>
                        <td><?= html_escape($row['diaChi']) ?></td>
                        <td><?= html_escape($row['email']) ?></td>
                        <td><?= html_escape($row['ttNguoiDaiDien']) ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>


        </div>
    </div>
</div>


<?php
include_once __DIR__ . '/../src/partials/footer.php'
?>