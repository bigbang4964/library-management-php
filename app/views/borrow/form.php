<?php ob_start(); ?>
<h2>➕ Thêm lượt mượn mới</h2>

<form method="post" action="/Borrow/store" class="mt-3">
  <div class="mb-3">
    <label class="form-label">Người mượn</label>
    <select name="user_id" class="form-select" required>
      <option value="">-- Chọn người đọc --</option>
      <?php foreach ($data['users'] as $u): ?>
        <option value="<?= $u['user_id'] ?>"><?= htmlspecialchars($u['full_name']) ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Chọn sách</label>
    <select name="book_id" class="form-select" required>
      <option value="">-- Chọn sách --</option>
      <?php foreach ($data['books'] as $b): ?>
        <option value="<?= $b['book_id'] ?>">
            <?= htmlspecialchars($b['title']) ?> (Còn <?= $b['available_copies'] ?>)
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Ngày trả dự kiến</label>
    <input type="date" name="return_date" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Lưu</button>
  <a href="/Borrow/index" class="btn btn-secondary">Hủy</a>
</form>
<?php $content = ob_get_clean(); include __DIR__ . "/../layouts/main.php"; ?>
