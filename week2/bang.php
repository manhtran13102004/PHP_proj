
<!-- Khai bao bien toan cuc-->
<?php

$servername = "localhost"; // Tên máy chủ MySQL
$username = "root";        // Tên đăng nhập MySQL (thường là 'root' cho XAMPP)
$password = "";            // Mật khẩu MySQL (thường trống cho XAMPP)
$dbname = "manhdeptrai";

function hienthibang() {
    // Kết nối tới MySQL
     // Tên cơ sở dữ liệu của bạn
    global $servername, $username, $password, $dbname;
    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    $table_name = "mytable";
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    // Truy vấn để lấy tất cả dữ liệu từ bảng
    $sql = "SELECT * FROM {$table_name}"; // Thay 'tên_bảng' bằng tên bảng bạn muốn hiển thị
    $result = $conn->query($sql);

    // Kiểm tra nếu có kết quả
    if ($result->num_rows > 0) {
        // Tạo bảng HTML để hiển thị dữ liệu
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Ten</th>
                    <th>Sl</th>
                    <th>Dongia</th>
                    <!-- Thêm cột khác nếu cần -->
                </tr>";

        // Lặp qua các hàng trong kết quả truy vấn
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ID"] . "</td>
                    <td>" . $row["ten"] . "</td>
                    <td>" . $row["sl"] . "</td>
                    <td>" . $row["dongia"] . "</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "Không có dữ liệu.";
    }

    // Đóng kết nối
    $conn->close();
}



function suasp($ID) {
    global $servername, $username, $password, $dbname;

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);
    $table_name = "mytable";
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $ID = $_POST['ID'];
}


?>


<?php
if (isset($_POST['hienthibang'])) {
    hienthibang();
}



if (isset($_POST['ID_sua'])) {
    timkiem($_POST['ID_sua']);
}
?>






