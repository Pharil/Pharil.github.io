<?php require_once('Connections/condb.php'); ?>
<?php
session_start();

if (isset($_SESSION['MM_Username']) && $_SESSION['MM_Username'] != '') {
    // Prepare SQL query to avoid SQL injection
    $colname_pf = $_SESSION['MM_Username'];
    
    // Prepare the SQL statement
    $query_pf = $condb->prepare("SELECT * FROM tbl_member WHERE mem_username = ?");
    $query_pf->bind_param('s', $colname_pf);
    $query_pf->execute();
    $result_pf = $query_pf->get_result();

    // Fetch the result
    $row_pf = $result_pf->fetch_assoc();
    $totalRows_pf = $result_pf->num_rows;
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
  </div> 
  <!--start show product-->
  <div class="container">
    <div class="row">
      <!-- menu-->
      <div class="col-md-3">
        <?php include('m_menu.php'); ?>
      </div>
      <!-- content-->
      <div class="col-md-1"></div>
      <div class="col-md-6">
        <?php 
          $do = isset($_GET['do']) ? $_GET['do'] : '';
          if ($do == 'edit-profile') {
              include('edit_profile.php');
          } else {
        ?>
        <p style="font-size:18px">
          โปรไฟล์ คุณ <?php echo htmlspecialchars($row_pf['mem_name']); ?>  
          <a href="profile.php?do=edit-profile" class="btn btn-warning btn-xs">แก้ไข</a> <br>
          Username : <?php echo htmlspecialchars($row_pf['mem_username']); ?> <br>
          ที่อยู่  : <?php echo htmlspecialchars($row_pf['mem_address']); ?> <br>
          อีเมล์ : <?php echo htmlspecialchars($row_pf['mem_email']); ?> <br>
          เบอร์โทร : <?php echo htmlspecialchars($row_pf['mem_tel']); ?> <br>
          เป็นสมาชิกเมื่อ : <?php echo htmlspecialchars($row_pf['dateinsert']); ?>
        </p>
        <?php } ?>
      </div>
    </div>
  </div>
  <!--end show product-->
  </body>
</html>
<?php
    $query_pf->close(); // Close the prepared statement
} else {
    include('logout.php'); // Handle session end
}
?>
<?php include('f.php'); ?>
