<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Manager System - Home</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
  <link rel="stylesheet" href="css/sidenav.css">
  <link rel="stylesheet" href="css/home.css">
  <script src="js/restrict.js"></script>
</head>

<body>
  <?php include "sections/sidenav.html"; ?>
  <div class="container-fluid">
    <div class="container">
      <!-- header section -->
      <?php
      require "php/header.php";
      createHeader('home', 'Manager System', 'Home');
      ?>
      <!-- header section end -->

      <!-- form content -->
      <div class="row">
        <div class="row col col-xs-12 col-sm-12 col-md-12 col-lg-12">

          <?php
          function createSection1($location, $title, $table)
          {
            require 'php/db_connection.php';

            $query = "SELECT * FROM $table";
            if ($title == "Out of Stock")
              $query = "SELECT * FROM $table WHERE QUANTITY = 0";

            $result = mysqli_query($con, $query);
            $count = mysqli_num_rows($result);


            if ($title == "Expired") {
              // logic
              $count = 0;
              while ($row = mysqli_fetch_array($result)) {
                $expiry_date = $row['EXPIRY_DATE'];
                if (substr($expiry_date, 3) < date('y'))
                  $count++;
                else if (substr($expiry_date, 3) == date('y')) {
                  if (substr($expiry_date, 0, 2) < date('m'))
                    $count++;
                }
              }
            }

            echo '
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding: 10px">
                    <div class="dashboard-stats" onclick="location.href=\'' . $location . '\'">
                      <a class="text-dark text-decoration-none" href="' . $location . '">
                        <span class="h4">' . $count . '</span>
                        <span class="h6"><i class="fa fa-play fa-rotate-270 text-warning"></i></span>
                        <div class="small font-weight-bold">' . $title . '</div>
                      </a>
                    </div>
                  </div>
                ';
          }
          createSection1('manage_invoice.php', 'Tổng số hệ thống ', 'sys_ql');
          createSection1('manage_supplier.php', 'Tổng số nhóm hệ thống', 'team_sys_manager');
          createSection1('manage_customer.php', 'Tổng số người quản trị', 'user_manager');
          createSection1('manage_medicine.php', 'Tổng số đơn vị quản lý', 'unit_sys');
          createSection1('manage_medicine_stock.php', 'Tổng số đơn vị sử dụng', 'unit_user');
          createSection1('purchase_report.php', 'Tổng số người dùng', 'manager_user');
          createSection1('manage_purchase.php', 'Tổng số nhóm người dùng', 'manager_team_user');
          ?>

        </div>        
          <hr style="border-top: 2px solid #ff5252;">      
        <div class="row">

          <?php
          function createSection2($icon, $location, $title)
          {
            echo '
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding: 10px;">
          <div class="dashboard-stats" style="padding: 30px 15px;" onclick="location.href=\'' . $location . '\'">
            <div class="text-center">
              <span class="h1"><i class="fa fa-' . $icon . ' p-2"></i></span>
              <div class="h5">' . $title . '</div>
            </div>
          </div>
        </div>
      ';
          }
          createSection2('clipboard', 'new_invoice.php', 'Khai báo hệ thống mới');
          createSection2('handshake', 'add_customer.php', 'Thêm mới người quản trị');
          createSection2('shopping-bag', 'add_medicine.php', 'Thêm mới đơn vị quản lý');
          createSection2('group', 'add_supplier.php', 'Thêm mới nhóm hệ thống');
          createSection2('bar-chart', 'add_new_user_unit.php', 'Thêm mới đơn vị sử dụng');
          createSection2('address-card', 'add_purchase.php', 'Thêm mới nhóm người sử dụng');
          createSection2('book', 'add_new_user.php', 'Thêm mới người sử dụng');
          createSection2('book', 'add_import_file.php', 'Import file dữ liệu');
          ?>

        </div>

      </div>

      <hr style="border-top: 2px solid #ff5252;">


      <!-- form content end -->

      <hr style="border-top: 2px solid #ff5252;">

    </div>
  </div>
  <?php
  require "php/footer.php";
  ?>
</body>

</html>