
<!-- Khai bao bien toan cuc -->
<?php
    $servername = "localhost"; // Tên máy chủ MySQL
    $username = "root";        // Tên đăng nhập MySQL (thường là 'root' cho XAMPP)
    $password = "";            // Mật khẩu MySQL (thường trống cho XAMPP)
    $dbname = "manhdeptrai";
?>

<h1>CHÀO MỪNG BẠN ĐẾN VỚI CHƯƠNG TRÌNH QUẢN LÝ SẢN PHẨM ĐỘC NHẤT NO1</h1>
<h2>Hãy chọn 1 trong các chức năng dưới đây:</h2>

<h3>1.Hiện danh sách toàn bộ sản phẩm</h3>
<form action="bang.php" method="post">
    <input type="submit" name="hienthibang" value="Hien thi danh sach toan bo san pham">
</form>

<form action="index.php">
    <input type="submit" name="reset" value="RESET">
</form>
<?php
if (isset($_POST['reset'])) {
    session_start();
    session_reset();
}
?>
<h3>2.Thêm sản phẩm</h3>
<div id="lc2"></div>
<form action="index.php" method="post">
    <label for="">ID</label>
    <input type="number" name="ID" required> <br>
    <label for="">ten</label>
    <input type="text" name="ten"> <br>
    <label for="">sl</label>
    <input type="number" name="sl"> <br>
    <label for="">dongia</label>
    <input type="number" name="dongia"> <br>

    <input type="submit" value="Them">
</form>

<?php
function themsp($ID, $ten, $sl, $dongia) {
    global $servername, $username, $password, $dbname;

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);
    $table_name = "mytable";
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    
    $ID = $_POST['ID'];
    $ten = $_POST['ten'];
    $sl = $_POST['sl'];
    $dongia = $_POST['dongia'];

    $sql = "INSERT INTO {$table_name} (`ID`, `ten`, `sl`, `dongia`) 
        VALUES ('$ID','$ten','$sl','$dongia')";

    $result = $conn->query($sql);

    echo "Them thanh cong";
}

if (isset($_POST['ID']) && isset($_POST['ten']) && isset($_POST['sl']) && isset($_POST['dongia'])) {
    themsp($_POST['ID'], $_POST['ten'], $_POST['sl'], $_POST['dongia']);
}
?>

<h3>3.Tìm kiếm sản phẩm</h3>
<div id="lc3"></div>
<form action="index.php#lc2" method="post">
    <label for="">Nhap ID san pham</label>
    <input type="number" name="ID_tk">
    <input type="submit">
</form>

<?php

function timkiem($ID) {
    global $servername, $username, $password, $dbname;

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);
    $table_name = "mytable";
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM {$table_name} WHERE ID = {$ID}"; // Thay 'tên_bảng' bằng tên bảng bạn muốn hiển thị
    $result = $conn->query($sql);

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
        $conn->close();
        return 0;
    }

    return 1;
}

if (isset($_POST['ID_tk'])) {
    $x = timkiem($_POST['ID_tk']);
    if ($x == 0) {
        echo "Khong tim thay";
    }
}
?>

<div id="lc4"></div>
<h3>4.Sửa thông tin sản phẩm</h3>
<form method="post">
    <label for="">ID</label>
    <input type="text" name="ID_sua"> <br>
    <label for="">Ten</label>
    <input type="text" name="ten_sua"> <br>
    <label for="">So luong</label>
    <input type="number" name="sl_sua" min=1> <br>
    <label for="">Don gia</label>
    <input type="number" name="dongia_sua" min=1> <br>
    <input type="submit" value="Xac nhan sua">
</form>


<?php
    function suasp($ID, $ten, $sl, $dongia) {
        global $servername, $username, $password, $dbname;

        // Tạo kết nối
        $conn = new mysqli($servername, $username, $password, $dbname);
        $table_name = "mytable";
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        $sql = "UPDATE `{$table_name}` SET `ten` = '$ten', `sl` = '$sl', `dongia` = '$dongia'
        WHERE `ID` = '$ID';";
        $result = $conn->query($sql);

        echo "Sua thanh cong";
    }

    if (isset($_POST['ID_sua']) && isset($_POST['ten_sua']) && isset($_POST['sl_sua']) && 
        isset($_POST['dongia_sua'])) {
            suasp($_POST['ID_sua'], $_POST['ten_sua'], $_POST['sl_sua'], $_POST['dongia_sua']);
        }
?>

<h3>5.Xóa sản phẩm</h3>
<div id="lc5"></div>
<form action="index.php#lc3" method="post">
    <label for="">ID sp can xoa</label>
    <input type="number" name="ID_xoa" require min=1>
    <input type="submit">
</form>

<?php
    function xoasp($ID) {
        global $servername, $username, $password, $dbname;

        // Tạo kết nối
        $conn = new mysqli($servername, $username, $password, $dbname);
        $table_name = "mytable";
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        $sql = "DELETE FROM `{$table_name}` WHERE `ID` = '$ID';";
        $result = $conn->query($sql);

        echo "Xoa thanh cong";
    }

    if (isset($_POST['ID_xoa'])) {
        $x = timkiem($_POST['ID_xoa']);
        if ($x == 1) {
            xoasp($_POST['ID_xoa']);
        }
        else {
            echo "Khong ton tai du lieu";
        }
    }

    
?>


<!-- Can footer -->
<p style="visibility: hidden;">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore unde, minima distinctio veritatis accusantium saepe ab temporibus nemo. Facilis laudantium rerum magni impedit. Expedita repellendus facilis error eum id molestiae.
Alias veniam facilis ducimus dignissimos deserunt quae voluptatem dolore eaque iure dolorem repellat earum sit tempora aliquid officiis adipisci fuga architecto saepe, culpa eos inventore. Repellat nulla iste incidunt tenetur.
Magnam mollitia facere nisi fugiat molestiae esse at assumenda illo cum commodi sed iure delectus asperiores unde, recusandae nemo perferendis itaque dolor error aliquid ea porro. Autem vel consectetur culpa.
Maxime quo aspernatur libero architecto enim laudantium nemo, pariatur alias magni temporibus sunt illo, quae rem est reprehenderit eveniet, ipsa vero? Atque commodi eum autem aliquid, ducimus adipisci? Distinctio, molestias?
Reprehenderit atque eveniet tempore culpa nemo quasi deserunt sed, nam voluptates ab, nulla adipisci ea ipsam tempora? Soluta nostrum voluptatibus perferendis rem minus. Rerum, accusamus consectetur voluptatem maxime nihil unde?
Voluptatibus pariatur eaque vel quaerat quae, nesciunt est numquam repudiandae dolore doloribus odio, magnam recusandae natus quisquam voluptates? Aut facere rem soluta, atque autem voluptatum? Possimus tenetur nesciunt aut blanditiis.
Eum dolorem placeat asperiores ex repellat laboriosam ipsum quam obcaecati officiis, cumque at laudantium ullam iste autem non reprehenderit animi veniam delectus voluptatibus veritatis itaque! Totam numquam eaque ratione quisquam!
Id, voluptate nam rerum, saepe odit dolores possimus quasi ab error labore, corrupti esse non tempore libero doloribus maxime mollitia? Velit deserunt asperiores odio, quam sint iusto harum ex magni?
Quam praesentium, debitis libero hic expedita doloribus blanditiis nam quasi sit impedit cumque et commodi labore totam. Ad optio facilis quis molestias consequatur labore sunt. Aspernatur quasi vitae libero sunt!
Distinctio sunt, voluptas dicta enim repellat ipsam aliquam totam consequatur rerum natus odio soluta iure odit fuga, recusandae quam sed illo placeat exercitationem itaque aut ex beatae optio? Esse, consectetur.
Consequatur amet earum ad tempore repellendus voluptas accusantium, suscipit esse accusamus tenetur porro quaerat sequi distinctio quidem reprehenderit. Inventore dolorem beatae cumque exercitationem necessitatibus sunt odit aliquid ex vel rerum?
Corrupti tempore, nam impedit nostrum repudiandae voluptatibus quae iste velit nihil itaque perferendis aut, unde ad, officiis deleniti laboriosam ut illo eius expedita dolores et veritatis asperiores voluptates. Modi, aliquam!
Labore provident a ut optio veniam fugiat voluptates, iusto illum culpa sed sapiente voluptas repellendus minus nostrum, facilis dolores expedita accusantium laborum. Repellat optio exercitationem ea cumque possimus cum numquam.
Perspiciatis aliquid minus consequuntur eum, repellat labore quibusdam explicabo iure! Voluptates, ipsam odio minus, culpa a, doloribus sunt nulla officiis reprehenderit aliquid aperiam voluptatem id rem ut. Odit, distinctio quisquam!
Quos ab cumque ratione hic repellat in assumenda. Omnis incidunt, pariatur reprehenderit assumenda blanditiis ipsa accusamus dolores ad eos iusto eius. Accusamus accusantium, voluptatem sapiente assumenda aspernatur dolores doloribus delectus!
Quasi nisi officiis voluptatem voluptatibus doloremque et officia laborum eius veritatis quibusdam esse ad tenetur ut ullam alias dolores soluta, quia aliquid laudantium blanditiis provident! Maxime beatae exercitationem similique sequi?
Sequi voluptatum molestiae quibusdam itaque libero, consequuntur aliquam! Nesciunt nisi suscipit aspernatur sapiente officia veritatis unde pariatur molestiae assumenda? Sequi, rerum labore accusamus eaque earum accusantium quis aliquid perferendis iste.
Nesciunt beatae ipsa quo animi facere, eum modi expedita, perspiciatis voluptatem corrupti molestias laudantium sapiente culpa enim nihil veritatis accusamus mollitia. Unde pariatur quidem vitae nisi porro consectetur harum necessitatibus!
Animi enim sequi expedita tempore fuga harum cum, necessitatibus ab aperiam totam facere illum voluptatum consequuntur? Modi totam corporis fuga sed voluptatem, nostrum facilis eaque velit aperiam, consequuntur ut veniam.
Aliquam placeat neque, eligendi quidem nihil numquam id in accusantium voluptate optio officia qui facere labore a perspiciatis non eos rem. Ut consectetur maiores similique. Quasi sint praesentium hic totam?
Ratione illo voluptas tempore, error repellat quia quisquam distinctio quod a temporibus fugit, fugiat, cupiditate impedit natus veniam dolores tempora! Quam quae quaerat reprehenderit pariatur nam animi minus! Praesentium, obcaecati.
Temporibus recusandae adipisci assumenda exercitationem est ipsum necessitatibus quibusdam animi omnis eaque laudantium maiores ea provident sint, vel soluta totam similique, repellendus nisi voluptatem porro eius. Provident, iusto hic. Doloribus?
Recusandae, ducimus asperiores harum labore eius quod quis ratione doloribus dicta ipsa saepe dolore commodi fuga illo! Accusamus blanditiis reprehenderit saepe laborum, optio, delectus consequatur neque aliquid, magni architecto perferendis?
Voluptate, magni est, maiores corrupti eveniet quis ad, ratione iste sed dolorum totam esse omnis amet sapiente incidunt ab? Mollitia nostrum sapiente eligendi magni numquam accusamus natus cum tenetur quae?
Quo aperiam et minus qui accusamus id, accusantium voluptatem sequi, nulla ratione perferendis incidunt ullam labore fugit veniam quaerat! Architecto laudantium aut quibusdam magnam soluta voluptatem voluptate nihil eligendi suscipit?
Deserunt maiores beatae debitis modi. Molestias, voluptatibus, harum at natus soluta dignissimos dolorem architecto tempore possimus veniam reiciendis, nobis similique ad animi facere voluptate omnis nemo ut esse adipisci rem!
Expedita maxime sed non distinctio tempore ab nesciunt modi, reprehenderit sequi dicta necessitatibus? Itaque mollitia ratione quod quis amet repellendus quasi enim officiis iste. Veritatis totam suscipit quod quos ut!
Neque nostrum obcaecati tempore dolore, voluptates accusantium nesciunt quos suscipit, totam ab libero! Illum repudiandae odio nulla quia illo saepe, aliquam sequi ullam eligendi, error non pariatur dignissimos nemo dolor.
Ad veniam, accusantium sint odio doloremque a quasi unde id distinctio officiis officia? Ipsum, neque. Tempora enim quasi iste, rem pariatur asperiores voluptate ratione necessitatibus consectetur deleniti architecto nostrum repellat.
Et quisquam minima reprehenderit maiores, consequuntur ab necessitatibus tempora assumenda quam ad dignissimos nam hic illo numquam accusamus quas maxime eos officiis voluptate. Itaque eum, dolorum sit illum earum tenetur!
Iure in soluta libero exercitationem incidunt placeat eligendi? Debitis, corrupti? Ipsam nemo aspernatur quas necessitatibus nostrum in tempore blanditiis molestias! Consequuntur odit corrupti natus assumenda velit molestiae a labore sequi?
Suscipit cum similique temporibus magnam est quam nostrum officia aspernatur? Alias asperiores totam dolore cumque quis porro, dignissimos necessitatibus possimus molestiae nisi quo laudantium! Assumenda voluptas molestias nobis praesentium aliquam!
Itaque cumque non temporibus, omnis impedit tempora sit. Quasi natus ad vitae beatae optio illo. Cumque omnis consequatur ea, necessitatibus, harum placeat culpa sunt nesciunt ad quod eveniet, molestias fuga?
Repudiandae hic illum modi? Harum eveniet molestias doloribus quibusdam, totam cumque. Qui cupiditate laborum impedit corrupti doloremque. Animi architecto exercitationem ea, modi possimus autem nostrum quae non odio doloremque ipsam.
Dolores rem laboriosam velit voluptate deserunt nulla nam quod at optio quibusdam quis dolorum corporis, error suscipit sequi molestiae quam tempore, quia tempora? Non ratione aliquid atque sit magnam repellendus.
Reprehenderit delectus quis suscipit placeat accusamus quas perspiciatis similique quia quo architecto voluptatibus rem aliquid, voluptate reiciendis asperiores cumque blanditiis assumenda eius ducimus ipsam facilis. Et necessitatibus perferendis eveniet suscipit.
Ex dolorum molestias ducimus nemo cumque consequuntur a voluptas, deserunt quidem et dignissimos suscipit, assumenda veritatis temporibus perspiciatis porro tenetur totam ipsa possimus earum modi similique mollitia! Quod, ipsum fugit?
Aliquid eos velit temporibus reprehenderit, a aliquam maxime. Sunt sequi minus eaque culpa optio neque veniam cumque sint, vero iste dignissimos. Maiores libero perspiciatis quas illum voluptates, quia culpa ad.
Repellat eos animi ex consequatur ratione, assumenda harum consequuntur maiores minima quibusdam perferendis. Dolor aliquam explicabo minus rem totam sequi quidem vero quod pariatur quas accusantium, natus hic minima error.
Iusto nihil reprehenderit error architecto voluptatem itaque maiores, dicta tenetur! Alias illo quos quis qui deserunt! Asperiores perspiciatis deserunt eos accusantium architecto facilis, nisi quas nobis blanditiis expedita consequuntur saepe.
Quo neque maiores tenetur repellendus voluptatem cupiditate eligendi provident asperiores repellat quia odit sint odio iure voluptatibus, distinctio sunt ex. Impedit tempore porro aliquam exercitationem, adipisci obcaecati sint repellat quas!
Autem quasi ab, blanditiis, natus explicabo atque voluptatem, ipsam iste fugiat quisquam quibusdam quos totam! Corrupti animi totam placeat reiciendis numquam omnis! Sequi qui iure, obcaecati saepe quod rerum quae!
Modi aperiam tempore deserunt pariatur hic repellat impedit, saepe, adipisci dolor itaque fugiat vero deleniti reiciendis quod aliquid esse quisquam, aut sit? Optio, reprehenderit. Exercitationem corporis sunt ipsa nemo nisi?
Nemo nobis quo illo, eaque voluptate quos laboriosam vel eum saepe eveniet voluptas ut molestias dolores, cum minus tempore fugit sequi natus qui officia ipsam ab ullam totam. Doloribus, magni.
Optio adipisci, officiis repudiandae, laboriosam fugit cumque illo iure natus quibusdam maxime accusantium nobis similique quae hic nemo, odio doloremque at repellendus quod! Quas aperiam, nisi commodi reprehenderit dolor nobis?
Velit ullam assumenda exercitationem fugiat blanditiis alias esse dignissimos non a animi voluptates provident, consequuntur, repellendus tempore earum ducimus maiores veritatis consectetur eius libero. Nulla asperiores odit vel corrupti quo.
Aspernatur vitae distinctio quam modi cupiditate porro aut illo maxime, vero, quia, dolorem nobis asperiores est architecto harum doloribus quo sequi ex. Perferendis, aliquid dolorum! Sed eaque deleniti a hic.
Minus perspiciatis ut est saepe sit, fugit fuga aperiam alias ad et eos nobis cumque, recusandae veritatis aspernatur impedit vero distinctio architecto inventore ab dolor, esse dolores maxime quibusdam? Nihil?
Placeat aut officiis deserunt molestias expedita dicta quisquam! Iste atque adipisci obcaecati eligendi molestiae? Quam quas amet quisquam aut mollitia labore alias rerum enim qui, eos dolores veniam beatae voluptate!
Repellat, consequuntur a optio veritatis mollitia eius architecto rerum aliquam placeat, neque porro, aut sequi dolorum eos iste ratione ducimus? Non ipsa architecto inventore ipsum magni placeat nostrum accusantium exercitationem?
Ad itaque recusandae iste vitae sunt rem, suscipit sint nesciunt delectus at autem cupiditate quia dolorem tempore vel porro alias assumenda provident quasi possimus sit corrupti. Aliquam consectetur mollitia ipsum?
Ullam deleniti minus unde sapiente aperiam enim perspiciatis hic quae nihil? Quia, corrupti natus, libero nisi eum adipisci distinctio magni ipsum doloribus at aperiam dicta modi nulla deserunt officiis autem.
Enim debitis blanditiis nobis qui iure culpa aliquam optio nostrum ratione, commodi nam sunt laudantium ducimus maxime velit. Aspernatur doloremque placeat, porro corporis facere laborum neque ipsam dolores delectus quam!
Eveniet quasi libero natus dolores officia, illum sed iste. Quis nihil vitae, sequi doloremque dolores eius, non at nulla ipsam veritatis itaque distinctio, odit sint est quo libero totam unde.
Qui voluptates quia adipisci? Quia ut delectus enim, reiciendis odit iusto libero corrupti eveniet natus rem quos iste voluptate expedita accusamus. Quisquam repellendus eveniet architecto officiis, laboriosam neque laudantium iste?
Repellat repellendus velit eveniet quam obcaecati deserunt dolor, quis blanditiis et aut perspiciatis rerum neque? Voluptas molestias, neque, amet debitis, aliquid quo nemo facere dolor perspiciatis harum obcaecati adipisci ut.
Reprehenderit alias illo iure, illum excepturi maxime! Tenetur vitae laudantium expedita cumque suscipit distinctio? Id ipsa repudiandae fugiat aspernatur, molestiae ipsam velit nemo dolores aperiam beatae molestias doloremque numquam deleniti.
Commodi quidem voluptas inventore est libero culpa rerum saepe, ratione repellendus excepturi qui! Id odio laudantium iste in provident pariatur, at fugiat facilis voluptatibus, eaque nemo ab autem illum voluptates.
Quas aliquid doloribus sint atque iste cumque rerum. Assumenda magni nobis excepturi unde debitis cumque molestias libero eos aperiam odit. Consectetur maiores dolores assumenda aperiam pariatur dolor quidem alias provident?
Dicta, doloribus? Ipsam unde architecto facilis nisi similique aperiam voluptatibus blanditiis aspernatur, corporis quam sed enim sapiente saepe magnam veritatis, dolorem quis at exercitationem. Est quod nostrum accusamus rem consequuntur!
Doloremque deserunt doloribus eaque vel est ut quam non similique consequuntur rerum accusantium sint iste veniam aliquam obcaecati, molestiae sit quibusdam libero quo ea aperiam. Porro officia qui est quis.
Delectus commodi molestiae, magni officiis culpa aperiam dolorum minima eius maiores! Consequatur tenetur, dolorem dolorum, laborum, blanditiis sit voluptatum rerum dignissimos repudiandae et eaque quia. Obcaecati molestias dicta ducimus ullam.
Odio laboriosam hic, earum aliquid natus alias voluptatibus totam sequi quam omnis ab facilis magnam illum adipisci, incidunt blanditiis vel? Quo voluptatum deserunt totam quas architecto minus ab saepe dolor.
Officiis, earum alias accusamus saepe, delectus, sit fugiat corporis ipsa consequatur eligendi voluptatem. Placeat id commodi nesciunt aliquam voluptates alias, nemo natus et. Commodi ipsa non quod dolorum esse architecto.
Est voluptate dicta repellat perspiciatis beatae magni quidem, nostrum veniam eveniet minus. Delectus dolore sed reiciendis rerum aspernatur ea, molestiae obcaecati facere nostrum? Rerum iure harum sequi deserunt deleniti? Veniam!
Molestias molestiae minus consectetur fugiat sunt, aspernatur perspiciatis possimus nesciunt porro corporis nam blanditiis quos repudiandae pariatur veniam voluptates voluptate, culpa ullam hic omnis itaque quae dolorum autem iusto. Quis.
Neque, aliquam corporis rerum dolor explicabo repudiandae cum, provident dolore nulla quis accusantium aut! Voluptatem, unde reiciendis? Praesentium earum deleniti molestias animi perspiciatis nobis quia impedit! Repellendus nemo officia ad!
Corrupti excepturi, cumque exercitationem, perspiciatis maiores quidem minus tempore quibusdam totam non nam hic voluptatum sit perferendis aliquid laboriosam eaque eveniet adipisci magni qui itaque nisi. Nulla accusantium qui perspiciatis!
Laudantium repellendus quo quia numquam maiores. Ullam dolore dicta labore facilis voluptate laudantium sunt, officiis at optio beatae ad praesentium impedit tenetur qui corporis reiciendis corrupti aspernatur? Hic, nisi aliquid.
Aperiam facere eum quibusdam omnis debitis corporis harum, cumque sit natus, molestias inventore nesciunt nobis, suscipit ipsa sint nostrum? Reiciendis a ea deleniti at nam! Fugit voluptas recusandae ipsam repellat!
Ducimus impedit sapiente voluptates porro nesciunt doloribus maiores dolore. Voluptatibus impedit sequi officiis earum est sed dignissimos? Aperiam beatae dolorum fugiat quaerat aliquid ut exercitationem, iusto perspiciatis quam, necessitatibus tenetur.
Laborum exercitationem, laboriosam fugit quis minus asperiores nulla dolorem optio at consectetur quasi labore repellendus magni aliquam odio qui eos unde illum mollitia voluptatum corrupti repudiandae molestiae perferendis. Itaque, necessitatibus.
Sit sapiente reiciendis asperiores, dignissimos excepturi impedit eveniet magni numquam. Autem cumque at nisi nesciunt laudantium vero, doloribus, cum porro saepe dolorum illo inventore voluptatibus, libero iusto maiores et expedita!
Id quaerat inventore exercitationem facilis iure fugiat unde quo perspiciatis adipisci, laboriosam minima tempore et, odit minus qui quos! Quod ipsum nam natus maiores est! Ea illum voluptatem velit eaque?
Doloremque, veritatis! Architecto dolorum repellat quia tempora voluptatum optio eligendi fugiat, illo voluptate harum voluptatibus nobis esse aperiam libero nisi repellendus? Ipsum distinctio aliquam optio voluptas eaque natus. Sequi, doloremque.
Voluptates a doloremque officiis rem deserunt incidunt illo fugiat quo nesciunt culpa, accusamus expedita aliquam unde totam nobis maxime amet doloribus excepturi quos obcaecati quibusdam iste pariatur magni sed. Qui?
Autem minus, dolores nobis asperiores similique cumque at dicta voluptatem placeat. Nemo accusantium quidem ducimus ipsam maxime, eum quo voluptates eaque nulla iure! Illo aperiam ut voluptatibus vitae accusantium eum.
Mollitia adipisci dolorum tenetur blanditiis, id incidunt corporis et autem ea. Earum tenetur fuga officiis libero aliquam temporibus, beatae atque nesciunt eius doloremque corrupti fugit nobis itaque exercitationem consequatur provident.
Libero magni consectetur optio neque sed placeat atque, at, aut ipsam quibusdam quaerat corporis voluptatem beatae officia nesciunt? Voluptatum, ut. Dolorum ipsa nemo delectus molestiae accusantium aspernatur culpa laborum consectetur.
Eaque facilis aperiam non nobis soluta dicta! Dignissimos sunt pariatur nulla dicta cum labore, voluptate sint aut inventore minima unde aspernatur, ab, nihil quo quibusdam odit perferendis deserunt! Reprehenderit, necessitatibus.
Iure similique fuga rem sequi iste laudantium id tenetur odit adipisci, autem nisi fugit corporis delectus fugiat earum. Mollitia dolorum voluptatem tenetur eveniet repellat labore expedita repudiandae numquam, laudantium minima.
Veniam minus doloribus, quia illum ratione ipsam placeat quod eum consequatur numquam unde molestiae. Provident suscipit quidem magnam labore facere odit dignissimos ab, ad beatae molestias illum maxime, error aspernatur!
Nihil illo incidunt odio perferendis, saepe commodi voluptatum tempora deleniti quod nisi, sint repellat voluptatem consequuntur numquam perspiciatis! Earum, ut! Dolorum, obcaecati laborum esse cum earum necessitatibus quis quia sit?
Iusto, quod iure ab sequi quis dolore, tempore explicabo corrupti ullam soluta dolorem quibusdam ipsam illo id similique. Dignissimos reprehenderit laborum omnis iure earum placeat consequatur esse, repellendus animi nobis.
Laudantium possimus porro cumque debitis. Nisi, veritatis beatae nobis eaque consequatur labore dolore maxime optio esse inventore perspiciatis laudantium corrupti, magnam sunt nesciunt distinctio et! Atque iusto quasi recusandae perferendis?
Maiores ullam asperiores doloremque nostrum perspiciatis, fugit temporibus praesentium aspernatur suscipit odit iusto deserunt quos cum, a quo? Saepe, corporis. Nulla molestiae commodi earum voluptatibus nemo ut blanditiis quia nam?
Expedita dolorum quo voluptatem officiis, molestiae ipsam dolore laudantium vero nesciunt iusto ullam cumque! A provident repellat minus eligendi laboriosam. Ab doloremque ut delectus illo ducimus sit quia beatae ullam.
Sunt optio ipsum vel deserunt nemo molestiae ullam ab eveniet officia, doloribus aliquam fugiat aperiam voluptatibus perferendis. Voluptatibus mollitia tempora obcaecati voluptas rerum! Vel atque hic distinctio quod, rem alias.
Quisquam repudiandae, excepturi nisi illum, maxime enim vel doloribus beatae, iure temporibus debitis eos omnis maiores assumenda. Odio, illum hic! Quos ullam dignissimos, aperiam sit maxime beatae a cum asperiores!
Similique nihil ducimus voluptate, aliquid blanditiis asperiores, debitis molestiae quo, mollitia assumenda eos cupiditate incidunt. Sed itaque natus ullam eius tempora excepturi ab quam nihil aut, nobis laborum tempore quasi!
Dolor facilis ipsum quam tempore ex amet dolore facere non porro velit, assumenda modi aliquam quaerat ipsam sequi ullam id deserunt debitis nesciunt expedita vel impedit quidem. Dolorum, ratione molestias!
Eos expedita tempora assumenda optio, natus a aperiam non asperiores, fugiat incidunt labore quaerat voluptatum. Nulla aspernatur ab nobis, est consequatur placeat minus ipsam blanditiis, perferendis quidem nemo fugit cupiditate!
Quam molestias, soluta repellat recusandae repellendus consectetur. Rerum inventore esse est hic quidem. Delectus magni labore incidunt eligendi maiores tenetur repellendus? Repellendus suscipit perferendis accusamus animi obcaecati ipsa at doloremque!
Eaque, fugit! Ut reprehenderit nihil, est atque, nisi in excepturi quae natus a illum voluptatem iste qui? Minus hic impedit harum similique laboriosam cum quisquam soluta facere esse! Pariatur, repudiandae.
Assumenda amet illum voluptatibus facilis qui blanditiis tenetur voluptatum odit deleniti, alias a maxime pariatur vitae nam vel. Veniam minus adipisci nostrum deleniti quis quod totam, nesciunt beatae facilis tenetur?
Facilis sit error quo, alias ut illo repellendus, cupiditate doloremque facere accusamus in nobis eligendi ipsa odit culpa vero illum cum deserunt omnis a perferendis amet. Maiores, ipsam. Laboriosam, rem!
Sequi autem, quibusdam iure dolorem accusamus suscipit doloribus iste, eveniet incidunt, obcaecati repudiandae omnis a nam corporis laboriosam mollitia dicta natus facilis ducimus magnam fugiat esse ullam labore. Sit, explicabo.
Facilis explicabo molestiae iure impedit, reprehenderit, voluptates sequi quod quidem laudantium obcaecati doloremque illum doloribus aliquid, aliquam consequatur numquam dolorem iusto praesentium ex quis. Maiores at illo tempora accusamus repellat.
Iusto accusantium totam quod quisquam repellendus voluptatem rem consequuntur mollitia optio at labore praesentium perferendis iure, ipsa neque exercitationem quos accusamus quam blanditiis veniam eaque. Facilis debitis ullam officia pariatur.
Minima ratione modi dicta molestiae. A nisi fugiat eius cupiditate officiis nihil, magni dolore, vero necessitatibus perspiciatis enim quo obcaecati explicabo illum non porro eaque incidunt aperiam id. Officiis, repudiandae.</p>