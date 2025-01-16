<?php
    $s = $_POST['text'];
    $n = strlen($s);

    $in_thuong = true;
    for($i=0; $i < $n; $i++) {
        if (ctype_lower($s[$i]) == false) {
            $in_thuong = false;
            break;
        }
    }
    if ($in_thuong == true) {
        echo "chuoi in thuong";
    }
    else {
        echo "chuoi khong in thuong";
    }
?>