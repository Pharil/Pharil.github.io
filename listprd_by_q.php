<?php require_once('Connections/condb.php'); ?>
<?php
// Fetch search query from the GET request
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Prepare SQL query with placeholders
$query_prd = "SELECT * FROM tbl_product WHERE p_name LIKE ? OR p_detial LIKE ? ORDER BY p_id ASC";
$stmt_prd = $condb->prepare($query_prd);

// Bind parameters
$searchTerm = "%$q%";
$stmt_prd->bind_param('ss', $searchTerm, $searchTerm);

// Execute the query
$stmt_prd->execute();
$result_prd = $stmt_prd->get_result();

// Fetch the results
$row_prd = $result_prd->fetch_assoc();
$totalRows_prd = $result_prd->num_rows;
?>

<?php do { ?>
  <div class="col-sm-4" align="center">
    <img src="pimg/<?php echo htmlspecialchars($row_prd['p_img1']); ?>" width="80%" />
    <p align="center">
      <b><?php echo htmlspecialchars($row_prd['p_name']); ?> <font color="red"> <?php echo htmlspecialchars($row_prd['p_price']); ?> บาท </font> </b>
      <br />
      <a href="product-detail.php?p_id=<?php echo urlencode($row_prd['p_id']); ?>&act=product-detail" class="btn btn-info btn-xs" target="_blank">
        <span class="glyphicon glyphicon-search"></span> รายละเอียด
      </a>
      <?php include('outstock.php'); ?>
      <br><br>
    </p>
  </div>
<?php } while ($row_prd = $result_prd->fetch_assoc()); ?>

<?php
// Free result and close the statement
$stmt_prd->free_result();
$stmt_prd->close();

// Close the database connection
$condb->close();
?>
