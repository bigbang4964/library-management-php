<?php
class Report extends Model {

    public function getSummary($month = null, $year = null) {
        $where = "";
        $params = [];

        if ($month && $year) {
            $where = "WHERE DATE_PART('month', borrow_date) = :month AND DATE_PART('year', borrow_date) = :year";
            $params = [':month' => $month, ':year' => $year];
        }

        $stmt1 = $this->db->query("SELECT COUNT(*) FROM users");
        $stmt2 = $this->db->query("SELECT COUNT(*) FROM books");

        $stmt3 = $this->db->prepare("SELECT COUNT(*) FROM borrows $where");
        $stmt3->execute($params);

        return [
            'totalUsers' => $stmt1->fetchColumn(),
            'totalBooks' => $stmt2->fetchColumn(),
            'totalBorrowsMonth' => $stmt3->fetchColumn()
        ];
    }

    public function getTop5Books($month = null, $year = null) {
        $where = "";
        $params = [];

        if ($month && $year) {
            $where = "WHERE DATE_PART('month', b.borrow_date) = :month AND DATE_PART('year', b.borrow_date) = :year";
            $params = [':month' => $month, ':year' => $year];
        }

        $sql = "
            SELECT bk.title, COUNT(*) AS borrow_count
            FROM borrow_details bd
            JOIN borrows b ON b.borrow_id = bd.borrow_id
            JOIN books bk ON bk.book_id = bd.book_id
            $where
            GROUP BY bk.book_id
            ORDER BY borrow_count DESC
            LIMIT 5
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMonthlyBorrowStats($year = null) {
        $params = [];
        $where = "";
        if ($year) {
            $where = "WHERE DATE_PART('year', borrow_date) = :year";
            $params = [':year' => $year];
        }

        $sql = "
            SELECT TO_CHAR(borrow_date, 'YYYY-MM') AS month, COUNT(*) AS total
            FROM borrows
            $where
            GROUP BY month
            ORDER BY month
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
