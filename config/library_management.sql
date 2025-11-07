-- =========================================================
--  Library Management System - PostgreSQL Schema
--  Tác giả: ChatGPT
--  Mục đích: Hệ thống quản lý thư viện (PHP + pgAdmin4 + Nginx)
--  Phiên bản: 1.0
-- =========================================================

-- Xóa database cũ nếu có (chỉ chạy khi cần)
-- DROP DATABASE IF EXISTS library_db;

-- Tạo database mới
CREATE DATABASE library_db
    WITH ENCODING 'UTF8'
    LC_COLLATE='en_US.utf8'
    LC_CTYPE='en_US.utf8'
    TEMPLATE=template0;

-- Chuyển vào database vừa tạo
\c library_db;

-- =========================================================
-- Bảng người dùng (users)
-- =========================================================
CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    role VARCHAR(20) CHECK (role IN ('admin', 'librarian', 'reader')) DEFAULT 'reader',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- Bảng tác giả (authors)
-- =========================================================
CREATE TABLE authors (
    author_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    biography TEXT
);

-- =========================================================
-- Bảng nhà xuất bản (publishers)
-- =========================================================
CREATE TABLE publishers (
    publisher_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255),
    phone VARCHAR(20)
);

-- =========================================================
-- Bảng thể loại sách (categories)
-- =========================================================
CREATE TABLE categories (
    category_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

-- =========================================================
-- Bảng sách (books)
-- =========================================================
CREATE TABLE books (
    book_id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author_id INT REFERENCES authors(author_id) ON DELETE SET NULL,
    publisher_id INT REFERENCES publishers(publisher_id) ON DELETE SET NULL,
    category_id INT REFERENCES categories(category_id) ON DELETE SET NULL,
    publish_year INT,
    total_copies INT DEFAULT 1,
    available_copies INT DEFAULT 1,
    description TEXT,
    cover_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- Bảng bản sao của sách (book_copies)
-- =========================================================
CREATE TABLE book_copies (
    copy_id SERIAL PRIMARY KEY,
    book_id INT NOT NULL REFERENCES books(book_id) ON DELETE CASCADE,
    barcode VARCHAR(50) UNIQUE NOT NULL,
    conditions VARCHAR(50) DEFAULT 'good',
    status VARCHAR(20) CHECK (status IN ('available', 'borrowed', 'damaged', 'lost')) DEFAULT 'available'
);

-- =========================================================
-- Bảng phiếu mượn (borrow_records)
-- =========================================================
CREATE TABLE borrow_records (
    record_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    borrow_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    due_date DATE,
    return_date DATE,
    status VARCHAR(20)
        CHECK (status IN ('borrowed', 'returned', 'overdue'))
        DEFAULT 'borrowed',
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE
);


-- =========================================================
-- (Tùy chọn) Bảng đặt sách trước (reservations)
-- =========================================================
CREATE TABLE reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    reservation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20)
        CHECK (status IN ('pending', 'collected', 'cancelled'))
        DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE
);


-- =========================================================
-- (Tùy chọn) Bảng tiền phạt (fines)
-- =========================================================
CREATE TABLE fines (
    fine_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(user_id) ON DELETE CASCADE,
    record_id INT REFERENCES borrow_records(record_id) ON DELETE CASCADE,
    amount NUMERIC(10,2) DEFAULT 0,
    paid BOOLEAN DEFAULT FALSE,
    issued_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- Bảng nhật ký hoạt động (activity_logs)
-- =========================================================
CREATE TABLE activity_logs (
    log_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(user_id) ON DELETE SET NULL,
    action VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- Tạo một số dữ liệu mẫu
-- =========================================================

-- Người dùng mẫu
INSERT INTO users (username, password, fullname, email, role)
VALUES 
('admin', 'admin123', 'Admin System', 'admin@library.com', 'admin'),
('librarian1', 'lib123', 'Nguyễn Văn Thủ Thư', 'librarian@library.com', 'librarian'),
('reader1', 'reader123', 'Trần Thị Độc Giả', 'reader@library.com', 'reader');

-- Tác giả mẫu
INSERT INTO authors (name) VALUES 
('J.K. Rowling'), 
('George R.R. Martin'),
('Nguyễn Nhật Ánh');

-- Nhà xuất bản mẫu
INSERT INTO publishers (name) VALUES 
('NXB Trẻ'),
('NXB Kim Đồng'),
('NXB Giáo Dục');

-- Thể loại mẫu
INSERT INTO categories (name) VALUES 
('Fantasy'),
('Fiction'),
('Thiếu nhi');

-- Sách mẫu
INSERT INTO books (title, author_id, publisher_id, category_id, publish_year, total_copies, available_copies)
VALUES
('Harry Potter và Hòn đá Phù thủy', 1, 2, 1, 2003, 5, 5),
('Game of Thrones', 2, 3, 1, 2011, 3, 3),
('Tôi Thấy Hoa Vàng Trên Cỏ Xanh', 3, 1, 3, 2015, 4, 4);

-- =========================================================
-- Kết thúc file
-- =========================================================
