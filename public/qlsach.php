<?php
require_once __DIR__ . '/../src/connect.php';
// Gọi procedure để hiển thị thông tin sách
$sql = "CALL hthiSach()";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

include_once __DIR__. '/../src/partials/header.php'
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">

            <a href="/them_sach.php" class="btn btn-primary mb-3">
                <i class="fa-solid fa-plus"></i></i> Thêm sách
            </a>
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
                            <a href="<?= 'sua_sach.php?maSach=' . $row['maSach'] ?>"
                                class="btn btn-xs btn-warning mr-1">
                                <i alt="Edit" class="fa fa-pencil"></i>
                                Sửa</a>
                            <div style="width: 10px;"></div>
                            <form class="form-inline ml-1" action="/xoa_sach.php" method="POST">
                                <input type="hidden" name="maSach" value="<?= $row['maSach'] ?>">
                                <button id="delete-sach-btn" type="button" class="btn btn-xs btn-danger  delete-btn"
                                    data-toggle="modal" name="delete-sach" data-target="#delete-confirm">
                                    <i alt="Delete" class="fa fa-trash"></i></i>Xóa
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