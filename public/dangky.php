<?php
include __DIR__ . '/../src/connect.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (strlen($fullname) < 5) {
        $errors['fullname'] = "Họ tên ít nhất 5 kí tự";
    }
    if (strlen($username) < 5) {
        $errors['username'] = "Tên đăng nhập ít nhất 5 kí tự";
    }

    if (strlen($password) < 8) {
        $errors['password'] = "Mật khẩu ít nhất 8 kí tự";
    }

    if ($password_confirm !== $password) {
        $errors['password_confirm'] = "Mật khẩu không khớp";
    }

    $stmt = $pdo->prepare("SELECT id FROM taikhoan WHERE tenDN = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        $errors['username'] = "Tên đăng nhập đã tồn tại.";
    }

    // Nếu không có lỗi, thêm người dùng mới vào cơ sở dữ liệu
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO taikhoan (tenDayDu, tenDN, matKhau) VALUES (?, ?, ?)");
        if ($stmt->execute([$fullname, $username, $hashed_password])) {
            
            echo "<script>
                    alert ('Đăng ký thành công!')
                    setTimeout(function() {
                        window.location.href = 'dangnhap.php';
                    }, 1000); // Chuyển hướng sau 2 giây
                </script>";

            exit();
        } else {
            $errors[] = "Đã xảy ra lỗi khi đăng ký. Vui lòng thử lại sau.";
        }
    }
}

?>

<?php
include_once __DIR__. '/../src/partials/header.php'
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h2 class="text-center mb-4">Đăng ký</h2>
            <form id="registerForm" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control <?= isset($errors['fullname']) ? 'is-invalid' : '' ?>"
                        id="fullname" name="fullname"
                        value="<?= isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : '' ?>" required>
                    <?php if (isset($errors['fullname'])) : ?>
                    <span class="text-danger">
                        <strong><?=$errors['fullname'] ?></strong>
                    </span>
                    <?php endif ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                        id="username" name="username"
                        value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" required>
                    <?php if (isset($errors['username'])) : ?>
                    <span class="text-danger"><?= $errors['username'] ?></span>
                    <?php endif ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control <?= isset($errors['password']) ? ' is-invalid' : '' ?>"
                        id="password" name="password" required>
                    <?php if (isset($errors['password'])) : ?>
                    <span class="text-danger"><?= $errors['password'] ?></span>
                    <?php endif ?>
                </div>
                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password"
                        class="form-control <?= isset($errors['password_confirmation']) ? ' is-invalid' : '' ?>"
                        id="password_confirm" name="password_confirm" required>
                    <?php if (isset($errors['password_confirm'])) : ?>
                    <span class="text-danger"><?= $errors['password_confirm'] ?></span>
                    <?php endif ?>
                </div>
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </form>
            <div class="text-center mt-3">
                <p>Bạn đã có tài khoản? <a href="dangnhap.php">Đăng nhập ngay</a>.</p>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>
<?php
include_once __DIR__. '/../src/partials/footer.php'
?>