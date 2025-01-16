<?php
    $ngay1 = $_POST['ngay1'];
    $ngay2 = $_POST['ngay2'];

    list($d1, $m1) = explode('-', $ngay1);
    list($d2, $m2) = explode('-', $ngay2);

    $result = abs(($m2-$m1)*30 + ($d2-$d1));
    echo "Tong so ngay giua $ngay1 va $ngay2 la: ".$result. " ngay";
?>