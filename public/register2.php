<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lí thư viện</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="public/css/fonts/fontawesome-free-6.3.0-web/fontawesome-free-6.3.0-web/css/all.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container-fluid header mb-3">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="index.html" class="title">Quản lí Thư Viện</a>
                <div class="vertical-line"></div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-reset" aria-current="page" href="index.html">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-reset" href="#">Sản phẩm</a>
                        </li>
                    </ul>
                    <ul class="account">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false">Tài khoản</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Đăng ký</a></li>
                                <li><a class="dropdown-item" href="#">Đăng nhập</a></li>
                                <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="text-center mb-4">Đăng ký</h2>
                <form id="registerForm" method="post">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required minlength="2">
                        <div class="nhapsai"> </div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" name="username" required minlength="2">
                        <div class="nhapsai"> </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" required
                            minlength="8">
                        <div class="nhapsai"> </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            required minlength="8">
                        <div class="nhapsai"> </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>
    <script>
    function formValidate() {
        var fullName = document.getElementById("fullname").value;
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        var errorDiv = document.querySelector('.nhapsai');

        errorDiv.innerHTML = '';

        if (fullName.length < 2) {
            errorDiv.innerHTML = 'Họ tên phải có ít nhất 2 kí tự<br>';
            return false;
        }

        if (username.length < 2) {
            errorDiv.innerHTML += 'Tên đăng nhập phải có ít nhất 2 kí tự<br>';
            return false;
        }

        if (password.length < 8) {
            errorDiv.innerHTML += 'Mật khẩu phải có ít nhất 8 kí tự<br>';
            return false;
        }

        if (password !== confirmPassword) {
            errorDiv.innerHTML += 'Mật khẩu nhập lại không trùng khớp<br>';
            return false;
        }

        return true;
    }
    </script>
    <script src="script.js"></script>
</body>

</html>