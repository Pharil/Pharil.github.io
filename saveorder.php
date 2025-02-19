<?php
    error_reporting(error_reporting() & ~E_NOTICE);
    @session_start();
    require_once('Connections/condb.php');

    date_default_timezone_set('Asia/Bangkok');

    $mem_id = $_POST['mem_id'];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $total = 0; // กำหนดค่าเริ่มต้น
    $order_date = date("Y-m-d H:i:s");
    $pay_slip = '';
    $b_name = '';
    $b_number = '';
    $pay_date = '';
    $pay_amount = '';
    $postcode = '';

    // เริ่ม Transaction
    $condb->begin_transaction();

    // บันทึกคำสั่งซื้อหลัก
    $sql1 = "INSERT INTO tbl_order (mem_id, name, address, email, phone, pay_slip, b_name, b_number, pay_date, pay_amount, postcode, order_date) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt1 = $condb->prepare($sql1);
    $stmt1->bind_param('ssssssssssss', $mem_id, $name, $address, $email, $phone, $pay_slip, $b_name, $b_number, $pay_date, $pay_amount, $postcode, $order_date);

    if (!$stmt1->execute()) {
        $condb->rollback();
        die("Error in query: " . $stmt1->error);
    }

    $order_id = $condb->insert_id;

    // วนลูปเพิ่มสินค้าในคำสั่งซื้อ
    foreach ($_SESSION['shopping_cart'] as $p_id => $p_qty) {
        $sql3 = "SELECT * FROM tbl_product WHERE p_id = ?";
        $stmt3 = $condb->prepare($sql3);
        $stmt3->bind_param('i', $p_id);
        $stmt3->execute();
        $result3 = $stmt3->get_result();
        $row3 = $result3->fetch_assoc();

        if (!$row3) {
            $condb->rollback();
            die("Error: Product ID not found.");
        }

        $p_name = $row3['p_name']; // ใช้ค่าจากฐานข้อมูลแทน
        $total = $row3['p_price'] * $p_qty;

        // เพิ่มข้อมูลลงใน tbl_order_detail
        $sql4 = "INSERT INTO tbl_order_detail (order_id, p_id, p_name, total) VALUES (?, ?, ?, ?)";
        $stmt4 = $condb->prepare($sql4);
        $stmt4->bind_param('iisi', $order_id, $p_id, $p_name, $total);

        if (!$stmt4->execute()) {
            $condb->rollback();
            die("Error in query: " . $stmt4->error);
        }
    }

    // ยืนยันการทำธุรกรรม
    $condb->commit();
    unset($_SESSION['shopping_cart']);

    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว'); window.location ='my_order.php?order_id=$order_id&act=show-order'; </script>";

    // ปิดการเชื่อมต่อ
    $stmt1->close();
    $stmt3->close();
    $stmt4->close();
    $condb->close();
?>
