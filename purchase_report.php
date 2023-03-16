<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Purchase</title>
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
          createHeader('bar-chart', 'Quản lý người dùng', 'Danh sách quản lý người dùng');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Tìm kiếm :&emsp;</label>
            <input type="text" class="form-control" id="by_voucher_number" placeholder="Theo tên người sử dụng" onkeyup="searchPurchase(this.value, 'name_user_manager');">
            &emsp;<input type="text" class="form-control" id="by_suppliers_name" placeholder="Gmail" onkeyup="searchPurchase(this.value, 'gmail');">
            &emsp;<input type="number" class="form-control" id="by_invoice_number" placeholder="Số điện thoại" onkeyup="searchPurchase(this.value, 'sdt');">
            &emsp;<label class="font-weight-bold" for="">Theo ngày :&emsp;</label>
            <input type="date" class="form-control" id="by_purchase_date" onchange="searchPurchase(this.value, 'created_at');">
            &emsp;
            &emsp;<button class="btn btn-success font-weight-bold" onclick="cancel();"><i class="fa fa-refresh"></i></button>
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
                    <th style="width: 12%;">Nhóm người sử dụng</th>
                    <th style="width: 18%;">Tên người dùng</th>
            				<th style="width: 12%;">Số điện thoại</th>
                    <th style="width: 15%;">Gmail</th>
                    <th style="width: 10%;">Phòng</th>
                    <th style="width: 12%;">Vị trí</th>
                    <th style="width: 12%;">Người tạo</th>
                    <th style="width: 12%;">Hành động</th>
            			</tr>
            		</thead>
                <tbody id="purchases_div">
                  <?php
                    require 'php/report.php';
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
