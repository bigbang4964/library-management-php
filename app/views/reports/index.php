<?php ob_start(); ?>
<h2 class="mb-4">📊 Báo cáo thống kê thư viện</h2>

<div class="row text-center mb-4">
  <div class="col-md-4">
    <div class="card shadow-sm border-primary">
      <div class="card-body">
        <h5 class="card-title text-primary">👥 Tổng số độc giả</h5>
        <h3><?= $data['totalUsers'] ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm border-success">
      <div class="card-body">
        <h5 class="card-title text-success">📚 Tổng số sách</h5>
        <h3><?= $data['totalBooks'] ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm border-warning">
      <div class="card-body">
        <h5 class="card-title text-warning">🔁 Lượt mượn tháng này</h5>
        <h3><?= $data['totalBorrowsMonth'] ?></h3>
      </div>
    </div>
  </div>
</div>

<h4 class="mt-5">🏆 Top 5 sách được mượn nhiều nhất</h4>
<table class="table table-striped mt-3">
  <thead class="table-dark">
    <tr>
      <th>#</th>
      <th>Tên sách</th>
      <th>Số lượt mượn</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['topBooks'] as $i => $book): ?>
      <tr>
        <td><?= $i + 1 ?></td>
        <td><?= htmlspecialchars($book['title']) ?></td>
        <td><?= $book['borrow_count'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<h4 class="mt-5 mb-3">📈 Biểu đồ lượt mượn theo tháng</h4>
<canvas id="borrowChart" height="100"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('borrowChart').getContext('2d');
const chartData = {
    labels: <?= json_encode(array_column($data['monthlyStats'], 'month')) ?>,
    datasets: [{
        label: 'Số lượt mượn',
        data: <?= json_encode(array_column($data['monthlyStats'], 'total')) ?>,
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgb(54, 162, 235)',
        borderWidth: 2
    }]
};
new Chart(ctx, {
    type: 'bar',
    data: chartData,
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
<?php $content = ob_get_clean(); include __DIR__ . "/../layouts/main.php"; ?>
