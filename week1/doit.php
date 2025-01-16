
<!-- FUNCTIONS -->

<?php
    session_start();

    if (isset($_POST['reset_session'])) {
        session_unset();  // Clears all session variables
        session_destroy();  // Destroys the session (optional)
        // Start a fresh session again if needed
        session_start();  // Starts a new session with a fresh session ID
    }

    function giaithua($x) {
        if ($x == 1 || $x == 0) {
            return 1;
        }
        else if ($x < 0) {
            return ("Không thể tính giai thừa của số âm");
        }
        return ($x * giaithua($x - 1));
    }

    function nto($x) {
        if ($x <= 1) {
            return false;
        }
        for ($i = 2; $i*$i <= $x; $i++) {
            if ($x % $i == 0) {
                return false;
            }
        }
        return true;
    }

    function reverse($x) {
        $new_string = "";
        for ($i = strlen($x)-1; $i >= 0; $i--) {
            $new_string .= $x[$i];
        }
        return $new_string;
    }

    function ktra_in_thuong($x) {
        for ($i = 0; $i < strlen($x); $i++) {
            if (!ctype_lower($x[$i])) {
                return "Không phải in thường";
            }
        }
        return "Là chuỗi in thường";
    }

    function valid_date($x) {
        if (!empty($x)) {
            // Kiểm tra tính hợp lệ của ngày tháng
            $timestamp = strtotime($x);
            if ($timestamp !== false) {
                // Định dạng lại ngày để hiển thị
                $formattedDate = date("d-m-Y", $timestamp);
                return "Ngày hợp lệ: " . $formattedDate;
            } else {
                return "Ngày không hợp lệ!";
            }
        } else {
            return "Vui lòng nhập vào ngày tháng!";
        }
    }

    function datediff($date1, $date2) {
        // Convert input strings to DateTime objects
        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);

        // Calculate the difference between the two dates
        $diff = date_diff($datetime1, $datetime2);

        // Return the difference as a DateInterval object
        return $diff->format('%y years, %m months, %d days');;
    }

    function normalize($x) {
        $x = trim($x);

        // Chuyển đổi thành chữ thường (nếu cần thiết)
        $x = strtolower($x);
        
        return $x;
    }
?>



<!-- RUN -->


<form action="" method="POST">
    <input type="number" name="b1">
    <input type="submit" value="tính giai thừa">
</form>

<?php
    if (isset($_POST['b1'])) {
        $_SESSION['b1'] = $_POST['b1'];
    }
    if (isset($_SESSION['b1'])) {
        echo "Giai thừa của {$_SESSION['b1']} là: ".giaithua($_SESSION['b1']);
        echo "<br>";
    }
?>

<form action="" method="POST">
    <input type="number" name="b2">
    <input type="submit" value="kiểm tra số nto">
</form>
<?php
    if (isset($_POST['b2'])) {
        $_SESSION['b2'] = $_POST['b2'];
    }
    if (isset($_SESSION['b2'])) {
        $number = $_SESSION['b2'];
        if (nto($number) == true) {
            echo "Là số nguyên tố";
        }
        else {
            echo "Không phải số nguyên tố";
        }
    }
?>


<form action="" method="POST">
    <input type="text" name="b3">
    <input type="submit" value="đảo ngược chuỗi">
</form>
<?php
    if (isset($_POST['b3'])) {
        $_SESSION['b3'] = $_POST['b3'];
    }
    if (isset($_SESSION['b3'])) {
        $chuoi = $_SESSION['b3'];
        echo "Chuỗi đảo ngược của {$_SESSION['b3']} là ".reverse($_SESSION['b3']);
    }
?>


<form action="" method="POST">
    <input type="text" name="b4">
    <input type="submit" value="kiểm tra in thường">
</form>
<?php
    if (isset($_POST['b4'])) {
        $_SESSION['b4'] = $_POST['b4'];
    }
    if (isset($_SESSION['b4'])) {
        echo  ktra_in_thuong($_SESSION['b4']);
        echo "<br>";
    }
?>



<form action="" method="POST">
    <input type="date" name="b5">
    <input type="submit" value="Kiểm tra hợp lệ ngày tháng">
</form>
<?php
    if (isset($_POST['b5'])) {
        $_SESSION['b5'] = $_POST['b5'];
    }
    if (isset($_SESSION['b5'])) {
        echo valid_date($_SESSION['b5']);
        echo "<br>";
    }
?>

<form action="" method="POST">
    <input type="date" name="b6a">
    <input type="date" name="b6b">
    <input type="submit" value="số ngày giữa 2 mốc">
</form>
<?php
    if (isset($_POST['b6a']) && isset($_POST['b6b'])) {
        $_SESSION['b6a'] = $_POST['b6a'];
        $_SESSION['b6b'] = $_POST['b6b'];
    }
    if (isset($_SESSION['b6a']) && isset($_SESSION['b6b'])) {
        echo datediff($_SESSION['b6a'], $_SESSION['b6b']);
    }

?>


<form action="" method="POST">
    <input type="text" name="b7">
    <input type="submit" value="chuẩn hóa văn bản">
</form>
<?php
    if (isset($_POST['b7'])) {
        $_SESSION['b7'] = $_POST['b7'];
    }
    if (isset($_SESSION['b7'])) {
        echo  "Văn bản sau khi được chuẩn hóa: <br>".normalize($_SESSION['b7']);
        echo "<br>";
    }
?>

<form method="POST">
    <button type="submit" name="reset_session">RESET</button>
</form>

