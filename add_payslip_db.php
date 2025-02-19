<meta charset="UTF-8" />
<?php
include('Connections/condb.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(error_reporting() & ~E_NOTICE);

// Set timezone to Thailand
date_default_timezone_set('Asia/Bangkok');

// Generate filename components
$date1 = date("Ymd_His");
$numrand = mt_rand();

// Extract bank details
$resultb = $_POST['bank'];
$result_explode = explode('-', $resultb);
$b_name = $result_explode[0];
$b_number = $result_explode[1];
$pay_date = $_POST['pay_date'];
$pay_amount = $_POST['pay_amount'];
$order_id = $_POST['order_id'];
$order_status = 2;

// Handle file upload
$pay_slip = isset($_FILES['pay_slip']) ? $_FILES['pay_slip'] : '';
$newname = '';

if ($pay_slip && $pay_slip['error'] == UPLOAD_ERR_OK) {
    $path = "pimg/";
    $type = strrchr($pay_slip['name'], ".");
    $newname = $numrand . $date1 . $type;
    $path_copy = $path . $newname;
    move_uploaded_file($pay_slip['tmp_name'], $path_copy);
}

// Prepare SQL query
$sql = "UPDATE tbl_order SET
    order_status = ?,
    pay_date = ?,
    pay_amount = ?,
    b_name = ?,
    b_number = ?,        
    pay_slip = ?    
    WHERE order_id = ?";

// Use prepared statements to execute the query
if ($stmt = $condb->prepare($sql)) {
    $stmt->bind_param('isssssi', $order_status, $pay_date, $pay_amount, $b_name, $b_number, $newname, $order_id);
    $result = $stmt->execute();

    if ($result) {
        echo "<script>";
        echo "alert('อัพโหลดสลิปเรียบร้อยแล้ว');";
        echo "window.location ='my_order.php?order_id=$order_id&act=show-order'; ";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert('ERROR!');";
        echo "window.location ='my_order.php?order_id=$order_id&act=show-order'; ";
        echo "</script>";
    }

    $stmt->close();
} else {
    echo "<script>";
    echo "alert('Error preparing statement');";
    echo "window.location ='my_order.php?order_id=$order_id&act=show-order'; ";
    echo "</script>";
}

$condb->close();
?>
