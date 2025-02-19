<?php
// Start the session
@session_start();

// Initialize variables
$p_id = isset($_GET['p_id']) ? $_GET['p_id'] : null;
$act = isset($_GET['act']) ? $_GET['act'] : null;

// Handle cart actions
if ($act === 'add' && !empty($p_id)) {
    if (!isset($_SESSION['shopping_cart'])) {
        $_SESSION['shopping_cart'] = array();
    }

    if (isset($_SESSION['shopping_cart'][$p_id])) {
        $_SESSION['shopping_cart'][$p_id]++;
    } else {
        $_SESSION['shopping_cart'][$p_id] = 1;
    }
}

if ($act === 'remove' && !empty($p_id)) {
    unset($_SESSION['shopping_cart'][$p_id]);
}

if ($act === 'update') {
    $amount_array = isset($_POST['amount']) ? $_POST['amount'] : array();
    foreach ($amount_array as $p_id => $amount) {
        $_SESSION['shopping_cart'][$p_id] = $amount;
    }
}
?>

<form id="frmcart" name="frmcart" method="post" action="?act=update">
    <table width="100%" border="0" align="center" class="table table-hover">
        <tr>
            <td height="40" colspan="4" align="center" bgcolor="#33CCFF"><strong><b>ห้องที่จอง</b></strong></td>
        </tr>
        <tr>
            <td><center>รหัส</center></td>
            <td><center>ราคา</center></td>
            <td><center>จำนวน</center></td>
            <td><center>รวม</center></td>
        </tr>
        <?php
        $total = 0; // Initialize total

        if (!empty($_SESSION['shopping_cart'])) {
            require_once('Connections/condb.php');

            foreach ($_SESSION['shopping_cart'] as $p_id => $p_qty) {
                $sql = "SELECT * FROM tbl_product WHERE p_id = ?";
                $stmt = $condb->prepare($sql);
                $stmt->bind_param('i', $p_id);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    $price = isset($row['p_price']) ? $row['p_price'] : 0;
                    $p_qty_in_stock = isset($row['p_qty']) ? $row['p_qty'] : 100;
                    
                    $sum = $price * $p_qty;
                    $total += $sum;
                    
                    echo "<tr>";
                    echo "<td width='20px'>" . $row['p_id'] . ".</td>";
                    echo "<td width='70px' align='right'>" . number_format($price, 2) . "</td>";
                    echo "<td width='20px' align='right'>";
                    echo "<input type='number' name='amount[$p_id]' value='$p_qty' max='$p_qty_in_stock' width='20px'/></td>";
                    echo "<td width='120' align='right'>";
                    echo number_format($sum, 2) . ' &nbsp; ';
                    echo "<a href='index.php?p_id=$p_id&act=remove' class='btn btn-danger btn-xs'>x</a>";
                    echo "</td>";
                    echo "</tr>";
                }

                $stmt->close();
            }

            echo "<tr>";
            echo "<td colspan='3' bgcolor='#CEE7FF' align='right'>รวม</td>";
            echo "<td align='right' bgcolor='#CEE7FF'><b>" . number_format($total, 2) . "</b></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <p align="right">
        <?php if ($total > 0) { ?>
            <td colspan="3" align="right">
                <button type="submit" name="button" id="button" class="btn btn-warning"> คำนวณ </button>
                <?php if ($act === 'update') { ?>
                    <button type="button" name="Submit2" onclick="window.location='confirm_order.php';" class="btn btn-primary">
                        <span class="glyphicon glyphicon-shopping-cart"> </span> ยืนยัน
                    </button>
                <?php } ?>
            </td>
        <?php } else { ?>
            <font color='red'>ไม่มีรายการจอง</font>
        <?php } ?>
    </p>
</form>
