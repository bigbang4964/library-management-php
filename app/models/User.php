<?php
class User extends Model {
    public function getAllUsers($keyword = '') {
        if ($keyword) {
            $stmt = $this->db->prepare("SELECT * FROM users 
                                        WHERE LOWER(full_name) LIKE LOWER(:kw) 
                                           OR LOWER(email) LIKE LOWER(:kw)
                                        ORDER BY created_at DESC");
            $stmt->execute([':kw' => "%$keyword%"]);
        } else {
            $stmt = $this->db->query("SELECT * FROM users ORDER BY created_at DESC");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $sql = "INSERT INTO users (full_name, email, phone, address) 
                VALUES (:full_name, :email, :phone, :address)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':full_name' => $data['full_name'],
            ':email' => $data['email'] ?? null,
            ':phone' => $data['phone'] ?? null,
            ':address' => $data['address'] ?? null
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE users SET 
                    full_name=:full_name,
                    email=:email,
                    phone=:phone,
                    address=:address
                WHERE user_id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':full_name' => $data['full_name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':address' => $data['address']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->execute([$id]);
    }
}
