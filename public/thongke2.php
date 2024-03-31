<?php
require_once __DIR__ . '/../src/connect.php';

$tongSach = 0;
$tongTG = 0;
$tongTL = 0;
$tongNXB = 0;
$tongDG = 0;
$tongMT = 0;

//sách
$sql = "SELECT COUNT(*) FROM sach";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tongSach = $stmt->fetchColumn();

//tác giả
$sql = "SELECT COUNT(*) FROM tacGia";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tongTG = $stmt->fetchColumn();

//thể loại
$sql = "SELECT COUNT(*) FROM theLoai";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tongTL = $stmt->fetchColumn();

//nhà xuất bản
$sql = "SELECT COUNT(*) FROM nhaXuatBan";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tongNXB = $stmt->fetchColumn();

//độc giả
$sql = "SELECT COUNT(*) FROM docGia";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tongDG = $stmt->fetchColumn();

//độc giả
$sql = "SELECT COUNT(maSach) FROM CTMuonTra WHERE daTra = '0'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tongMT = $stmt->fetchColumn();

include_once __DIR__. '/../src/partials/header2.php'
?>
<div class="container">
    <div class="row">
        <div class="col bg-danger text-white text-center m-3 p-3">
            <p class="hinh"><i class="fa-solid fa-book"></i></p>
            <p class="chu">TỔNG SỐ SÁCH</p>
            <p class="so"><?php echo $tongSach; ?></p>
        </div>

        <div class="col bg-danger-subtle text-center m-3 p-3">
            <p class="hinh"><i class="fa-solid fa-user"></i></p>
            <p class="chu">TÁC GIẢ</p>
            <p class="so"><?php echo $tongTG; ?></p>
        </div>

        <div class="col bg-warning text-white text-center m-3 p-3">
            <p class="hinh"><i class="fa-solid fa-layer-group"></i></p>
            <p class="chu">THỂ LOẠI</p>
            <p class="so"><?php echo $tongTL; ?></p>
        </div>

    </div>
    <div class="row">
        <div class="col bg-success-subtle text-center m-3 p-3">
            <p class="hinh"><i class="fa-solid fa-person-shelter"></i></p>
            <p class="chu">NHÀ XUẤT BẢN</p>
            <p class="so"><?php echo $tongNXB; ?></p>
        </div>

        <div class="col bg-success text-white text-center m-3 p-3">
            <p class="hinh"><i class="fa-solid fa-book-open-reader"></i></p>
            <p class="chu">ĐỘC GIẢ</p>
            <p class="so"><?php echo $tongDG; ?></p>
        </div>

        <div class="col bg-info-subtle text-center m-3 p-3">
            <p class="hinh"><i class="fa-solid fa-book"></i></p>
            <p class="chu">SÁCH ĐÃ CHO MƯỢN</p>
            <p class="so"><?php echo $tongMT; ?></p>
        </div>

    </div>

</div>

</div>


<?php
include_once __DIR__. '/../src/partials/footer.php'
?>