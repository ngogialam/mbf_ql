<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title> Chỉnh sửa hệ thống </title>
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
    <script src="js/manage_invoice.js"></script>
</head>

<body>
    <!-- including side navigations -->
    <?php include("sections/sidenav.html"); ?>
    <div class="container-fluid">
        <div class="container" id="sys_div">
            <!-- header section -->
            <?php
            require "php/header.php";
            createHeader('user', 'Chỉnh sửa thông tin hệ thống', 'Thay đổi thông tin');
            // header section end
            // if(isset($_GET["mess"]) && $_GET['mess']){
            //     $mess = $_GET['mess'];
            //     echo "<div class='col-md-12 h5 text-success font-weight-bold text-center' style='font-family: sans-serif;'>$mess</div>";
            // }
            $id_sys = $_GET['id_sys'];
            require "php/db_connection.php";
            if ($con) {
                $query = "SELECT * FROM sys_ql WHERE id_sys = $id_sys";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_array($result);
                $id_sys = $row['id_sys'];
                $id_unit_user_sys = $row['unit_user_id'];
                $id_unit_sys_sys = $row['unit_sys_id'];
                $id_user_manager_sys = $row['user_manager_id'];
                $id_team_sys_sys = $row['team_sys_id'];

                $name_sys = $row['name_sys'];
                $first_number = $row['first_number'];
                $describe_sys = $row['describe_sys'];
                $document_sys = $row['document_sys'];
                $created_at = $row['created_at'];
                $server_sys = $row['server_sys'];
                $ip_sys = $row['ip_sys'];
                $config_sys = $row['config_sys'];
                $create_by = $row['create_by'];
                $file_des = $row['file_des'];
            }


            ?>
            <div class="row">
                <?php 
                    if(isset($_GET["mess"]) && $_GET['mess']){
                        $mess = $_GET['mess'];
                        echo "<div class='col-md-12 h5 text-success font-weight-bold text-center' style='font-family: sans-serif;'>$mess</div>";
                    }
                ?>
                <div class="row col col-md-12">

                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="id_sys">Id hệ thống :</label>
                            <input id="id_sys" type="text" class="form-control" value="<?php echo $id_sys; ?>"
                                placeholder="id_sys" disabled>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_sys">Tên hệ thống :</label>
                            <input id="name_sys" type="text" class="form-control" value="<?php echo $name_sys; ?>"
                                placeholder="id_sys" >
                        </div>
                    </div>
                    <div class="row col col-md-12" style="flex-direction: row-reverse;">

                        <div class="col col-md-6 form-group">
                            <label for="name_team_sys">Tên nhóm hệ thống mới :</label>
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
                        <div class="col col-md-6 form-group">
                            <label for="name_team_sys">Tên nhóm hệ thống :</label>
                            <input id="name_team_sys" type="text" class="form-control"
                                value="<?php echo $team_sys; ?>" placeholder="name_team_sys"
                                 disabled>

                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="first_number">Tên đầu số :</label>
                            <input id="first_number" type="number" class="form-control"
                                placeholder="first_number" value="<?php echo $first_number; ?>"
                            >
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Đơn vị quản lý :</label>
                            <?php
                            require "php/db_connection.php";
                            if ($con) {
                                $query = "SELECT * FROM unit_sys";
                                $result = mysqli_query($con, $query);
                                echo '<select name="unit_sys" id="unit_sys" class=" form-control pdm chosen-select col col-md-12" >';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id_unit_sys = $row['id_unit_sys'];
                                    $name_unit_sys = $row['name_unit_sys'];
                                    
                                    if ($id_unit_sys == $id_unit_sys_sys){
                                        echo "<option value= '$id_unit_sys' selected='selected'>$name_unit_sys</option>";
                                    }
                                    else
                                        echo "<option value='$id_unit_sys'>$name_unit_sys</option>";
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Đơn vị sử dụng :</label>
                            <?php
                            require "php/db_connection.php";
                            if ($con) {
                                $query = "SELECT * FROM unit_user";
                                $result = mysqli_query($con, $query);
                                echo '<select name="unit_user" id="unit_user" class=" form-control pdm chosen-select col col-md-12" >';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id_unit_user = $row['id_unit_user'];
                                    $name_unit_user = $row['name_unit_user'];
                                    
                                    if ($id_unit_user == $id_unit_user_sys){
                                        echo "<option value= '$id_unit_user' selected='selected'>$name_unit_user</option>";
                                    }
                                    else
                                        echo "<option value='$id_unit_user'>$name_unit_user</option>";
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                    <div class="col col-md-12 form-group">
                            <label for="manager_user">Người quản lý :</label>
                            <?php
                            require "php/db_connection.php";
                            if ($con) {
                                $query = "SELECT * FROM manager_user";
                                $result = mysqli_query($con, $query);
                                echo '<select name="manager_user" id="manager_user" class=" form-control pdm chosen-select col col-md-12" >';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id_user = $row['id_user'];
                                    $name_user_manager = $row['name_user_manager'];
                                    
                                    if ($id_user == $id_user_manager_sys){
                                        echo "<option value= '$id_user' selected='selected'>$name_user_manager</option>";
                                    }
                                    else
                                        echo "<option value='$id_user'>$name_user_manager</option>";
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Mô tả hệ thống :</label>
                            <input id="describe_sys" type="text" class="form-control"
                                value="<?php echo $describe_sys; ?>" placeholder="describe_sys"
                                 >
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Tài liệu hệ thống :</label>
                            <input type="text" id="document_sys" class="form-control" value="<?php echo $document_sys; ?>"
                                placeholder="document_sys"
                                >
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Server hệ thống :</label>
                            <input id="server_sys" type="text" class="form-control" value="<?php echo $server_sys; ?>"
                                placeholder="server_sys"
                                >
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="create_by">Người tạo:</label>
                            <input id="create_by" type="number" class="form-control" value="<?php echo $create_by; ?>"
                                placeholder="create_by">
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Ip hệ thống :</label>
                            <input id="ip_sys" type="number" class="form-control" value="<?php echo $ip_sys; ?>"
                                placeholder="ip_sys" >
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Cấu hình hệ thống :</label>
                            <input id="config_sys" type="text" class="form-control" value="<?php echo $config_sys; ?>"
                                placeholder="config_sys"
                                >
                        </div>
                    </div>

                    <div class="row col col-md-12" >
                        <div class="col col-md-12 form-group">
                            <label for="file">File mô tả :</label>
                            <tr>
                                <td><a href="php/read.php?filename=<?php echo $target_dir . $file_des; ?>" formtarget="_blank" id="file_des_sv">
                                <input id="file_des_sv" type="text" class="form-control"
                                value="<?php echo $file_des; ?>" disabled></a></td>
                            </tr>
                        </div>
                    </div>
                    <div class="row col col-md-12" id="file_des_div">
                        <div class="col col-md-12 form-group">
                            <label for="file_des">File mô tả mới:</label>
                            <input  id="file_des" type="file" name="file_des" />
                        </div>
                    </div>


                    <!-- horizontal line -->
                    <div class="col col-md-12">
                        <hr class="col-md-12 float-left"
                            style="padding: 0px; width: 95%; border-top: 2px solid  #02b6ff;">
                    </div>

                    <div class="row col col-md-12 m-auto"  >
                        <div class="col col-md-2 form-group float-right"></div>
                        <div id="update_button" class="col col-md-3 form-group float-right">
                            <button class="btn btn-success form-control font-weight-bold"
                                onclick="update();">Lưu thay đổi</button>
                        </div>
                    </div>
                    <!-- result message -->
                    <div id="admin_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center"
                        style="font-family: sans-serif;"></div>
                </div>
            </div>
            <hr style="border-top: 2px solid #ff5252;">
        </div>
    </div>
</body>

</html>