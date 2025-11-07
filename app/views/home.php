<?php ob_start(); ?>
<div class="text-center">
    <h1 class="my-4">📚 Hệ thống Quản lý Thư viện</h1>
    <p class="lead">Quản lý sách, người dùng, và mượn trả dễ dàng.</p>
    <a href="/Book/index" class="btn btn-primary"><i class="fa-solid fa-book"></i> Quản lý sách</a>
</div>
<?php $content = ob_get_clean(); include __DIR__ . "/layouts/main.php"; ?>
