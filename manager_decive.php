<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Danh sách tài sản cá nhân</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/sidenav.css">
  <link rel="stylesheet" href="css/home.css">
  <script src="js/manager_decive.js"></script>
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
      createHeader('group', 'Danh sách tài sản cá nhân', 'Danh sách thiết bị');
      ?>
      <!-- header section end -->

      <!-- form content -->
      <div class="row">

        <div class="col-md-12 form-group form-inline">
          <label class="font-weight-bold" for="">Tìm kiếm :&emsp;</label>
          <input type="text" style="width:20%" class="form-control" id="" placeholder="Nhập tên nhóm hệ thống" onkeyup="searchSupplier(this.value); ">
          &emsp;
          <select id="status_device" class="form-control" onchange="searchStatus(this.value)" ;>
            <option value="">Chọn trạng thái</option>
            <option value="1">Đang sử dụng</option>
            <option value="0">Không dùng</option>
            <option value="2">Chuyển giao</option>
          </select>
          &emsp;
          <select id="status_device" class="form-control" onchange="searchRoom(this.value)" ;>
            <option value="">Phòng ban</option>
            <option value="1">Đang sử dụng</option>
            <option value="0">Không dùng</option>
            <option value="2">Chuyển giao</option>
          </select>
          &emsp;
          <button class="btn btn-success font-weight-bold" onclick="refresh();"><i class="fa fa-refresh"></i></button>
          &emsp; <a class="btn btn-success" href="php/export.php">Xuất Excel</a>
        </div>
        <div class="col col-md-12">
          <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
        </div>

        <div class="col col-md-12 table-responsive">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th style="width: 5%;">STT</th>
                  <th >Tên Người dùng</th>
                  <th >Tên người chuyển</th>
                  <th >Tên thiết bị </th>                  
                  <th >Mã Thiết bị</th>
                  <th >Tên phòng</th>
                  <th >Trạng thái</th>
                  <th >Ngày tạo</th>
                  <th >Hành động</th>
                </tr>
              </thead>
              <tbody id="decive_div">
                <?php
                require 'php/manager_decive.php';
                showDevice(0);
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
      <!-- form content end -->
      <hr style="border-top: 2px solid #ff5252;">
    </div>
  </div>
</body>

</html>