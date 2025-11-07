<?php ob_start(); ?>
<h2><?= isset($data['user']) ? '✏️ Chỉnh sửa thông tin độc giả' : '➕ Thêm độc giả mới' ?></h2>

<form method="post" action="<?= isset($data['user']) ? '/User/update/'.$data['user']['user_id'] : '/User/store' ?>" class="mt-3">
  <div class="mb-3">
    <label class="form-label">Họ tên</label>
    <input type="text" name="full_name" class="form-control" required value="<?= $data['user']['full_name'] ?? '' ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="<?= $data['user']['email'] ?? '' ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Điện thoại</label>
    <input type="text" name="phone" class="form-control" value="<?= $data['user']['phone'] ?? '' ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Địa chỉ</label>
    <textarea name="address" class="form-control"><?= $data['user']['address'] ?? '' ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Lưu</button>
  <a href="/User/index" class="btn btn-secondary">Hủy</a>
</form>
<?php $content = ob_get_clean(); include __DIR__ . "/../layouts/main.php"; ?>
