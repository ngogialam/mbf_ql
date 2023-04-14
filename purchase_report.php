<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Danh sách người dùng</title>
  <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/sidenav.css">
  <link rel="stylesheet" href="css/home.css">
  <script src="js/suggestions.js"></script>
  <script src="js/add_new_purchase.js"></script>
  <script src="js/managerUser.js"></script>
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
          <input type="text" style="width:50%" class="form-control" id="by_voucher_number" placeholder="Tên/Nhóm/sđt người sử dụng" onkeyup="searchUser(this.value);">
          &emsp;<button class="btn btn-success font-weight-bold" onclick="cancel();"><i class="fa fa-refresh"></i></button>
          &emsp; <a class="btn btn-success" href="php/exportUser.php">Xuất Excel</a>
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
                  <th>Tên người dùng</th>
                  <th style="width: 19%;">Nhóm người sử dụng</th>
                  <th>Mật Khẩu</th>
                  <th>Số điện thoại</th>
                  <th>Gmail</th>
                  <th>Phòng</th>
                  <th>Chức vụ</th>
                  <th>Người tạo</th>
                  <th>Thời gian tạo</th>
                  <th>Hành động</th>
                </tr>
              </thead>
              <tbody id="user_div">
                <?php
                require 'php/managerUser.php';
                showUser(0);
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
  <!-- Modal -->
  <div class="modal fade col-xs-6" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width:50%">
    <div class="modal-dialog " role="document">
      <div class="modal-content col-xs-6">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Chi tiết nhóm người dùng </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- <p>ID: <span id="popup_id"></span></p> -->
          <!-- ID: <span id="popup_id"></span> -->
          <?php
          require "php/db_connection.php";
          if ($con) {
            $ID = "<span id='popup_id'></span>";
            var_dump($ID);
            $query = "SELECT admin_credentials.ID,admin_credentials.USERNAME_USER, manager_team_user.name_team_user,manager_team_user.user_status,manager_team_user.create_by,manager_team_user.created_at FROM admin_credentials JOIN manager_team_user ON admin_credentials.id_team_user = manager_team_user.id_team_user WHERE ID = '$ID'";
            $result = mysqli_query($con, $query);
            $row_1 = mysqli_fetch_assoc($result);
            $name_team_user = $row_1['name_team_user'];
            $user_status = $row_1['user_status'];
            $create_by = $row_1['create_by'];
            $created_at = $row_1['created_at'];
          }
          ?>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>