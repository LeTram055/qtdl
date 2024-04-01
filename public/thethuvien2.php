<?php
require_once __DIR__ . '/../src/connect.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Đường dẫn tới autoload.php của thư viện PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

function exportToExcel($data) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Thiết lập header
    $header = ['Số thẻ', 'Ngày bắt đầu', 'Ngày kết thúc', 'Ghi chú'];
    $sheet->fromArray($header, NULL, 'A1');

    // Ghi dữ liệu
    $rowIndex = 2;
    foreach ($data as $row) {
        $sheet->fromArray($row, NULL, 'A' . $rowIndex);
        $rowIndex++;
    }

    // Thiết lập response header để tải file về
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="thethuvien.xls"');
    header('Cache-Control: max-age=0');

    // Tạo một file Excel tạm thời và ghi dữ liệu vào nó
    $writer = new Xls($spreadsheet);
    $writer->save('php://output');
    exit;
}

// Gọi procedure 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sort'])) {
    // Gọi procedure để sắp xếp sách theo tên
    $sql = "CALL sapXepTTV()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $sql = "CALL timKiemTTV(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$keyword]);
} else {
    // Nếu không có yêu cầu sắp xếp, hiển thị thông tin sách bình thường
    $sql = "CALL hthiTTV()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export'])) {
  // Xuất file Excel
  exportToExcel($rows);
}

include_once __DIR__ . '/../src/partials/header2.php'
?>
<div class="container">
    <div class="row mb-3">
        <div class="col d-flex justify-content-center ">
            <form class="d-flex align-items-center" method="GET" action="/thethuvien2.php" class="w-100">
                <input class="m-2" type="search" placeholder="Nhập số thẻ" aria-label="search" name="keyword"
                    value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <a href="/them_ttv2.php" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Thêm thẻ thư viện
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
                        <th>Số thẻ</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>

                    <tr>
                        <td><?= html_escape($row['soThe']) ?></td>
                        <td><?= html_escape($row['ngayBD']) ?></td>
                        <td><?= html_escape($row['ngayKT']) ?></td>
                        <td><?= html_escape($row['ghiChu']) ?></td>

                        <td class="d-flex justify-content-center">
                            <a href="<?= 'sua_ttv2.php?soThe=' . $row['soThe'] ?>" class="btn btn-xs btn-warning mr-1">
                                Sửa</a>
                            <div style="width: 10px;"></div>
                            <form class="form-inline ml-1" action="/xoa_ttv2.php" method="POST">
                                <input type="hidden" name="soThe" value="<?= $row['soThe'] ?>">
                                <button id="delete-sach-btn" type="button" class="btn btn-xs btn-danger  delete-btn"
                                    data-toggle="modal" name="delete-ttv" data-target="#delete-confirm">
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
                        <div class="modal-body">
                        </div>
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