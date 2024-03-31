<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__. '/../src/partials/header.php';

if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
    echo "<script>
            alert('Bạn đã đăng xuất.');
            window.location.href = 'index.php';
        </script>";
}


include_once __DIR__ . '/../src/partials/footer.php';