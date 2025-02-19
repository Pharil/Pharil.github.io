<?php 
require_once('Connections/condb.php'); 

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

$colname_mlogin = "-1";
if (isset($_SESSION['MM_Username'])) {
    $colname_mlogin = $_SESSION['MM_Username'];
}

$query_mlogin = sprintf("SELECT * FROM tbl_member WHERE mem_username = %s", GetSQLValueString($colname_mlogin, "text"));
$mlogin = mysqli_query($condb, $query_mlogin) or die(mysqli_error($condb));
$row_mlogin = mysqli_fetch_assoc($mlogin);
$totalRows_mlogin = mysqli_num_rows($mlogin);
?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- Added "Celeste" as a brand name above "หน้าหลัก" -->
      <a class="navbar-brand" href="index.php" style="font-size: 36px; color: #0066cc; display: block; text-align: left;">Celeste</a>
      <a class="navbar-brand" href="index.php" style="font-size: 20px; color: #000;">หน้าหลัก</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <form class="navbar-form navbar-left" name="qp" action="index.php" method="GET">
        <div class="form-group"> &nbsp; 
        <b>  ค้นหาห้องพัก  </b> 
          <input type="text" class="form-control" placeholder="ระบุคำค้น" name="q">
        </div>
        <button type="submit" class="btn btn-info">ค้นหา</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="register.php">สมัครสมาชิก</a></li>
        
        <?php 
            if (isset($_SESSION['MM_Username']) && $_SESSION['MM_Username'] != '') {
                if ($totalRows_mlogin > 0) {
                    echo "<li>";
                    echo "<a href='profile.php'>" . "โปรไฟล์ :" . " คุณ" . $row_mlogin['mem_name'] . "</a>";
                    echo "</li>";
                } else {
                    echo "<li>";
                    echo "<a href='#'>ไม่พบข้อมูลผู้ใช้</a>";
                    echo "</li>";
                }
                
                echo "<li><a href='logout.php'>ออกจากระบบ</a></li>";
            } else {
                echo "<li><a href='login.php'>Login</a></li>";
            }
        ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php
mysqli_free_result($mlogin);
?>
