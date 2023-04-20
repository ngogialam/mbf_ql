<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Quản lý thiết bị </title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
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
      createHeader('Kiểm kê thiết bị', 'Quản lý thiết bị', 'Home');
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
          createSection1('manager_decive.php', 'Tổng số thiết bị cá nhân', 'device');
          createSection1('manager_decive.php', 'Tổng số thiết bị phòng', 'device_room');
        
          function createSection2($location, $title, $table, $use)
          {
            require 'php/db_connection.php';

            $query = "SELECT * FROM $table";
            $result = mysqli_query($con, $query);
            $count = mysqli_num_rows($result);
            $count_use = 0; 

            while ($row = mysqli_fetch_array($result)) {
            if ($row['status_device']=='1')
                $count_use++;
            }
            
            $count_unuse = $count - $count_use;

            if($use){
                echo '
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding: 10px">
                  <div class="dashboard-stats" onclick="location.href=\'' . $location . '\'">
                    <a class="text-dark text-decoration-none" href="' . $location . '">
                      <span class="h4">' . $count_use . '</span>
                      <span class="h6"><i class="fa fa-play fa-rotate-270 text-warning"></i></span>
                      <div class="small font-weight-bold">' . $title . '</div>
                    </a>
                  </div>
                </div>
              ';
            }
            else {
                echo '
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding: 10px">
                  <div class="dashboard-stats" onclick="location.href=\'' . $location . '\'">
                    <a class="text-dark text-decoration-none" href="' . $location . '">
                      <span class="h4">' . $count_unuse . '</span>
                      <span class="h6"><i class="fa fa-play fa-rotate-270 text-warning"></i></span>
                      <div class="small font-weight-bold">' . $title . '</div>
                    </a>
                  </div>
                </div>
              ';
            }
          }

          createSection2('manager_decive.php', 'Tổng số thiết bị cá nhân chưa sử dụng', 'device', false);
          createSection2( 'manager_decive.php', 'Tổng số thiết bị cá nhân đã sử dụng','device', true);
          createSection2('manager_decive.php', 'Tổng số thiết bị phòng chưa sử dụng', 'device_room', false);
          createSection2( 'manager_decive.php', 'Tổng số thiết bị phòng đã sử dụng','device_room', true);
          ?>
    </div>
  </div>
  <?php
  require "php/footer.php";

  
  ?>
</body>

</html>