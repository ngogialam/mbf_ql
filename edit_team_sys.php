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
    <script src="js/manage_supplier.js"></script>
</head>

<body>
    <!-- including side navigations -->
    <?php include("sections/sidenav.html"); ?>
    <div class="container-fluid">
        <div class="container">
            <!-- header section -->
            <?php
            require "php/header.php";
            $target_dir = "../uploads/";
            createHeader('user', 'Chỉnh sửa nhóm hệ thống', 'Thay đổi thông tin nhóm hệ thống');
            // header section end
            $id_team_sys = $_GET['id_team_sys'];
            require "php/db_connection.php";
            if ($con) {
                $query = "SELECT * FROM team_sys_manager WHERE id_team_sys = $id_team_sys";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_array($result);               
                $id_team_sys = $row['id_team_sys'];
                $name_team_sys = $row['name_team_sys'];
                $type_sys = $row['type_sys'];
                $describe_sys = $row['describe_sys'];
                $create_by = $row['create_by'];
                $created_at = $row['created_at'];
                $file_des = $row['file_des'];
            }


            ?>
            <div class="row" id='suppliers_div'>
                <div class="row col col-md-12">

                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="id_team_sys">Id nhóm hệ thống :</label>
                            <input id="id_team_sys" type="text" class="form-control" value="<?php echo $id_team_sys; ?>"
                                placeholder="id_team_sys" disabled>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Tên nhóm hệ thống :</label>
                            <input id="name_team_sys" type="text" class="form-control"
                                value="<?php echo $name_team_sys; ?>" placeholder="name_team_sys"
                                >
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="type_sys">Loại:</label>
                            <input id="type_sys" type="number" class="form-control"
                                value="<?php echo $type_sys; ?>" placeholder="type_sys"
                                >
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="describe_sys">Mô tả :</label>
                            <input id="describe_sys" type="text" class="form-control"
                                value="<?php echo $describe_sys; ?>" placeholder="describe_sys" >
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="create_by">Người tạo :</label>
                            <input id="create_by" type="text" class="form-control"
                                value="<?php echo $create_by; ?>" placeholder="create by"
                             >
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="created_at">Ngày tạo :</label>
                            <input id="created_at" type="text" class="form-control"
                                value="<?php echo $created_at; ?>" placeholder="created_at"
                                 disabled>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="file">File mô tả :</label>
                            <tr>
                                <td><?php
                                ?>
                                <td><a href="php/read.php?filename=<?php echo $target_dir . $file_des; ?>" formtarget="_blank" id="file_des_sv">
                                <input id="file_des_sv" type="text" class="form-control"
                                value="<?php echo $file_des; ?>" disabled></a></td>
                            </tr>
                        </div>
                    </div>

                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                        <label for="file_des">File mô tả mới:</label>
                        <input  id="file_des" type="file" name="file_des">
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
                            <button class="btn btn-primary form-control font-weight-bold" onclick="updateSupplier(<?php echo $id_team_sys; ?>);">Lưu thay đổi</button>
                        </div>
                        <div id="update_button" class="col col-md-3 form-group float-right">
                            <button class="btn btn-secondary form-control font-weight-bold" onclick="goBack();">Quay lại
                            </button>
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