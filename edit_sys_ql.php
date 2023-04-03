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
        <div class="container">
            <!-- header section -->
            <?php
            require "php/header.php";
            createHeader('user', 'Chỉnh sửa thông tin hệ thống', 'Thay đổi thông tin');
            // header section end
            $id_sys = $_GET['id_sys'];
            require "php/db_connection.php";
            if ($con) {
                $query = "SELECT * FROM sys_ql WHERE id_sys = $id_sys";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_array($result);
                $id_sys = $row['id_sys'];
                $name_team_sys = $row['name_team_sys'];
                $name_sys = $row['name_sys'];
                $first_number = $row['first_number'];
                $name_unit_manager = $row['name_unit_manager'];
                $name_user_manager = $row['name_user_manager'];
                $describe_sys = $row['describe_sys'];
                $document_sys = $row['document_sys'];
                $created_at = $row['created_at'];
                $server_sys = $row['server_sys'];
                $ip_sys = $row['ip_sys'];
                $config_sys = $row['config_sys'];
            }
            ?>
            <div class="row">
                <div class="row col col-md-12">

                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="id_sys">Id hệ thống :</label>
                            <input id="id_sys" type="text" class="form-control" value="<?php echo $id_sys; ?>"
                                placeholder="id_sys" onkeyup="validateName(this.value, 'id_error');" disabled>
                            <code class="text-danger small font-weight-bold float-right mb-2" id="id_error"
                                style="display: none;"></code>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Tên nhóm hệ thống :</label>
                            <input id="name_team_sys" type="text" class="form-control"
                                value="<?php echo $name_team_sys; ?>" placeholder="name_team_sys"
                                onkeyup="validateName(this.value, 'name_team_sys_error');" disabled>
                            <code class="text-danger small font-weight-bold float-right mb-2" id="name_team_sys_error"
                                style="display: none;"></code>
                        </div>
                    </div>
                    <div class="row col col-md-12" type="hidden" id="hidden">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Tên nhóm hệ thống :</label>
                            <?php
                            require "php/db_connection.php";
                            if ($con) {
                                $query = "SELECT * FROM unit_user ";
                                $result = mysqli_query($con, $query);
                                $row = mysqli_fetch_array($result);
                                echo '<select name="select_name" class=" form-control pdm chosen-select col col-md-12" >';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id_unit_user = $row['id_unit_user'];
                                    $name_unit_user = $row['name_unit_user'];
                                    echo "<option value='$id_unit_user'>$name_unit_user</option>";
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Tên đầu số :</label>
                            <input id="first_number" type="number" class="form-control"
                                value="<?php echo $first_number; ?>" placeholder="first_number"
                                onkeyup="validateName(this.value, 'first_number_error');" disabled>
                            <code class="text-danger small font-weight-bold float-right mb-2" id="first_number_error"
                                style="display: none;"></code>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Tên đơn vị quản lý :</label>
                            <input id="name_unit_manager" type="text" class="form-control"
                                value="<?php echo $name_unit_manager; ?>" placeholder="name_unit_manager"
                                onkeyup="validateName(this.value, 'name_unit_manager_error');" disabled>
                            <code class="text-danger small font-weight-bold float-right mb-2"
                                id="name_unit_manager_error" style="display: none;"></code>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Tên người quả trị :</label>
                            <input id="name_user_manager" type="text" class="form-control"
                                value="<?php echo $name_user_manager; ?>" placeholder="name_user_manager"
                                onkeyup="validateName(this.value, 'name_user_manager_error');" disabled>
                            <code class="text-danger small font-weight-bold float-right mb-2"
                                id="name_user_manager_error" style="display: none;"></code>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Mô tả hệ thống :</label>
                            <input id="describe_sys" type="text" class="form-control"
                                value="<?php echo $describe_sys; ?>" placeholder="describe_sys"
                                onkeyup="validateName(this.value, 'describe_sys_error');" disabled>
                            <code class="text-danger small font-weight-bold float-right mb-2" id="describe_sys_error"
                                style="display: none;"></code>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Tài liệu hệ thống :</label>
                            <input type="text" id="document_sys" class="form-control" value="<?php echo $document_sys; ?>"
                                placeholder="document_sys" onkeyup="validateName(this.value, 'document_sys_error');"
                                disabled>
                            <code class="text-danger small font-weight-bold float-right mb-2" id="document_sys_error"
                                style="display: none;"></code>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Server hệ thống :</label>
                            <input id="server_sys" type="text" class="form-control" value="<?php echo $server_sys; ?>"
                                placeholder="server_sys" onkeyup="validateName(this.value, 'server_sys_error');"
                                disabled>
                            <code class="text-danger small font-weight-bold float-right mb-2" id="server_sys_error"
                                style="display: none;"></code>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Ip hệ thống :</label>
                            <input id="ip_sys" type="number" class="form-control" value="<?php echo $ip_sys; ?>"
                                placeholder="ip_sys" onkeyup="validateName(this.value, 'username_error');" disabled>
                            <code class="text-danger small font-weight-bold float-right mb-2" id="ip_sys_error"
                                style="display: none;"></code>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Cấu hình hệ thống :</label>
                            <input id="config_sys" type="text" class="form-control" value="<?php echo $config_sys; ?>"
                                placeholder="config_sys" onkeyup="validateName(this.value, 'config_sys_error');"
                                disabled>
                            <code class="text-danger small font-weight-bold float-right mb-2" id="config_sys_error"
                                style="display: none;"></code>
                        </div>
                    </div>

                    <!-- horizontal line -->
                    <div class="col col-md-12">
                        <hr class="col-md-12 float-left"
                            style="padding: 0px; width: 95%; border-top: 2px solid  #02b6ff;">
                    </div>

                    <!-- form submit button -->
                    <div class="row col col-md-12 m-auto" id="edit">
                        <div class="col col-md-2 form-group float-right"></div>
                        <div id="edit_button" class="col col-md-3 form-group float-right">
                            <button class="btn btn-primary form-control font-weight-bold" onclick="edit();">Chỉnh
                                sửa</button>
                        </div>
                        <div id="update_button" class="col col-md-3 form-group float-right">
                            <button class="btn btn-secondary form-control font-weight-bold" onclick="goBack();">Quay lại
                            </button>
                        </div>
                    </div>

                    <div class="row col col-md-12 m-auto" id="update_cancel" style="display: none;">
                        <div class="col col-md-2 form-group float-right"></div>
                        <div id="cancel_button" class="col col-md-3 form-group float-right">
                            <button class="btn btn-warning form-control font-weight-bold" onclick="edit(true);">Hủy bỏ
                            </button>
                        </div>
                        <div id="update_button" class="col col-md-3 form-group float-right">
                            <button class="btn btn-success form-control font-weight-bold"
                                onclick="updateAdminDetails();">Lưu thay đổi</button>
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