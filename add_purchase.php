<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Purchase</title>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script type="text/javascript" src="js/suggestions.js"></script>
    <script type="text/javascript" src="js/add_new_purchase.js"></script>
    <script type="text/javascript" src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <div id="add_new_supplier_model">
      <div class="modal-dialog">
      	<div class="modal-content">
      		<div class="modal-header" style="background-color: #ff5252; color: white">
            <div class="font-weight-bold">Add New Supplier</div>
      			<button class="close" style="outline: none;" onclick="document.getElementById('add_new_supplier_model').style.display = 'none';"><i class="fa fa-close"></i></button>
      		</div>
      		<div class="modal-body">
            <?php
              include('sections/add_new_supplier.html');
            ?>
      		</div>
      	</div>
      </div>
    </div>
    <!-- including side navigations -->
    <?php include("sections/sidenav.html"); ?>

    <div class="container-fluid">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('bar-chart', 'Thêm mới người dùng', 'Thêm người sử dụng');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
          <!-- manufacturer details content -->
          <div class="row col col-md-12">

            <div class="col col-md-4 form-group">
              <label class="font-weight-bold" for="suppliers_name">Tên nhóm người sử dụng :</label>
              <input id="suppliers_name" type="text" class="form-control" placeholder="Tên nhóm người sử dụng" name="name_team_user" onkeyup="showSuggestions(this.value, 'supplier');">
              <div id="supplier_suggestions" class="list-group position-fixed" style="z-index: 1; width: 25.10%; overflow: auto; max-height: 200px;"></div>
            </div>

            <div class="col col-md-3 form-group">
              <label class="font-weight-bold" for=""> Trạng thái người sử dụng:</label>
              <input type="number" class="form-control" placeholder="Trạng thái người sử dụng" id="invoice_number" name="user_status" onblur="notNull(this.value, 'invoice_number_error'); checkInvoice(this.value, 'invoice_number_error');">
              <code class="text-danger small font-weight-bold float-right" id="invoice_number_error" style="display: none;"></code>
            </div>
            <div class="col col-md-3 form-group">
              <label class="font-weight-bold" for=""> Người tạo:</label>
              <input type="number" class="form-control" placeholder="Người t" id="invoice_number" name="create_by" onblur="notNull(this.value, 'invoice_number_error'); checkInvoice(this.value, 'invoice_number_error');">
              <code class="text-danger small font-weight-bold float-right" id="invoice_number_error" style="display: none;"></code>
            </div>
          </div>

          <div class="row col col-md-12">
            <div class="col col-md-2 font-weight-bold" style="color: green; cursor:pointer" onclick="document.getElementById('add_new_supplier_model').style.display = 'block';">
            	<i class="fa fa-plus"></i>&nbsp;Thêm mới nhóm người sử dụng  
            </div>
          </div>
          <!-- supplier details content end -->
        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
