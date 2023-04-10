<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Trang nhập file</title>
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
            createHeader('handshake', 'Các trang Import', 'Nhập file excel');
            // header section end
            ?>
          <div class="row">
                <div class="col-md-12">
                    <h6>Nhập danh sách hệ thống: </h6>
                </div>
                <div class="col-md-4">
                    <a href="uploads/Danh_sach_he_thong.xlsx" class="btn btn-primary"> Tải mẫu file về</a>
                </div>
                </hr>
                <div class="col-md-8">
                    <?php
                    require "php/db_connection.php";
                    require "php/PHPExcel.php";
                    if (isset($_POST['import_sys'])) {
                        $file = $_FILES['file']['tmp_name'];
                        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
                        $objReader->setLoadSheetsOnly('He_thong');
                        $objExcel = $objReader->load($file);
                        $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);
                        // print_r($sheetData);
                        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
                        // echo $highestRow;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $name_team_sys = $sheetData[$row]['A'];
                            $type_sys = $sheetData[$row]['B'];
                            $describe_sys = $sheetData[$row]['C'];
                            $create_by = $sheetData[$row]['D'];

                            $query = "INSERT INTO team_sys_manager(name_team_sys,type_sys,describe_sys,create_by) VALUES ('$name_team_sys','$type_sys','$describe_sys','$create_by')";
                            $result = mysqli_query($con, $query);
                        }
                        if (!empty($result))
                            echo "Nhập dữ liệu danh sách hệ thống thành công";
                        else
                            echo "Không thành công, xem lại định dạng file!";
                    }

                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="file" id="file"><br><br>
                        <input type="submit" value="Submit" name="import_sys">
                    </form>
                </div>
            </div>
            <hr style="border-top: 2px solid #ff5252;">

            <!-- ///////////////////////////////////////////////////////////------------------------------------------------------------------- -->
            <div class="row">
                <div class="col-md-12">
                    <h6>Nhập danh sách nhóm hệ thống: </h6>
                </div>
                <div class="col-md-4">
                    <a href="uploads/Nhom_he_thong.xlsx" class="btn btn-primary"> Tải mẫu file về</a>
                </div>
                </hr>
                <div class="col-md-8">
                    <?php
                    require "php/db_connection.php";                    
                    if (isset($_POST['import_team_sys'])) {
                        $file = $_FILES['file']['tmp_name'];
                        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
                        $objReader->setLoadSheetsOnly('Nhom_he_thong');
                        $objExcel = $objReader->load($file);
                        $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);
                        // print_r($sheetData);
                        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
                        // echo $highestRow;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $name_team_sys = $sheetData[$row]['A'];
                            $type_sys = $sheetData[$row]['B'];
                            $describe_sys = $sheetData[$row]['C'];
                            $create_by = $sheetData[$row]['D'];

                            $query = "INSERT INTO team_sys_manager(name_team_sys,type_sys,describe_sys,create_by) VALUES ('$name_team_sys','$type_sys','$describe_sys','$create_by')";
                            $result = mysqli_query($con, $query);
                        }
                        if (!empty($result))
                            echo "Nhập dữ liệu danh sách nhóm hệ thống thành công";
                        else
                            echo "Không thành công!";
                    }

                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="file" id="file"><br><br>
                        <input type="submit" value="Submit" name="import_team_sys">
                    </form>
                </div>
            </div>
            <hr style="border-top: 2px solid #ff5252;">
            <div class="row">
                <div class="col-md-12">
                    <h6>Nhập trang danh sách người quản trị : </h6>
                </div>
                <div class="col-md-4">
                    <a href="uploads/Danh_sach_quan_tri.xlsx" class="btn btn-primary"> Tải mẫu file về</a>
                </div>
                </hr>
                <div class="col-md-8">
                    <?php
                    require "php/db_connection.php";                   

                    if (isset($_POST['submit'])) {
                        $file = $_FILES['file']['tmp_name'];
                        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
                        $objReader->setLoadSheetsOnly('Danh_sach_quan_tri');
                        $objExcel = $objReader->load($file);
                        $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);
                        // print_r($sheetData);
                        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
                        // echo $highestRow;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $name_user_manager = $sheetData[$row]['A'];
                            $sdt = $sheetData[$row]['B'];
                            $gmail = $sheetData[$row]['C'];
                            $room = $sheetData[$row]['D'];
                            $position_manager = $sheetData[$row]['E'];
                            $create_by = $sheetData[$row]['F'];
                            $query = "INSERT INTO user_manager(name_user_manager,sdt,gmail,room,position_manager,create_by) VALUES ('$name_user_manager',$sdt,'$gmail','$room','$position_manager','$create_by')";
                            $result = mysqli_query($con, $query);
                        }
                        if (!empty($result))
                            echo "Nhập dữ liệu thành công";
                        else
                            echo "Không thành công!";
                    }


                    // }
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="file" id="file"><br><br>
                        <input type="submit" value="Submit" name="submit">
                    </form>
                </div>

            </div>
            <hr style="border-top: 2px solid #ff5252;">
            <div class="row">
                <div class="col-md-12">
                    <h6>Nhập trang danh sách người sử dụng : </h6>
                </div>
                <div class="col-md-4">
                    <a href="uploads/Danh_sach_nguoi_dung.xlsx" class="btn btn-primary"> Tải mẫu file về</a>
                </div>
                </hr>
                <div class="col-md-8">
                    <?php
                    require "php/db_connection.php";
                    if (isset($_POST['import_user'])) {
                        $file = $_FILES['file']['tmp_name'];
                        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
                        $objReader->setLoadSheetsOnly('Danh_sach_nguoi_dung');
                        $objExcel = $objReader->load($file);
                        $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);
                        // print_r($sheetData);
                        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
                        // echo $highestRow;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $id_team_user = 1;
                            $name_user_manager = $sheetData[$row]['A'];
                            $sdt = $sheetData[$row]['B'];
                            $gmail = $sheetData[$row]['C'];
                            $room = $sheetData[$row]['D'];
                            $positon_manager = $sheetData[$row]['E'];
                            $create_by = $sheetData[$row]['F'];
                            $query = "INSERT INTO manager_user(id_team_user,name_user_manager,sdt,gmail,room,positon_manager,create_by) VALUES ('$id_team_user','$name_user_manager',$sdt,'$gmail','$room','$positon_manager','$create_by')";
                            $result = mysqli_query($con, $query);
                        }
                        if (!empty($result))
                            echo "Nhập dữ liệu thành công";
                        else
                            echo "Không thành công!";
                    }


                    // }
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="file" id="file"><br><br>
                        <input type="submit" value="Submit" name="import_user">
                    </form>
                </div>

            </div>
            <hr style="border-top: 2px solid #ff5252;">
            <div class="row">
                <div class="col-md-12">
                    <h6>Nhập trang danh sách nhóm người sử dụng : </h6>
                </div>
                <div class="col-md-4">
                    <a href="uploads/Danh_sach_nhom_ng_dung.xlsx" class="btn btn-primary"> Tải mẫu file về</a>
                </div>
                </hr>
                <div class="col-md-8">
                    <?php
                    require "php/db_connection.php";
                    if (isset($_POST['import_file'])) {
                        $file = $_FILES['file']['tmp_name'];
                        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
                        $objReader->setLoadSheetsOnly('Danh_sach_nhom_ng_dung');
                        $objExcel = $objReader->load($file);
                        $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);
                        // print_r($sheetData);
                        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
                        // echo $highestRow;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $name_team_user = $sheetData[$row]['A'];
                            $user_status = $sheetData[$row]['B'];
                            $create_by = $sheetData[$row]['C'];

                            $query = "INSERT INTO manager_team_user(name_team_user,user_status,create_by) VALUES ('$name_team_user ','$user_status','$create_by')";
                            $result = mysqli_query($con, $query);
                        }
                        if (!empty($result))
                            echo "Nhập dữ liệu nhóm người dùng thành công";
                        else
                            echo "Không thành công!";
                    }


                    // }
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="file" id="file"><br><br>
                        <input type="submit" value="Submit" name="import_file">
                    </form>
                </div>

            </div>
            <hr style="border-top: 2px solid #ff5252;">
            <div class="row">
                <div class="col-md-12">
                    <h6>Nhập trang đơn vị quản lý : </h6>
                </div>
                <div class="col-md-4">
                    <a href="uploads/Danh_sach_don_vị_quan_ly.xlsx" class="btn btn-primary"> Tải mẫu file về</a>
                </div>
                </hr>
                <div class="col-md-8">
                    <?php
                    require "php/db_connection.php";
                    if (isset($_POST['import'])) {
                        $file_unit = $_FILES['file_unit']['tmp_name'];
                        $objReader = PHPExcel_IOFactory::createReaderForFile($file_unit);
                        $objReader->setLoadSheetsOnly('Danh_sach_don_vị_quan_ly');
                        $objExcel = $objReader->load($file_unit);
                        $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);
                        // print_r($sheetData);
                        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
                        // echo $highestRow;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $name_unit_sys = $sheetData[$row]['A'];
                            $name_room = $sheetData[$row]['B'];
                            $create_by = $sheetData[$row]['C'];

                            $query = "INSERT INTO unit_sys(name_unit_sys,name_room,create_by) VALUES ('$name_unit_sys ','$name_room','$create_by')";
                            $result = mysqli_query($con, $query);
                        }
                        if (!empty($result))
                            echo "Nhập dữ liệu đơn vị quản lý thành công";
                        else
                            echo "Không thành công rồi !";
                    }


                    // }
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="file_unit" id="file_unit"><br><br>
                        <input type="submit" value="Submit" name="import">
                    </form>
                </div>

            </div>
            <hr style="border-top: 2px solid #ff5252;">
            <div class="row">
                <div class="col-md-12">
                    <h6>Nhập trang danh đơn vị sử dụng : </h6>
                </div>
                <div class="col-md-4">
                    <a href="uploads/Danh_sach_don_vị_su_dung.xlsx" class="btn btn-primary"> Tải mẫu file về</a>
                </div>
                </hr>
                <div class="col-md-8">
                    <?php
                    require "php/db_connection.php";
                    if (isset($_POST['import_unit_user'])) {
                        $file = $_FILES['file']['tmp_name'];
                        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
                        $objReader->setLoadSheetsOnly('Danh_sach_don_vị_su_dung');
                        $objExcel = $objReader->load($file);
                        $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);
                        // print_r($sheetData);
                        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
                        // echo $highestRow;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $name_unit_user = $sheetData[$row]['A'];
                            $name_room_unit = $sheetData[$row]['B'];
                            $create_by = $sheetData[$row]['C'];

                            $query = "INSERT INTO unit_user(name_unit_user,name_room_unit,create_by) VALUES ('$name_unit_user','$name_room_unit','$create_by')";
                            $result = mysqli_query($con, $query);
                        }
                        if (!empty($result))
                            echo "Nhập dữ liệu danh sách đơn vị sử dụng thành công";
                        else
                            echo "Không thành công!";
                    }

                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="file" id="file"><br><br>
                        <input type="submit" value="Submit" name="import_unit_user">
                    </form>
                </div>
            </div>
        </div>
</body>

</html>