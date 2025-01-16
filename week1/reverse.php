<?php
    $chuoi = $_POST['text'];
    $n = strlen($chuoi);
    $result = '';

    for($i=$n-1; $i >= 0; $i--) {
        $result .= $chuoi[$i];
    }

    echo "Chuoi dao nguoc: $result";
;
?>