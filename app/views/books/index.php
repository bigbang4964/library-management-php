<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>📖 Danh sách sách</h2>
    <a href="/Book/add" class="btn btn-success"><i class="fa-solid fa-plus"></i> Thêm sách</a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tên sách</th>
            <th>Tác giả</th>
            <th>Năm XB</th>
            <th>Số lượng</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['books'])): ?>
            <?php foreach ($data['books'] as $book): ?>
                <tr>
                    <td><?= $book['book_id'] ?></td>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= $book['author_id'] ?></td>
                    <td><?= $book['publish_year'] ?></td>
                    <td><?= $book['available_copies'] ?>/<?= $book['total_copies'] ?></td>
                    <td>
                        <a href="/Book/detail/<?= $book['book_id'] ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                        <a href="/Book/edit/<?= $book['book_id'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a>
                        <a href="/Book/delete/<?= $book['book_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa sách này?');"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" class="text-center text-muted">Chưa có dữ liệu sách</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $content = ob_get_clean(); include __DIR__ . "/../layouts/main.php"; ?>
