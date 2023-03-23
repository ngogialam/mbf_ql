<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Chi tiết hệ thống</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/manage_supplier.js"></script>
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
            createHeader('address-book', 'Chi tiết hệ thống ', 'Chi tiết ');
            ?>
            <!-- header section end -->

            <!-- form content -->
            <div class="row">

                <div class="col col-md-12">
                    <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
                </div>



                <!-- Modal xem chi tiết hệ thống -->
                <?php
                $id_team_sys = $_GET['id_team_sys'];
                require "php/db_connection.php";
                if ($con) {
                    $query = "SELECT * FROM team_sys_manager WHERE id_team_sys = $id_team_sys";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        $id_team_sys = $row['id_team_sys'];
                        $name_team_sys = $row['name_team_sys'];
                        $type_sys = $row['type_sys'];
                        $describe_sys = $row['describe_sys'];
                        $create_by = $row['create_by'];
                        $created_at = $row['created_at'];
                    }
                }

                ?>
                <div class="row">
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="id_team_sys">Id hệ thống :</label>
                            <a class="font-weight-bold">
                                <?php echo $id_team_sys; ?>
                            </a>
                            <code class="text-danger small font-weight-bold float-right mb-2" id="username_error"
                                style="display: none;"></code>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Tên nhóm hệ thống:</label>
                            <a class="font-weight-bold">
                                <?php echo $name_team_sys; ?>
                            </a>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Loại :</label>
                            <a class="font-weight-bold">
                                <?php echo $type_sys; ?>
                            </a>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Mô tả :</label>
                            <a class="font-weight-bold">
                                <?php echo $describe_sys; ?>
                            </a>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Người tạo :</label>
                            <a class="font-weight-bold">
                                <?php echo $create_by; ?>
                            </a>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Ngày tạo :</label>
                            <a class="font-weight-bold">
                                <?php echo $created_at; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
            <button class="btn btn-info btn-sm" onclick="goBack()">Quay lại</button>
        </div>
            </div>
        </div>
    </div>
    </div>
    <!-- form content end -->
    <hr style="border-top: 2px solid #ff5252;">
    </div>
    </div>
</body>

</html>