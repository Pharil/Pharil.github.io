<?php 
//require_once('Connections/condb.php'); 
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($GLOBALS['condb'], $theValue) : addslashes($theValue);

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

$t_id = $_GET['t_id'];
// Select the database
mysqli_select_db($condb, $database_condb);
// Query the database
$query_prd = "SELECT * FROM tbl_product WHERE t_id=$t_id ORDER BY p_id ASC";
$prd = mysqli_query($condb, $query_prd) or die(mysqli_error($condb));
$row_prd = mysqli_fetch_assoc($prd);
$totalRows_prd = mysqli_num_rows($prd);

if($totalRows_prd > 0) { ?>

<?php do { ?>
  <div class="col-sm-4" align="center">
    <img src="pimg/<?php echo $row_prd['p_img1'];?>" width="80%" />
    <p align="center">
      <b><?php echo $row_prd['p_name']; ?> <font color="red">  <?php echo $row_prd['p_price']; ?>  บาท </font> </b>
      <br />
      <a href="product-detail.php?p_id=<?php echo $row_prd['p_id'];?>&act=product-detail" class="btn btn-info btn-xs" target="_blank"> <span class="glyphicon glyphicon-search"></span> รายละเอียด </a>
      
      <?php include('outstock.php');?>
      
      <br><br>
      </p>
    </div>
  <?php } while ($row_prd = mysqli_fetch_assoc($prd)); ?>

  <?php } else{
      echo "<h4 align='center'>";
      echo "ไม่มีห้องพัก";
      echo "</h4>";
   }?>
<?php
mysqli_free_result($prd);
?>
