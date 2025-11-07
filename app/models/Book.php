<?php
class Book extends Model {
    public function getAllBooks() {
        $stmt = $this->db->query("SELECT * FROM books ORDER BY title ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookById($id) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE book_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $sql = "INSERT INTO books (title, author_id, publish_year, total_copies, available_copies, description)
                VALUES (:title, :author_id, :publish_year, :total_copies, :available_copies, :description)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':title' => $data['title'],
            ':author_id' => $data['author_id'] ?: null,
            ':publish_year' => $data['publish_year'] ?: null,
            ':total_copies' => $data['total_copies'] ?: 1,
            ':available_copies' => $data['total_copies'] ?: 1,
            ':description' => $data['description'] ?? ''
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE books SET title=:title, author_id=:author_id, publish_year=:publish_year,
                total_copies=:total_copies, description=:description WHERE book_id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':title' => $data['title'],
            ':author_id' => $data['author_id'],
            ':publish_year' => $data['publish_year'],
            ':total_copies' => $data['total_copies'],
            ':description' => $data['description']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM books WHERE book_id = ?");
        $stmt->execute([$id]);
    }
}
