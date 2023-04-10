<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Quan ly nhom nguoi dung</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/sidenav.css">
  <link rel="stylesheet" href="css/home.css">
  <script src="js/suggestions.js"></script>
  <script src="js/add_new_purchase.js"></script>
  <script src="js/manage_purchase.js"></script>
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
      createHeader('bar-chart', 'Quản lý nhóm người dùng', 'Danh sách quản lý nhóm người dùng');
      ?>
      <!-- header section end -->

      <!-- form content -->
      <div class="row">
        <div class="col-md-12 form-group form-inline">
          <label class="font-weight-bold" for="">Tìm kiếm :&emsp;</label>
          <input type="text" class="form-control" id="" placeholder="Tên nHóm" onkeyup="searchPurchase(this.value);">
          &emsp;
          <select id="user_status" class="form-control" onchange="searchStatus(this.value)";>         
            <option value="" >Chọn trạng thái</option>
            <option value="1" >Họat động</option>
            <option value="0" >Đang tắt</option>
          </select>
          &emsp;
          <button class="btn btn-success font-weight-bold" onclick="cancel();"><i class="fa fa-refresh"></i></button>
          &emsp; <a class="btn btn-success" href="php/exportTeamUser.php">Xuất Excel</a>
        </div>

        <div class="col col-md-12">
          <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
        </div>

        <div class="col col-md-12 table-responsive">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th style="width: 1%;">STT</th>
                  <th style="width: 20%;">Tên nhóm người sử dụng</th>
                  <th style="width: 12%;">Trạng thái</th>
                  <th style="width: 12%;">Người tạo</th>
                  <th style="width: 12%;">Ngày tạo</th>
                  <th style="width: 5%;">Hành động</th>
                </tr>
              </thead>
              <tbody id="purchases_div">
                <?php
                require 'php/manage_purchase.php';
                showPurchases(0);
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