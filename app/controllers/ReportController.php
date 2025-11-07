<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // nếu dùng composer cho php-pdf

use TCPDF; // ví dụ sử dụng thư viện php-pdf phổ biến (TCPDF)

class ReportController extends Controller {

    public function index() {
        $reportModel = $this->model('Report');
        $month = $_GET['month'] ?? null;
        $year  = $_GET['year'] ?? null;

        $data = $reportModel->getSummary($month, $year);
        $data['topBooks'] = $reportModel->getTop5Books($month, $year);
        $data['monthlyStats'] = $reportModel->getMonthlyBorrowStats($year);
        $data['selectedMonth'] = $month;
        $data['selectedYear'] = $year;

        $this->view('reports/index', $data);
    }

    public function exportPdf() {
        $reportModel = $this->model('Report');
        $month = $_GET['month'] ?? null;
        $year  = $_GET['year'] ?? null;

        $data = $reportModel->getSummary($month, $year);
        $topBooks = $reportModel->getTop5Books($month, $year);

        // --- Tạo PDF bằng TCPDF ---
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Báo cáo thư viện');
        $pdf->AddPage();

        $html = "
        <h2>Báo cáo thống kê thư viện</h2>
        <p>Tháng: " . ($month ?: 'Tất cả') . " / Năm: " . ($year ?: date('Y')) . "</p>
        <h4>Tổng hợp</h4>
        <ul>
            <li><b>Tổng độc giả:</b> {$data['totalUsers']}</li>
            <li><b>Tổng sách:</b> {$data['totalBooks']}</li>
            <li><b>Lượt mượn:</b> {$data['totalBorrowsMonth']}</li>
        </ul>

        <h4>Top 5 sách được mượn nhiều nhất</h4>
        <table border='1' cellpadding='5'>
            <tr><th>#</th><th>Tên sách</th><th>Lượt mượn</th></tr>";

        foreach ($topBooks as $i => $book) {
            $html .= "<tr><td>".($i+1)."</td><td>{$book['title']}</td><td>{$book['borrow_count']}</td></tr>";
        }

        $html .= "</table>";

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output("BaoCaoThuVien.pdf", "I"); // I: hiển thị, D: tải về
    }
}
