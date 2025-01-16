<?php
function normalizeString($input) {
    // Loại bỏ khoảng trắng dư thừa ở đầu và cuối chuỗi
    $input = trim($input);

    // Chuyển đổi thành chữ thường (nếu cần thiết)
    $input = strtolower($input);
    
    return $input;
}
    $s = $_GET['text'];
    echo "Chuỗi văn bản sau khi được chuẩn hóa: ".normalizeString($s);
?>