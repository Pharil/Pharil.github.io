<?php
require_once('Connections/condb.php'); // Ensure the connection is established

if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
        global $condb; // Ensure $condb is available inside this function

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . mysqli_real_escape_string($condb, $theValue) . "'" : "NULL";
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

// Assuming $condb is a valid mysqli connection
$query_prd = "SELECT * FROM tbl_product ORDER BY p_id ASC LIMIT 0, 9";
$prd = mysqli_query($condb, $query_prd) or die(mysqli_error($condb));
$row_prd = mysqli_fetch_assoc($prd);
$totalRows_prd = mysqli_num_rows($prd);
?>

<?php while ($row_prd) { ?>
  <div class="col-sm-4" align="center">
    <img src="pimg/<?php echo htmlspecialchars($row_prd['p_img1']); ?>" width="80%" />
    <p align="center">
      <b><?php echo htmlspecialchars($row_prd['p_name']); ?> 
      <br/>
      <font color="red">  
        <?php echo htmlspecialchars($row_prd['p_price']); ?> บาท 
      </font> 
      </b>
      <br />
      <a href="product-detail.php?p_id=<?php echo urlencode($row_prd['p_id']); ?>&act=product-detail" class="btn btn-info btn-xs" target="_blank">
        <span class="glyphicon glyphicon-search"></span> รายละเอียดห้องพัก 
      </a>
      
      <?php include('outstock.php'); ?>
      
      <br><br>
    </p>
  </div>
<?php 
    $row_prd = mysqli_fetch_assoc($prd); // Fetch the next row
} ?>

<?php
mysqli_free_result($prd);
?>
