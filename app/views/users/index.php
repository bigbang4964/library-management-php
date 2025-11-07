<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>👥 Danh sách độc giả</h2>
    <a href="/User/add" class="btn btn-success"><i class="fa fa-plus"></i> Thêm độc giả</a>
</div>

<form class="row mb-3" method="get" action="/User/index">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Tìm theo tên hoặc email..." value="<?= htmlspecialchars($data['keyword'] ?? '') ?>">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
    </div>
</form>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Điện thoại</th>
            <th>Địa chỉ</th>
            <th>Ngày tạo</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['users'])): ?>
            <?php foreach ($data['users'] as $u): ?>
                <tr>
                    <td><?= $u['user_id'] ?></td>
                    <td><?= htmlspecialchars($u['full_name']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['phone']) ?></td>
                    <td><?= htmlspecialchars($u['address']) ?></td>
                    <td><?= date('d/m/Y', strtotime($u['created_at'])) ?></td>
                    <td>
                        <a href="/User/edit/<?= $u['user_id'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a>
                        <a href="/User/delete/<?= $u['user_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa độc giả này?');"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7" class="text-center text-muted">Không có dữ liệu</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $content = ob_get_clean(); include __DIR__ . "/../layouts/main.php"; ?>
