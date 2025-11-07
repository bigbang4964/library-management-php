<?php
class Borrow extends Model {
    public function getAllRecords() {
        $sql = "SELECT br.*, b.title AS book_title, u.full_name AS user_name
                FROM borrow_records br
                JOIN books b ON br.book_id = b.book_id
                JOIN users u ON br.user_id = u.user_id
                ORDER BY br.borrow_date DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $sql = "INSERT INTO borrow_records (book_id, user_id, borrow_date, return_date, status)
                VALUES (:book_id, :user_id, CURRENT_DATE, :return_date, 'Đang mượn')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':book_id' => $data['book_id'],
            ':user_id' => $data['user_id'],
            ':return_date' => $data['return_date'] ?: null
        ]);

        // Giảm số bản còn lại
        $this->db->prepare("UPDATE books SET available_copies = available_copies - 1 WHERE book_id = ?")
                 ->execute([$data['book_id']]);
    }

    public function markAsReturned($id) {
        // Lấy book_id trước
        $stmt = $this->db->prepare("SELECT book_id FROM borrow_records WHERE borrow_id = ?");
        $stmt->execute([$id]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($record) {
            // Cập nhật trạng thái trả
            $this->db->prepare("UPDATE borrow_records SET status='Đã trả', return_date=CURRENT_DATE WHERE borrow_id=?")
                     ->execute([$id]);

            // Tăng lại số bản
            $this->db->prepare("UPDATE books SET available_copies = available_copies + 1 WHERE book_id=?")
                     ->execute([$record['book_id']]);
        }
    }

    public function delete($id) {
        $this->db->prepare("DELETE FROM borrow_records WHERE borrow_id = ?")->execute([$id]);
    }
}
