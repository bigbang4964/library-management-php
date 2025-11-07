<?php
require_once 'config/Database.php';
$db = Database::getInstance()->getConnection();
echo "✅ Kết nối MySQL thành công!";
