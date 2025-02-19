<?php require_once('Connections/condb.php'); ?>
<?php
session_start();

if (isset($_SESSION['MM_Username']) && $_SESSION['MM_Username'] != '') {
    // Get the username from the session
    $colname_pf = $_SESSION['MM_Username'];
    
    // Prepare and execute the SQL query
    $query_pf = "SELECT * FROM tbl_member WHERE mem_username = ?";
    $stmt = $condb->prepare($query_pf);
    $stmt->bind_param('s', $colname_pf);
    $stmt->execute();
    $result_pf = $stmt->get_result();

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
    <?php include('datatable.php'); ?>
    <style type="text/css">
      @media print {
        #hp {
          display: none;
        }
      }
    </style>
  </head>
  <body>
  <div class="container">
    <div class="row">
      <span id="hp">
        <?php include('banner.php'); ?>
      </span>
    </div>
    <div class="row">
      <div class="col-md-12" id="hp">
        <?php include('navbar.php'); ?>
      </div>
    </div>
  </div> 
  <!--start show product-->
  <div class="container">
    <div class="row">
      <!-- menu -->
      <div class="col-md-3" id="hp">
        <?php include('m_menu.php'); ?>
      </div>
      <!-- content -->
      <div class="col-md-1"></div>
      <div class="col-md-8">
        <?php 
          $page = isset($_GET['page']) ? $_GET['page'] : '';
          if ($page == 'mycart') {
              include('mycart.php');  
          } else {
              include('detail_order_afer_cartdone.php');
          }
        ?>
      </div>
    </div>
  </div>
  <!--end show product-->
  </body>
</html>
<?php
    $stmt->close(); // Close the prepared statement
    // $condb->close(); // Close the database connection
} else {
    include('logout.php'); // Handle session end
}
?>
<?php include('f.php'); ?>
