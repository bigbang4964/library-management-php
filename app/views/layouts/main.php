<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Quản lý thư viện' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (icon đẹp hơn) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; }
        .container { margin-top: 30px; }
        footer { margin-top: 50px; text-align: center; color: #666; padding: 10px; }
    </style>
</head>
<body>

<!-- Thanh menu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">📚 Thư viện</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="/Book/index">Sách</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Người dùng</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Mượn / Trả</a></li>
        <li class="nav-item"><a class="nav-link" href="/Borrow/index">Mượn / Trả</a></li>
        <li class="nav-item"><a class="nav-link" href="/User/index">Độc giả</a></li>
        <li class="nav-item"><a class="nav-link" href="/Report/index">Báo cáo</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    <?= $content ?>
</div>

<footer>
    <p>© <?= date('Y') ?> Quản lý Thư viện - PHP MVC + Bootstrap 5</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
