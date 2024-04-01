<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lí thư viện</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
</head>

<body>
    <div class="container-fluid header mb-3">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="index2.php" class="title">Quản lí Thư Viện</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <?php if (isset($_SESSION['username'])) : ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-reset" aria-current="page" href="qlsach2.php">Sách</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="tacgia2.php">Tác giả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="theloai2.php">Thể loại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="nxb2.php">Nhà xuất bản</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="docgia2.php">Độc giả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="thethuvien2.php">Thẻ thư viện</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="nhanvien2.php">Nhân viên</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="muontra.php">Mượn trả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="thongke2.php">Thống kê</a>
                        </li>
                    </ul>
                    <?php endif; ?>
                    <ul class="account mx-3">
                        <?php if(isset($_SESSION['username'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false"><?php echo $_SESSION['username']; ?></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="dangxuat.php">Đăng xuất</a></li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false">Tài khoản</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="dangky.php">Đăng ký</a></li>
                                <li><a class="dropdown-item" href="dangnhap.php">Đăng nhập</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>