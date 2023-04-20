<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Thêm mới thiết bị </title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/validateForm.js"></script>
    <script src="js/manager_decive.js"></script>
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
          createHeader('handshake', 'Thêm mới thiết bị cá nhân', 'Thêm thiết bị cá nhân');
          // header section end
        ?>
        <div class="row" id='decive_div'>
          <div class="row col col-md-6">
          <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label class="font-weight-bold" for="">Tên thiết bị:</label>
                <input type="text" class="form-control" id="name_device" placeholder="Tên thiết bị">
              </div>
            </div>
            
            <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label class="font-weight-bold" for="">Số serial thiết bị :</label>
                <input type="text" class="form-control" id="code_device" placeholder="Số serial">
              </div>
            </div>
            
            <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label class="font-weight-bold" for="suppliers_name">Trạng thái</label>
                <select name="" id="status_device" class=" form-control pdm chosen-select col col-md-12" >
                  <option value= '0' selected='selected'>Không dùng</option>
                  <option value= '1' >Đang dùng</option>
                  <option value= '2' >Chuyển tiếp</option>
                </select>
              </div>
            </div>

            <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label class="font-weight-bold" for="suppliers_name">Người dùng</label>
                <!-- <select name="type_sys" id="type_sys" class=" form-control pdm chosen-select col col-md-12" > -->
                <input type="text" class="form-control" id="name_owner" placeholder="Người dùng">
              </div>
            </div>

            <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label class="font-weight-bold" for="suppliers_name">Phòng ban</label>
                <?php
                    require "php/db_connection.php";
                    if ($con) {
                        $query = "SELECT * FROM sys_room";
                        $result = mysqli_query($con, $query);
                        echo '<select name="sys_room" id="id_room" class=" form-control pdm chosen-select col col-md-12" >';
                        echo "<option value= '0' selected>Chọn 1 phòng ban...</option>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id_room = $row['id_room'];
                            $name_room = $row['name_room'];
                            echo "<option value= '$id_room'>$name_room</option>";
                        }
                        echo '</select>';
                    }
                    ?>
                </select>
              </div>
            </div>
            <!-- new user button -->
            <div class="row col col-md-12">
              &emsp;
              <div class="form-group m-auto">
                <button class="btn btn-primary form-control" onclick="addNewDeviceIndividual();">Thêm mới thiết bị cá nhân</button>
              </div>
            </div>
            <!-- customer details content end -->
            <!-- result message -->
            <div id="medicine_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"></div>
          </div>
        </div>
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
