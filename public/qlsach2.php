<?php
require_once __DIR__ . '/../src/connect.php';
// Gọi procedure 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sort'])) {
    // Gọi procedure để sắp xếp sách theo tên
    $sql = "CALL sapXepSach()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
    $sql = "CALL timKiemSach(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$keyword]);
}
else {
    // Nếu không có yêu cầu sắp xếp, hiển thị thông tin sách bình thường
    $sql = "CALL hthiSach()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
 
}

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

include_once __DIR__. '/../src/partials/header2.php'
?>
<div class="container">
    <div class="row mb-3">
        <div class="col d-flex justify-content-center ">
            <form class="d-flex align-items-center" method="GET" action="/qlsach2.php" class="w-100">
                <input class="m-2" type="search" placeholder="Nhập tên sách" aria-label="search" name="keyword">
                <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <a href="/them_sach2.php" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Thêm sách
            </a>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <form method="post">
                <button class="btn btn-secondary" type="submit" name="sort">
                    Sắp xếp
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">


            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th>Mã sách</th>
                        <th>Tên sách</th>
                        <th>Tác giả</th>
                        <th>Thể loại</th>
                        <th>Nhà xuất bản</th>
                        <th>Năm xuất bản</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>

                    <tr>
                        <td><?= html_escape($row['maSach']) ?></td>
                        <td><?= html_escape($row['tenSach']) ?></td>
                        <td><?= html_escape($row['tenTG']) ?></td>
                        <td><?= html_escape($row['tenTL']) ?></td>
                        <td><?= html_escape($row['tenNXB']) ?></td>
                        <td><?= html_escape($row['namXuatBan']) ?></td>
                        <td class="d-flex justify-content-center">
                            <a href="<?= 'sua_sach2.php?maSach=' . $row['maSach'] ?>"
                                class="btn btn-xs btn-warning mr-1">
                                Sửa</a>
                            <div style="width: 10px;"></div>
                            <form class="form-inline ml-1" action="/xoa_sach2.php" method="POST">
                                <input type="hidden" name="maSach" value="<?= $row['maSach'] ?>">
                                <button id="delete-sach-btn" type="button" class="btn btn-xs btn-danger  delete-btn"
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