<meta charset="UTF-8" />
<?php
// Include the database connection file
include('Connections/condb.php');

// Error reporting settings
error_reporting(E_ALL & ~E_NOTICE);

// Get POST data and escape special characters
$mem_username = $condb->real_escape_string($_POST['mem_username']);
$mem_password = $condb->real_escape_string($_POST['mem_password']);
$mem_name = $condb->real_escape_string($_POST['mem_name']);
$mem_email = $condb->real_escape_string($_POST['mem_email']);
$mem_tel = $condb->real_escape_string($_POST['mem_tel']);
$mem_address = $condb->real_escape_string($_POST['mem_address']);

// Check if username already exists
$check_sql = "SELECT * FROM tbl_member WHERE mem_username='$mem_username'";
$result1 = $condb->query($check_sql);

if ($result1->num_rows > 0) {
    echo "<script>";
    echo "alert('Username already exists. Please try a different one.');";
    echo "window.location ='register.php'; ";
    echo "</script>";
} else {
    // Insert new member
    $sql = "INSERT INTO tbl_member (mem_username, mem_password, mem_name, mem_email, mem_tel, mem_address) 
            VALUES ('$mem_username', '$mem_password', '$mem_name', '$mem_email', '$mem_tel', '$mem_address')";

    if ($condb->query($sql) === TRUE) {
        echo "<script>";
        echo "alert('Registration successful. Please log in to continue.');";
        echo "window.location ='login.php'; ";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert('Error: " . $condb->error . "');";
        echo "window.location ='index.php'; ";
        echo "</script>";
    }
}

// Close the connection
$condb->close();
?>
