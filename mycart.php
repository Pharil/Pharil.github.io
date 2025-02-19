<?php require_once('Connections/condb.php'); ?>
<?php
session_start();

if (isset($_SESSION['MM_Username']) && $_SESSION['MM_Username'] != '') {
    // Get the username from the session
    $colname_mm = $_SESSION['MM_Username'];
    
    // Prepare and execute the SQL query to fetch member details
    $query_mm = "SELECT * FROM tbl_member WHERE mem_username = ?";
    $stmt_mm = $condb->prepare($query_mm);
    $stmt_mm->bind_param('s', $colname_mm);
    $stmt_mm->execute();
    $result_mm = $stmt_mm->get_result();

    // Fetch the result
    $row_mm = $result_mm->fetch_assoc();
    $totalRows_mm = $result_mm->num_rows;

    $mem_id = $row_mm['mem_id'];

    // Prepare and execute the SQL query to fetch cart details
    $query_mycart = "
    SELECT 
        o.order_id AS oid, o.mem_id, o.order_status, o.order_date,
        d.order_id, COUNT(d.order_id) AS coid, SUM(d.total) AS ctotal
    FROM tbl_order AS o
    JOIN tbl_order_detail AS d ON o.order_id = d.order_id
    WHERE o.mem_id = ?
    GROUP BY o.order_id
    ORDER BY o.order_id DESC";
    $stmt_mycart = $condb->prepare($query_mycart);
    $stmt_mycart->bind_param('i', $mem_id);
    $stmt_mycart->execute();
    $result_mycart = $stmt_mycart->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cart</title>
    <!-- Include any necessary CSS or JS files here -->
</head>
<body>
    <p align="center">
        <button class="btn btn-primary btn-sm" onclick="window.print()"> พิมพ์ </button>
    </p>
    
    <table id="example" class="display" cellspacing="0" border="1">
        <thead>
            <tr>
                <th>รหัสการจองห้องพัก</th>
                <th>จำนวนรายการ</th>
                <th>ราคารวม</th>
                <th>สถานะ</th>
                <th>วันที่ทำรายการ</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row_mycart = $result_mycart->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php echo htmlspecialchars($row_mycart['oid']); ?>
                        <span id="hp">
                            <a href="my_order.php?order_id=<?php echo urlencode($row_mycart['oid']); ?>&act=show-order">
                                <span class="glyphicon glyphicon-zoom-in"></span>
                            </a>
                        </span>
                    </td>
                    <td align="center">
                        <?php echo htmlspecialchars($row_mycart['coid']); ?>
                    </td>
                    <td align="center">
                        <?php echo number_format($row_mycart['ctotal'], 2); ?>
                    </td>
                    <td align="center">
                        <font color="red">
                            <?php
                            $status = $row_mycart['order_status'];
                            include('backend/status.php');
                            ?>
                        </font>
                    </td>
                    <td><?php echo htmlspecialchars($row_mycart['order_date']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php
    $stmt_mycart->close(); // Close the prepared statement
    $stmt_mm->close(); // Close the prepared statement
    $condb->close(); // Close the database connection
} else {
    // Handle session end
    include('logout.php');
}
?>
<?php include('f.php'); ?>
