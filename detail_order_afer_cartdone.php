<?php require_once('Connections/condb.php'); ?>
<?php
error_reporting(error_reporting() & ~E_NOTICE);
session_start();

if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
        global $condb; // Ensure the database connection is accessible

        $theValue = $condb->real_escape_string($theValue);

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
$buyer = $condb->query($query_buyer) or die($condb->error);
$row_buyer = $buyer->fetch_assoc();
$totalRows_buyer = $buyer->num_rows;

$query_rb = "SELECT * FROM tbl_bank";
$rb = $condb->query($query_rb) or die($condb->error);
$row_rb = $rb->fetch_assoc();
$totalRows_rb = $rb->num_rows;

$colname_cartdone = "-1";
if (isset($_GET['order_id'])) {
    $colname_cartdone = $_GET['order_id'];
}

$query_cartdone = sprintf("
SELECT * FROM 
tbl_order as o, 
tbl_order_detail as d, 
tbl_product as p,
tbl_member as m
WHERE o.order_id = %s 
AND o.order_id=d.order_id 
AND d.p_id=p.p_id
AND o.mem_id = m.mem_id 
ORDER BY o.order_date ASC", GetSQLValueString($colname_cartdone, "int"));
$cartdone = $condb->query($query_cartdone) or die($condb->error);
$row_cartdone = $cartdone->fetch_assoc();
$totalRows_cartdone = $cartdone->num_rows;

$total = 0; // Initialize the $total variable
$status = 0; // Initialize the $status variable

?>
    <style type="text/css">
    input[type='radio'] {
      -webkit-appearance: none;
      width: 20px;
      height: 20px;
      border: 1px solid darkgray;
      border-radius: 50%;
      outline: none;
      box-shadow: 0 0 5px 0px gray inset;
    }
    input[type='radio']:hover {
      box-shadow: 0 0 5px 0px orange inset;
    }
    input[type='radio']:before {
      content: '';
      display: block;
      width: 60%;
      height: 60%;
      margin: 20% auto;
      border-radius: 50%;
    }
    input[type='radio']:checked:before {
      background: red;
    }
    </style>
    <form action="add_payslip_db.php" method="post" enctype="multipart/form-data" name="formpay" id="formpay">
        <p align="center"> <a class="btn btn-primary btn-sm" onclick="window.print()"> พิมพ์ </a>  </p>
        <table width="700" border="1" align="center" class="table">
            <tr>
                <td colspan="5" align="center"><strong>รายการจองห้องพักล่าสุด คุณ<?php echo $row_cartdone['mem_name'] ?? 'N/A';?> <br />
                    <font color="red"> สถานะ :
                    <?php 
                    if (isset($row_cartdone['order_status'])) {
                        $status = $row_cartdone['order_status'];
                        include('backend/status.php');
                    }
                    ?>
                    </font></strong></td>
            </tr>
            <tr>
                <td colspan="5" align="center">
                    <strong><font color="red"></font></strong>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="41%" align="left" valign="top"><strong><font color="red"><br />
                            ชำระเงิน ธ.<?php echo $row_cartdone['b_name'] ?? 'N/A';?> <br />
                            เลข บ/ช <?php echo $row_cartdone['b_number'] ?? 'N/A';?> <br />
                            จำนวน <?php echo $row_cartdone['pay_amount'] ?? '0';?><br />
                            วันที่ชำระ <?php echo isset($row_cartdone['pay_date']) ? date('d/m/Y', strtotime($row_cartdone['pay_date'])) : 'N/A';?></font><br />
                            <h4 style="color:blue">
                            <!-- เลขพัสดุ :  <?php echo $row_cartdone['postcode'] ?? 'N/A';?> -->
                            </h4>
                            </strong>
                            </td>
                            <td width="59%"><strong><font color="red"><img src="pimg/<?php echo $row_cartdone['pay_slip'] ?? 'placeholder.jpg';?>"  width="300px"/></font></strong></td>
                        </tr>
                    </table>
                    <strong><font color="red"><br /></font></strong></td>
            </tr>
            <tr class="success">
                <td width="99" align="center">รหัส</td>
                <td width="120" align="center">ห้องพัก</td>
                <td width="118" align="center">ราคา</td>
                <td width="238" align="center">จำนวน</td>
                <td width="100" align="center">รวม</td>
            </tr>
            <?php if ($totalRows_cartdone > 0): ?>
                <?php do { ?>
                <tr>
                    <td align="center"><?php echo $row_cartdone['d_id'] ?? 'N/A';?></td>
                    <td><?php echo $row_cartdone['p_name'] ?? 'N/A';?></td>
                    <td align="center"><?php echo $row_cartdone['p_price'] ?? '0';?></td>
                    <td align="center"><?php echo $row_cartdone['p_c_qty'] ?? '0';?></td>
                    <td align="center"><?php echo number_format($row_cartdone['total'] ?? 0, 2);?></td>
                </tr> 
                <?php 
                $sum = ($row_cartdone['p_price'] ?? 0) * ($row_cartdone['p_c_qty'] ?? 0);
                $total += $sum;
                ?>
                <?php } while ($row_cartdone = $cartdone->fetch_assoc()); ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" align="center">No items found</td>
                </tr>
            <?php endif; ?>
            
        </table>
        <?php 
        if($status > 1){ } else { ?>    
        <br /><br />
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td height="40" colspan="6" align="left" bgcolor="#FFFFFF">
                <h4>รายละเอียดการโอนเงิน
                <br />   <br />
                <font color="red">
                *กรุณาเลือกบัญชีที่โอนเงิน
                </font>
                </h4></td>
            </tr>
            <?php if ($totalRows_rb > 0): ?>
                <?php do { ?>
                <tr>
                    <td width="10%" align="center">&nbsp;</td>
                    <td width="5%" align="center">
                    <input <?php if (!(strcmp($row_rb['b_name'], "b_bank"))) { echo "checked=\"checked\""; } ?> type="radio" name="bank" value="<?php echo $row_rb['b_name'].'-'.$row_rb['b_number'];?>" required="required" />
                    </td>
                    <td width="5%" align="center"><img src="bimg/<?php echo $row_rb['b_logo'] ?? 'placeholder.jpg'; ?>" width="50" /></td>
                    <td width="15%"><?php echo $row_rb['b_name'] ?? 'N/A'; ?></td>
                    <td width="15%"><?php echo $row_rb['b_number'] ?? 'N/A'; ?></td>
                    <td width="15%"><strong>สาขา</strong><?php echo $row_rb['bn_name'] ?? 'N/A'; ?></td>
                </tr>
                <?php } while ($row_rb = $rb->fetch_assoc()); ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" align="center">No bank details found</td>
                </tr>
            <?php endif; ?>
            <tr>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="center">วันที่ชำระเงิน</td>
                <td colspan="5" align="left"><input type="date" name="pay_date" id="pay_date" value="<?php echo date('Y-m-d');?>"/></td>
            </tr>
            <tr>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="center">จำนวนเงิน</td>
                <td colspan="5" align="left"><input type="number" name="pay_amount" id="pay_amount" placeholder="0.00" required="required"/></td>
            </tr>
            <tr>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="center">หลักฐานการโอน</td>
                <td colspan="5" align="left"><input name="pay_slip" type="file" required="required" accept="image/jpeg"/>
                (ไฟล์ .jpg, gif, png, pdf&nbsp;ไม่เกิน 2mb)</td>
            </tr>
            <tr>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td><input name="order_id" type="hidden" id="order_id" value="<?php echo $colname_cartdone;?>" /></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <p align="center"><br />
        <button type="submit" name="add" class="btn btn-success"> บันทึก </button> 
        </p>
    </form>
    <?php } ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
</div>
</div>

<?php  
$buyer->free();
$rb->free();
$cartdone->free();
$condb->close();
?>
