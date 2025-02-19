<?php
include('Connections/condb.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(error_reporting() & ~E_NOTICE);

$mem_id = $_POST['mem_id'];
$mem_password = $_POST['mem_password'];
$mem_name = $_POST['mem_name'];
$mem_email = $_POST['mem_email'];
$mem_tel = $_POST['mem_tel'];
$mem_address = $_POST['mem_address'];
$do = $_POST['do'];

// Prepare the SQL statement to avoid SQL injection
$sql = "UPDATE tbl_member SET
    mem_password = ?, 
    mem_name = ?, 
    mem_email = ?, 
    mem_tel = ?, 
    mem_address = ? 
    WHERE mem_id = ?";

$stmt = $condb->prepare($sql);
$stmt->bind_param('sssssi', $mem_password, $mem_name, $mem_email, $mem_tel, $mem_address, $mem_id);

$result = $stmt->execute();

if ($result) {
    echo "<script>";
    echo "window.location ='profile.php?act=edit-ok&do=$do'; ";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('ERROR: " . $stmt->error . "');";
    echo "window.location ='profile.php'; ";
    echo "</script>";
}

$stmt->close(); // Close the prepared statement
$condb->close(); // Close the database connection
?>
