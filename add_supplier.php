<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Thêm mới nhóm hệ thống</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <!-- including side navigations -->
    <?php include("sections/sidenav.html"); ?>

    <div class="container-fluid">
      <div class="container">
        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('group', 'Thêm mới nhóm hệ thống', 'Thêm mới nhóm');
          // header section end
        ?>
        <div class="row">
          <div class="row col col-md-6" id="new_system_team">
            <?php
              if(isset($_GET["mess"]) && $_GET['mess']){
                $mess = $_GET['mess'];
                echo "<div class='col-md-12 h5 text-success font-weight-bold text-center' style='font-family: sans-serif;'>$mess</div>";
              }
              require "sections/add_new_supplier.html";
            ?>
          </div>
        </div>
        <hr style="border-top: 2px solid #ff5252;">

      </div>
    </div>
  </body>
</html>
