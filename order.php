<?php
require_once('Connections/condb.php');

session_start();

if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType) {
        global $condb;

        $theValue = mysqli_real_escape_string($condb, $theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }
}

$colname_buyer = "-1";
if (isset($_SESSION['MM_Username'])) {
    $colname_buyer = $_SESSION['MM_Username'];
}

$query_buyer = sprintf("SELECT * FROM tbl_member WHERE mem_username = %s", GetSQLValueString($colname_buyer, "text"));
$buyer = mysqli_query($condb, $query_buyer);

if ($buyer) {
    $row_buyer = mysqli_fetch_assoc($buyer);
    $totalRows_buyer = mysqli_num_rows($buyer);

    if ($totalRows_buyer > 0 && isset($_SESSION['MM_Username'])) {
?>
<p><a href="index.php">จองห้องพักเพิ่ม</a> &nbsp;  <button class="btn btn-primary" onClick="window.print()"> print </button></p>
<table width="700" border="1" align="center" class="table">
    <tr>
        <td width="1558" colspan="5" align="center">
            <strong>คำสั่งจองห้องพัก</strong>
        </td>
    </tr>
    <tr class="success">
        <td align="center">ลำดับ</td>
        <td align="center">ห้องพัก</td>
        <td align="center">ราคา</td>
        <td align="center">จำนวนห้อง</td>
        <td align="center">รวม/รายการ</td>
    </tr>
    <form name="formlogin" action="saveorder.php" method="POST" id="login" class="form-horizontal">
    <?php
    if (isset($_SESSION['shopping_cart']) && is_array($_SESSION['shopping_cart'])) {
        $total = 0;
        $i = 0; // Initialize $i for counting
        foreach ($_SESSION['shopping_cart'] as $p_id => $p_qty) {
            $stmt = $condb->prepare("SELECT * FROM tbl_product WHERE p_id = ?");
            $stmt->bind_param("i", $p_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                $sum = $row['p_price'] * $p_qty;
                $total += $sum;
                echo "<tr>";
                echo "<td align='center'>" . (++$i) . "</td>";
                echo "<td>" . htmlspecialchars($row["p_name"]) . "</td>";
                echo "<td align='right'>" . number_format($row['p_price'], 2) . "</td>";
                echo "<td align='right'>$p_qty</td>";
                echo "<td align='right'>" . number_format($sum, 2) . "</td>";
                echo "</tr>";
            ?>
                <input type="hidden" name="p_name[]" value="<?php echo htmlspecialchars($row['p_name']); ?>" class="form-control" required placeholder="ชื่อ-สกุล" />
            <?php
            }
        }
        echo "<tr>";
        echo "<td align='right' colspan='4'><b>รวม</b></td>";
        echo "<td align='right'><b>" . number_format($total, 2) . "</b></td>";
        echo "</tr>";
    } else {
        echo "<tr><td colspan='5'>No items in the shopping cart</td></tr>";
    }
    ?>
    </table>

    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-5" style="background-color:#f4f4f4">
                <h3 align="center" style="color:green">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    ที่อยู่ของลูกค้าในการจองห้องพัก
                </h3>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" name="name" value="<?php echo htmlspecialchars($row_buyer['mem_name']); ?>" class="form-control" required placeholder="ชื่อ-สกุล" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea name="address" class="form-control" rows="3" required placeholder="ที่อยู่ในการส่งสินค้า"><?php echo htmlspecialchars($row_buyer['mem_address']); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($row_buyer['mem_tel']); ?>" class="form-control" required placeholder="เบอร์โทรศัพท์" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($row_buyer['mem_email']); ?>" required placeholder="อีเมล์" />
                    </div>
                </div>

                <!-- ฟอร์มเลือกวันที่เข้าพักและวันที่ออก -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="checkin_date">วันที่เข้าพัก</label>
                        <input type="date" name="checkin_date" id="checkin_date" class="form-control" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="checkout_date">วันที่ออกจากโรงแรม</label>
                        <input type="date" name="checkout_date" id="checkout_date" class="form-control" required />
                    </div>
                </div>

                <!-- ตรวจสอบห้องว่าง -->
                <?php
                if (isset($_POST['checkin_date']) && isset($_POST['checkout_date'])) {
                    $checkin_date = $_POST['checkin_date'];
                    $checkout_date = $_POST['checkout_date'];

                    $query = "SELECT * FROM tbl_booking WHERE (checkin_date BETWEEN '$checkin_date' AND '$checkout_date') OR (checkout_date BETWEEN '$checkin_date' AND '$checkout_date')";
                    $result = mysqli_query($condb, $query);

                    if (mysqli_num_rows($result) > 0) {
                        echo "<p style='color:red;'>ห้องพักไม่ว่างในช่วงวันที่เลือก กรุณาลองเลือกใหม่</p>";
                    } else {
                        echo "<p style='color:green;'>ห้องพักว่างในช่วงวันที่เลือก</p>";
                    }
                }
                ?>

                <div class="form-group">
                    <div class="col-sm-12" align="center">
                        <input name="mem_id" type="hidden" id="mem_id" value="<?php echo htmlspecialchars($row_buyer['mem_id']); ?>">
                        <button type="submit" class="btn btn-primary" id="btn">ยืนยันการจอง</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    } else {
        include('logout3.php');
    }
    mysqli_free_result($buyer);
} else {
    echo "Query failed: " . mysqli_error($condb);
}

mysqli_close($condb);
?>
