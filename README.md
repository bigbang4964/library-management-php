# library-management-php
1. Mục tiêu dự án

Xây dựng website quản lý thư viện, bao gồm các chức năng:

✅ Quản lý sách (thêm, sửa, xóa, tìm kiếm, phân loại)

✅ Quản lý người dùng / độc giả

✅ Quản lý mượn – trả sách

✅ Quản lý nhân viên / thủ thư

✅ Báo cáo, thống kê (sách đang mượn, sách quá hạn, lượt mượn theo tháng,…)

✅ Đăng nhập, phân quyền (Admin, Nhân viên, Độc giả)

⚙️ 2. Công nghệ và độ tương thích
Thành phần	                Vai trò	                                        
PHP	                        Ngôn ngữ backend, xử lý request, kết nối DB	
PostgreSQL (pgAdmin4)	    CSDL, pgAdmin4 dùng để quản trị	
Nginx	                    Web server phục vụ PHP qua PHP-FPM
HTML/CSS/JS	                Giao diện web

=> Bộ stack PHP + PostgreSQL + Nginx.
Đây là một kiến trúc phổ biến trong môi trường production Linux (Ubuntu/Debian).

3. Phân quyền

Admin: Quản lý người dùng, sách, thống kê

Thủ thư: Xử lý mượn/trả

Độc giả: Tìm kiếm sách, xem lịch sử mượn, đặt trước
Ưu – nhược điểm của lựa chọn này

4. Ưu điểm

Dễ triển khai trên server Linux.

PostgreSQL mạnh hơn MySQL về xử lý phức tạp & bảo mật.

Hiệu năng tốt với Nginx.

Dễ mở rộng thành REST API hoặc hệ thống microservice sau này.