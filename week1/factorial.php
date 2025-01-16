<?php
    $number = $_POST['number'];

    // Hàm tính giai thừa
    function factorial($n) {
        if ($n <= 1) {
            return 1;
        } else {
            return $n * factorial($n - 1);
        }
    }

    function factorial1($n) {
        if ($n < 0) {
            echo 'Khong tinh duoc. ';
            return -1;
        }
        $result = 1;
        while ($n >= 1) {
            $result = $result * $n;
            $n -= 1;
        }
        return $result;
    }

    echo "Giai thừa của " . $number . " là: " . factorial1($number);
     
?>