<?php
    $x = $_POST['number'];

    function is_prime($number) {
        if ($number <= 1) {
            return false;
        }

        for ($i = 2; $i * $i <= $number; $i++) {
            if ($number % $i == 0) {
                return false; 
            }
        }
        return true;
    }

    if(is_prime($x) == true) {
        echo "$x la so nguyen to";
    }
    else {
        echo "$x khong phai so nguyen to";
    }
?>