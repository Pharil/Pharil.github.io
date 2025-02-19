<?php
require_once('Connections/condb.php');
session_start();

// ตรวจสอบว่ามีการส่งค่ามาหรือไม่
if (isset($_POST['confirm']) && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // อัปเดตสถานะการจอง
    $sql = "UPDATE tbl_orders SET order_status = 'confirmed' WHERE order_id = '$order_id'";
    $result = mysqli_query($condb, $sql);

    if ($result) {
        echo "<script>alert('การจองได้รับการยืนยันเรียบร้อย'); window.location='index.php?act=show-order';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการยืนยันการจอง'); history.back();</script>";
    }
} else {
    echo "<script>alert('ข้อมูลไม่ถูกต้อง'); history.back();</script>";
}
?>
