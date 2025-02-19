<?php include('h.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        input[type=number]{
            width:40px;
            text-align:center;
            color:red;
            font-weight:600;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php include('navbar.php'); ?>
        </div>
    </div>
</div>
<!--start show  product-->
<div class="container">
    <div class="row">
        <!-- categories-->
        <div class="col-md-2">
            <?php include('category.php'); ?>
        </div>
        <!-- product-->
        <div class="col-md-7">
            <div class="panel panel-info">
                <div class="panel-heading"> รายการห้องพัก 
                    <!-- <a href="product.php" class="btn btn-info btn-xs"> ทั้งหมด </a>   -->
                </div>
            </div>
            
            <?php 
            // Safely handle the $_GET parameters
            $t_id = isset($_GET['t_id']) ? $_GET['t_id'] : '';
            $q = isset($_GET['q']) ? $_GET['q'] : '';

            if ($t_id != '') {
                include('listprd_by_type.php');
            } else if ($q != '') {
                include('listprd_by_q.php');                
            } else {
                include('listprd.php');
            }            
            ?>
        </div>
        
        <!-- cart-->
        <div class="col-md-3">
            <?php include('cart.php'); ?>
            <br><br>
            <!-- <div class="panel panel-danger">
                <div class="panel-heading"> สถานะพัสดุ </div>
            </div> -->
            <a href="https://www.agoda.com/th-th/?site_id=1919571&tag=3c5d815d-a417-4717-a783-2560673ea51b&gad_source=1&device=c&network=g&adid=684434488013&rand=13047759988996334231&expid=&adpos=&aud=kwd-2230651387&gclid=CjwKCAiA8Lu9BhA8EiwAag16b0RCiECTXPNqMgfuY781TY1yQz_vXCt9NBoFrwfbwPLs-2x64tsm8xoCC0QQAvD_BwE&pslc=1&ds=UT1L7ObMCjFe38Gl" target="_blank">
                <img src="img/โฆษณา/5.png" width="90%">
            </a>
            <br><br>
            <a href="https://www.booking.com/index.th.html?label=gen173nr-1BCAEoggI46AdIM1gEaN0BiAEBmAEmuAEXyAEM2AEB6AEBiAIBqAIDuAKHjcC9BsACAdICJDFhMzY2NmI2LWEwNDItNGZhZi05YzU4LWM2ZWMxZjgwZjJmOdgCBeACAQ&sid=0abe1354c28100c8c177ce6de49417ec&keep_landing=1&sb_price_type=total&" target="_blank">
                <img src="img/โฆษณา/6.png" width="90%">
            </a>
            <br><br>
            <a href="https://th.hotels.com/?locale=th_TH&pos=HCOM_TH&siteid=300000046" target="_blank">
                <img src="img/โฆษณา/7.png" width="90%">
            </a>
            <br><br>
            <a href="https://www.kayak.co.th/stays?lang=en&skipapp=true&gclid=CjwKCAiA8Lu9BhA8EiwAag16b8tuGsUnwmfGowKmfra4lejBBK-sICN4LR5FGiZ7h3NILQ2j-uTAnxoCElAQAvD_BwE" target="_blank">
                <img src="img/โฆษณา/8.png" width="90%">
            </a>
        </div>
    </div>
</div>
<!--end show  product-->
</body>
</html>

<?php include('f.php'); ?>