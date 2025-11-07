<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>📚 Quản lý mượn / trả sách</h2>
    <a href="/Borrow/add" class="btn btn-success"><i class="fa fa-plus"></i> Thêm lượt mượn</a>
</div>

<table class="table table-hover table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Người mượn</th>
            <th>Tên sách</th>
            <th>Ngày mượn</th>
            <th>Ngày trả</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['records'])): ?>
            <?php foreach ($data['records'] as $r): ?>
            <tr>
                <td><?= $r['borrow_id'] ?></td>
                <td><?= htmlspecialchars($r['user_name']) ?></td>
                <td><?= htmlspecialchars($r['book_title']) ?></td>
                <td><?= $r['borrow_date'] ?></td>
                <td><?= $r['return_date'] ?: '-' ?></td>
                <td>
                    <?php if ($r['status'] === 'Đang mượn'): ?>
                        <span class="badge bg-warning text-dark"><?= $r['status'] ?></span>
                    <?php else: ?>
                        <span class="badge bg-success"><?= $r['status'] ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($r['status'] === 'Đang mượn'): ?>
                        <a href="/Borrow/returnBook/<?= $r['borrow_id'] ?>" class="btn btn-sm btn-primary">
                            <i class="fa fa-undo"></i> Trả
                        </a>
                    <?php endif; ?>
                    <a href="/Borrow/delete/<?= $r['borrow_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa lượt mượn này?');">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7" class="text-center text-muted">Chưa có lượt mượn nào</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $content = ob_get_clean(); include __DIR__ . "/../layouts/main.php"; ?>
