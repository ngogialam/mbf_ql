<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Thêm mới nhóm người sử dụng</title>
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
            <div class="font-weight-bold">Thêm mới nhóm người sử dụng</div>
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
          createHeader('bar-chart', 'Thêm mới nhóm người dùng', 'Thêm mới nhóm người sử dụng');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
          <!-- manufacturer details content -->
          <div class="row col col-md-12">
          <div class="row col col-md-12">
    <div class="col col-md-12 form-group">
      <label class="font-weight-bold" for="medicine_name"> Tên nhóm người sử dụng :</label>
      <input type="text" class="form-control" id="name_team_user" placeholder="Tên nhóm người sử dụng" >
    </div>
  </div>
  
  <div class="row col col-md-12">
    <div class="col col-md-12 form-group">
      <label class="font-weight-bold" for="generic_name">Trạng thái người sử dụng :</label>
        <select name="user_status" id="user_status" class=" form-control pdm chosen-select col col-md-12" >
              <option value= '1' selected='selected'>Hoạt động</option>
              <option value='2'>Không hoạt động</option>
        </select>
    </div>
  </div>
  
  <div class="row col col-md-12">
    <div class="col col-md-12 form-group">
      <label class="font-weight-bold" for="suppliers_name">Người tạo :</label>
      <input  type="text" class="form-control" id="create_by" placeholder="Người tạo" name="suppliers_name" >
    </div>
  </div>
  
  <hr>
  
  
  <!-- new user button -->
  <div class="row col col-md-12">
    &emsp;
    <div class="form-group m-auto">
      <button class="btn btn-primary form-control" onclick="addNewGroupUser();">Thêm mới nhóm người sử dụng</button>
    </div>
    <!--
    &emsp;
    <div class="form-group">
      <button class="btn btn-success form-control">Save and Add Another</button>
    </div>
  -->
  </div>
  <!-- customer details content end -->
  <!-- result message -->
  <div id="team_user" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"></div>
      </div>
    </div>
  </body>
</html>
