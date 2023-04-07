<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Thêm mới quản trị người dùng</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="shortcut icon" href="" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/sidenav.css">
  <link rel="stylesheet" href="css/home.css">
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
      createHeader('handshake', 'Thêm mới người quản trị người dùng', 'Thêm mới ');
      // header section end
      ?>      
      <div class="row">
        <div class="row col col-md-6">
              <!-- customer details content -->
<!-- customer name control -->
<div class="row col col-md-12">
    <div class="col col-md-12 form-group">
        <label class="font-weight-bold" for="name_user_manager">Tên người quản trị :</label>
        <input type="text" class="form-control" placeholder="Tên người quản trị" id="name_user_manager" onkeyup="validateName(this.value, 'name_err');">
        <code class="text-danger small font-weight-bold float-right" id="name_err" style="display: none;"></code>
    </div>
</div>

<div class="row col col-md-12" style="flex-direction: row-reverse;">

<div class="col col-md-12 form-group">
    <label for="name_team_sys">Tên nhóm hệ thống :</label>
    <?php
    require "php/db_connection.php";
    $team_sys = "";
    if ($con) {
        $query = "SELECT * FROM team_sys_manager";
        $result = mysqli_query($con, $query);

        echo '<select name="team_sys_manager" id="team_sys_manager" class=" form-control pdm chosen-select col col-md-12" >';
        while ($row = mysqli_fetch_assoc($result)) {
            $id_team_sys = $row['id_team_sys'];
            $name_team_sys = $row['name_team_sys'];
            if ($id_team_sys == $id_team_sys_sys){
                $team_sys = $name_team_sys;
                echo "<option value= '$id_team_sys' selected='selected'>$name_team_sys</option>";
            }
            else
                echo "<option value= '$id_team_sys' >$name_team_sys</option>";
        }
        echo '</select>';
    }
    ?>
</div>
</div>

<!-- customer address control -->
<div class="row col col-md-12">
    <div class="col col-md-12 form-group">
        <label class="font-weight-bold" for="phone_number">Số điện thoại :</label>
        <input type="number" class="form-control" placeholder="Số điện thoại" id="sdt" onblur="validateContactNumber(this.value, 'sdt_err');">
        <code class="text-danger small font-weight-bold float-right" id="sdt_err" style="display: none;"></code>
    </div>
</div>

<!-- customes's doctor name -->
<div class="row col col-md-12">
    <div class="col col-md-12 form-group">
        <label class="font-weight-bold" for="email">Email :</label>
        <input type="text" class="form-control" placeholder="Email" id="gmail" onkeyup="validateAddress(this.value, 'gmail_err');">
        <code class="text-danger small font-weight-bold float-right" id="gmail_err" style="display: none;"></code>
    </div>
</div>

<!-- customes's doctor name -->
<div class="row col col-md-12">

    <div class="col col-md-12 form-group">
        <label class="font-weight-bold" for="room">Phòng ban :</label>
        <textarea class="form-control" placeholder="Phòng ban" id="room" onblur="validateName(this.value, 'room_err');"></textarea>
        <code class="text-danger small font-weight-bold float-right" id="room_err" style="display: none;"></code>
    </div>
</div>
<!-- customer details content end -->
<div class="row col col-md-12">
    <div class="col col-md-12 form-group">
        <label class="font-weight-bold" for="position">Chức vụ :</label>
        <textarea class="form-control" placeholder="Chức vụ" id="position_manager" onblur="validateName(this.value, 'position_manager_err');"></textarea>
        <code class="text-danger small font-weight-bold float-right" id="position_manager_err" style="display: none;"></code>
    </div>
</div>
<div class="row col col-md-12">
    <div class="col col-md-12 form-group">
        <label class="font-weight-bold" for="position">Người tạo :</label>
        <input type="text" class="form-control" placeholder="Người tạo" id="create_by" onblur="validateName(this.value, 'create_by_err');">
        <code class="text-danger small font-weight-bold float-right" id="create_by_err" style="display: none;"></code>
    </div>
</div>
<!-- horizontal line -->
<div class="col col-md-12">
    <hr class="col-md-12 float-left" style="padding: 0px; width: 95%; border-top: 2px solid  #02b6ff;">
</div>

<!-- form submit button -->
<div class="row col col-md-12">
    &emsp;
    <div class="form-group m-auto">
        <button class="btn btn-primary" onclick="addManager();">Thêm mới người sử dụng</button>
    </div>
    <!--
  &emsp;
  <div class="form-group">
    <button class="btn btn-success form-control">Save and Add Another</button>
  </div>
  -->
</div>
<!-- result message -->
<div id="customer_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"></div>
        </div>
      </div>
      <hr style="border-top: 2px solid #ff5252;">
    </div>
  </div>
</body>

</html>