<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Quản lý người quản trị</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="shortcut icon" href="" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/sidenav.css">
  <link rel="stylesheet" href="css/pagination.css">
  <link rel="stylesheet" href="css/home.css">
  <script src="js/manage_customer.js"></script>
  <script src="js/validateForm.js"></script>
  <script src="js/restrict.js"></script>
</head>

<body style="max-height: 100%;">
  <!-- including side navigations -->
  <?php include("sections/sidenav.html"); ?>

  <div class="container-fluid">
    <div class="container">

      <!-- header section -->
      <?php
      require "php/header.php";
      createHeader('handshake', 'Quản lý người quản trị ', 'Danh sách người quản trị');
      ?>
      <!-- header section end -->

      <!-- form content -->
      <div class="row">

        <div class="col-md-12 form-group form-inline">
          <label class="font-weight-bold" for="">Tìm kiếm :&emsp;</label>
          <input style="width:50%" type="text" class="form-control" id="" placeholder="Nhập tên/số điện thoại"
            onkeyup="searchCustomer(this.value);">
          &emsp;
          <a class="btn btn-success" href="php/exportUserManager.php">Xuất Excel</a>
        </div>

        <div class="col col-md-12">
          <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
        </div>

        <div class="col col-md-12 table-responsive">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th style="width: 2%;">STT</th>
                  <th style="width: 10%;">id</th>
                  <th style="width: 10%;">Tên người quản trị</th>
                  <th style="width: 13%;">Số điện thoại</th>
                  <th style="width: 13%;">Gmail</th>
                  <th style="width: 17%;">Phòng ban</th>
                  <th style="width: 13%;">Chức vụ</th>
                  <th style="width: 13%;">Người tạo</th>
                  <th style="width: 17%;">Ngày tạo</th>
                  <th style="width: 15%;">Action</th>
                </tr>
              </thead>
              <tbody id="customers_div">
                <?php
                require 'php/manage_customer.php';
                showCustomers(0);
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