<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Danh sách hệ thống</title>
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
  <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/sidenav.css">
  <link rel="stylesheet" href="css/popup.css">
  <link rel="stylesheet" href="css/home.css">
  <script src="js/manage_invoice.js"></script>
  <script src="js/restrict.js"></script>
</head>

<body>
  <!-- including side navigations -->
  <?php include("sections/sidenav.html"); ?>

  <div class="container-fluid" style="margin-right: 0px;">
    <div class="container">

      <!-- header section -->
      <?php
      require "php/header.php";
      createHeader('address-book', 'Quản lý hệ thống', 'Danh sách hệ thống');
      ?>
      <!-- header section end -->

      <!-- form content -->
      <div class="row">

        <div class="col-md-12 form-group form-inline">
          <label class="font-weight-bold" for="">Search :&emsp;</label>
          <input type="text" class="form-control" id="by_invoice_number" placeholder="Nhập tên hệ thống "
            onkeyup="searchInvoice(this.value);">
          &emsp;          
          <button class="btn btn-success font-weight-bold" onclick="refresh();"><i class="fa fa-refresh"></i></button>
          &emsp;  
          <a class="btn btn-success" href="php/exportSys.php">Xuất file</a>
        </div>

        <div class="col col-md-12">
          <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
        </div>


        <div class="col col-md-12 table-responsive">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>ID hệ thống</th>
                  <th>Tên hệ thống </a></th>
                  <th>Đầu số </th>
                  <th>Đơn vị quản lý</th>
                  <th>Người quản lý</th>
                  <th>Nhóm hệ thống</th>
                  <th>IP hệ thống</th>
                  <th>Server hệ thống</th>
                  <th>Cấu hình hệ thống</th>
                  <th>Thời gian tạo</th>
                  <th >Action</th> 
                </tr>
              </thead>
              <tbody id="invoices_div">
                <?php
                require 'php/manage_invoice.php';
                showInvoices();
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Modal xem chi tiết hệ thống -->
        <!-- edit cho ng dùng -->
      </div>
      <!-- form content end -->
      <hr style="border-top: 2px solid #ff5252;">
    </div>
  </div>
</body>

</html>