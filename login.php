<?php
require_once('Connections/condb.php');

if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType) 
    {
        global $condb;

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? $condb->real_escape_string($theValue) : "";
                break;    
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : 0;
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : 0.0;
                break;
            case "date":
                $theValue = ($theValue != "") ? $condb->real_escape_string($theValue) : "0000-00-00";
                break;
            default:
                $theValue = $condb->real_escape_string($theValue);
                break;
        }
        return $theValue;
    }
}

session_start();

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['mem_username'])) {
    $loginUsername = $_POST['mem_username'];
    $password = $_POST['mem_password'];
    $MM_fldUserAuthorization = "";
    $MM_redirectLoginSuccess = "index.php";
    $MM_redirectLoginFailed = "login.php";
    $MM_redirecttoReferrer = false;

    $loginUsername = GetSQLValueString($loginUsername, "text");
    $password = GetSQLValueString($password, "text");

    $sql = "SELECT mem_username, mem_password FROM tbl_member WHERE mem_username = ? AND mem_password = ?";
    $stmt = $condb->prepare($sql);
    $stmt->bind_param("ss", $loginUsername, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $loginFoundUser = $result->num_rows;

    if ($loginFoundUser) {
        $loginStrGroup = "";

        if (PHP_VERSION >= 5.1) {
            session_regenerate_id(true);
        } else {
            session_regenerate_id();
        }
        
        $_SESSION['MM_Username'] = $loginUsername;
        $_SESSION['MM_UserGroup'] = $loginStrGroup;

        if (isset($_SESSION['PrevUrl']) && false) {
            $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
        }
        header("Location: " . $MM_redirectLoginSuccess);
        exit;
    } else {
        header("Location: " . $MM_redirectLoginFailed);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('h.php'); ?>
</head>
<body>
<div class="container">
    <div class="row">
        <?php include('banner.php'); ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php include('navbar.php'); ?>
        </div>
    </div>
    <div class="row" style="padding-top:100px">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="background-color:#f4f4f4">
            <h3 align="center">
                <span class="glyphicon glyphicon-lock"> </span>
                กรุณา Login ก่อนทำรายการ !
            </h3>
            <form name="formlogin" action="<?php echo $loginFormAction; ?>" method="POST" id="login" class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-12">
                        <input name="mem_username" type="text" required class="form-control" id="mem_username" placeholder="Username" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input name="mem_password" type="password" required class="form-control" id="mem_password" placeholder="Password" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary" id="btn">
                            <span class="glyphicon glyphicon-log-in"> </span>
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('f.php'); ?>
</body>
</html>
