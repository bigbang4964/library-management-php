<?php ob_start(); ?>
<h2><?= isset($data['book']) ? '✏️ Chỉnh sửa sách' : '➕ Thêm sách mới' ?></h2>

<form method="post" action="<?= isset($data['book']) ? '/Book/update/'.$data['book']['book_id'] : '/Book/store' ?>" class="mt-3">
  <div class="mb-3">
    <label class="form-label">Tên sách</label>
    <input type="text" name="title" class="form-control" value="<?= $data['book']['title'] ?? '' ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Tác giả</label>
    <input type="text" name="author_id" class="form-control" value="<?= $data['book']['author_id'] ?? '' ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Năm xuất bản</label>
    <input type="number" name="publish_year" class="form-control" value="<?= $data['book']['publish_year'] ?? '' ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Tổng số bản</label>
    <input type="number" name="total_copies" class="form-control" value="<?= $data['book']['total_copies'] ?? '1' ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Mô tả</label>
    <textarea name="description" class="form-control"><?= $data['book']['description'] ?? '' ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Lưu</button>
  <a href="/Book/index" class="btn btn-secondary">Hủy</a>
</form>
<?php $content = ob_get_clean(); include __DIR__ . "/../layouts/main.php"; ?>
