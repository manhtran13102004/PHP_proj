<?php
$date = $_POST['date'];

function isValidDate($date) {
    // YYYY-MM-DD
    if (strlen($date) != 10 || $date[4] != '-' || $date[7] != '-') {
        return false;
    }
    list($ngay, $thang, $nam) = explode('-', $date);
    // Kiểm tra năm, tháng, ngày có phải là số hợp lệ
    if (!is_numeric($nam) || !is_numeric($thang) || !is_numeric($ngay)) {
        return false;
    }

    // Kiểm tra tháng có hợp lệ (1 - 12)
    if ($thang < 1 || $thang > 12) {
        return false;
    }
    return true;
}

if (isValidDate($date) == true) {
    echo "Ngay hop le.";
}
else {
    echo "Ngay khong hop le";
}
?>