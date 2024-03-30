<?php
require_once __DIR__ . '/../src/connect.php';
session_start();

$error_message = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem có tồn tại username và password không
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Kết nối CSDL và lấy dữ liệu đăng nhập từ form
        

        // Kiểm tra thông tin đăng nhập
        $stmt = $pdo->prepare("SELECT * FROM taiKhoan WHERE tenDN = ?");
        $stmt->execute([$_POST['username']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if(password_verify($_POST['password'], $user['matKhau'])) {
                // Đăng nhập thành công
                $_SESSION['username'] = $_POST['username'];
                if ($user['quyen'] == 'admin') {
                    redirect('index2.php');
                    exit(); // Kết thúc quá trình xử lý và chuyển hướng
                } else {
                    redirect('index.php');
                    exit(); // Kết thúc quá trình xử lý và chuyển hướng
                }
            } else {
                $error_message = "Mật khẩu không đúng.";
            }
        } else {
            // Đăng nhập thất bại
            $error_message = "Tên đăng nhập không tồn tại.";
        }
    }else {
        $error_message = "Vui lòng nhập đầy đủ thông tin.";
    }
    
}
if ($error_message) {
    include __DIR__ . '/../src/partials/show_error.php';
}
?>

<?php
include_once __DIR__. '/../src/partials/header.php'
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h2 class="text-center mb-4">Đăng nhập</h2>
            <form method="post" action="dangnhap.php" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Nhập tên đăng nhập" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Nhập mật khẩu" required>

                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
            <div class="text-center mt-3">
                <p>Bạn chưa có tài khoản? <a href="dangky.php">Đăng ký ngay</a>.</p>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__. '/../src/partials/footer.php'
?>