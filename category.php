<?php //require_once('Connections/condb.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
        global $condb;

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

$query_typeprd = "SELECT * FROM tbl_type ORDER BY t_id ASC";
$typeprd = mysqli_query($condb, $query_typeprd) or die(mysqli_error($condb));
$row_typeprd = mysqli_fetch_assoc($typeprd);
$totalRows_typeprd = mysqli_num_rows($typeprd);
?>

<div class="list-group">
    <a href="index.php" class="list-group-item active">หมวดห้องพัก</a>
              
    <?php do { ?>
        <a href="index.php?t_id=<?php echo $row_typeprd['t_id'];?>&type-name=<?php echo $row_typeprd['t_name'];?>" class="list-group-item"> 
            <?php echo $row_typeprd['t_name']; ?>
        </a>
    <?php } while ($row_typeprd = mysqli_fetch_assoc($typeprd)); ?>
                        
</div>


<?php
mysqli_free_result($typeprd);
?>
