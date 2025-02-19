<?php require_once('Connections/condb.php'); ?>
<?php
session_start();

if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
        global $condb;

        // Use prepared statements for security
        switch ($theType) {
            case "text":
                return $theValue !== "" ? "'" . $condb->real_escape_string($theValue) . "'" : "NULL";
            case "long":
            case "int":
                return $theValue !== "" ? intval($theValue) : "NULL";
            case "double":
                return $theValue !== "" ? doubleval($theValue) : "NULL";
            case "date":
                return $theValue !== "" ? "'" . $condb->real_escape_string($theValue) . "'" : "NULL";
            case "defined":
                return $theValue !== "" ? $theDefinedValue : $theNotDefinedValue;
        }
    }
}

$colname_editm = "-1";
if (isset($_SESSION['MM_Username'])) {
    $colname_editm = $_SESSION['MM_Username'];
}

// Prepare SQL statement
$query_editm = $condb->prepare("SELECT * FROM tbl_member WHERE mem_username = ?");
$query_editm->bind_param('s', $colname_editm);
$query_editm->execute();
$result_editm = $query_editm->get_result();

// Fetch the result
$row_editm = $result_editm->fetch_assoc();
$totalRows_editm = $result_editm->num_rows;
?>

<h3 align="center">แก้ไขสมาชิก <?php include('backend/edit-ok.php'); ?></h3>
<form name="register" action="edit_profile_db.php" method="POST" id="register" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-5" align="left">
            <font color="red"> *กรุณากรอกข้อมูลให้ครบทุกช่อง </font>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2" align="right"> Username : </div>
        <div class="col-sm-5" align="left">
            <input name="mem_username" type="text" disabled class="form-control" id="mem_username" value="<?php echo htmlspecialchars($row_editm['mem_username']); ?>" minlength="2" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2" align="right"> Password : </div>
        <div class="col-sm-5" align="left">
            <input name="mem_password" type="password" required class="form-control" id="mem_password" placeholder="password" pattern="^[a-zA-Z0-9]+$" value="<?php echo htmlspecialchars($row_editm['mem_password']); ?>" minlength="2" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2" align="right"> ชื่อ-สกุล : </div>
        <div class="col-sm-7" align="left">
            <input name="mem_name" type="text" required class="form-control" id="mem_name" placeholder="ชื่อ-สกุล" value="<?php echo htmlspecialchars($row_editm['mem_name']); ?>" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2" align="right"> อีเมล์ : </div>
        <div class="col-sm-6" align="left">
            <input name="mem_email" type="email" class="form-control" id="mem_email" placeholder="อีเมล์" value="<?php echo htmlspecialchars($row_editm['mem_email']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2" align="right"> เบอร์โทร : </div>
        <div class="col-sm-6" align="left">
            <input name="mem_tel" type="text" class="form-control" id="mem_tel" placeholder="เบอร์โทร" value="<?php echo htmlspecialchars($row_editm['mem_tel']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2" align="right"> ที่อยู่ : </div>
        <div class="col-sm-6" align="left">
            <textarea name="mem_address" class="form-control" id="mem_address" required><?php echo htmlspecialchars($row_editm['mem_address']); ?></textarea> 
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary" id="btn">บันทึก</button>
            <input name="mem_id" type="hidden" id="mem_id" value="<?php echo htmlspecialchars($row_editm['mem_id']); ?>">
            <input name="do" type="hidden" id="do" value="edit-profile">
        </div>
    </div>
</form>        

<?php
$query_editm->close(); // Close the statement
$condb->close(); // Close the connection
?>
