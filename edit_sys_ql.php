<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title> Chỉnh sửa hệ thống </title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
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
            if(isset($_GET["mess"]) && $_GET['mess']){
                $mess = $_GET['mess'];
                echo "<div class='col-md-12 h5 text-success font-weight-bold text-center' style='font-family: sans-serif;'>$mess</div>";
            }
            $id_sys = $_GET['id_sys'];
            require "php/db_connection.php";
            if ($con) {
                $query = "SELECT * FROM sys_ql WHERE id_sys = $id_sys";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_array($result);
                $id_sys = $row['id_sys'];
                $type_sys = $row['type_sys'];
                $id_unit_sys_sys = $row['unit_sys_id'];
                $id_user_manager_sys = $row['user_manager_id'];
                $id_team_sys_sys = $row['team_sys_id'];

                $name_sys = $row['name_sys'];
                $first_number = $row['first_number'];
                $describe_sys = $row['describe_sys'];
                $created_at = $row['created_at'];
                $create_by = $row['create_by'];
                $list_unit_user = $row['list_unit_user'];
                $list_block_infor = $row['list_block_infor'];
            }
            
            ?>
            <input type="hidden" id="list_unit_user_tmp" name="list_unit_user_tmp" value='<?php echo $list_unit_user; ?>'/>
            <input type="hidden" id="list_block_infor_tmp" name="list_block_infor_tmp" value='<?php echo $list_block_infor; ?>'/>
            <script >
                function createCookieEdit(){

                    $(document).ready(function () {
                        createCookie("list_unit_user_edit", document.getElementById("list_unit_user_tmp").value, "0.1");
                    });

                    $(document).ready(function () {
                        createCookie("list_block_infor_edit", document.getElementById("list_block_infor_tmp").value, "0.1");
                    });
                }
                window.onload = createCookieEdit;
                window.onload = createCookieEdit;
            </script>
            <div class="row">
                <div class="row col col-md-12">
                    <input id="id_sys" type="hidden" class="form-control" placeholder="tên hệ thống" value='<?php echo $id_sys; ?>'>
                    <div id="admin_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center"
                        style="font-family: sans-serif;">
                            <?php
                               if(isset($_GET['mess'])){
                                   echo $_GET['mess'];
                               }
                            ?>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_sys">Tên hệ thống :</label>
                            <input id="name_sys" type="text" class="form-control" placeholder="tên hệ thống" value='<?php echo $name_sys; ?>'>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                    <div class="col col-md-12 form-group">
                        <label for="name_sys">Loại hệ thống :</label>
                        <select name="type_sys" id="type_sys" class=" form-control pdm chosen-select col col-md-12" >
                            <option value= '1' selected='<?php echo  ($type_sys == '1'? 'selected': '');?>'>Đầu tư</option>
                            <option value= '0' selected='<?php echo  ($type_sys == '0'? 'selected': '');?>'>Hợp tác</option>
                        </select>
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
                                echo '<select name="team_sys_manager" id="team_sys_manager" class=" form-control pdm chosen-select col col-md-12">';
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
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="first_number">Tên đầu số :</label>
                            <input id="first_number" type="number" class="form-control"
                                placeholder="tên đầu số"  value='<?php echo $first_number; ?>'
                            >
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Đơn vị quản lý :</label>
                            <input type="hidden" id="list_unit_user" name="list_unit_user"/>
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
                    <div class="row col col-md-12" id="" >
                        <div class="col col-md-12 form-group">
                            <hr style="border: 1px solid green;">
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-6 form-group">
                            <div class="col col-md-12 table-responsive" id="unit_div">
                                <div class="table-responsive">
                                    <input type="hidden" id="list_unit_user_edit" name="list_unit_user_edit"                                    
                                    value='<?php 
                                        if(isset($_COOKIE["list_unit_user_edit"]))
                                            echo $_COOKIE["list_unit_user_edit"];
                                        else
                                            echo ""; ?>'
                                            />
                                    <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                        <th>Đơn vị sử dụng</th>
                                        <th >Hành động</th> 
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php 
                                            if(isset($_COOKIE["list_unit_user_edit"]))
                                            $list_unit_user = explode('/',$_COOKIE["list_unit_user_edit"], -1);
                                        else
                                            $list_unit_user = array();
                                            
                                            if($list_unit_user){     
                                                foreach (array_values($list_unit_user) as $idx => $val) {
                                                    $query = "SELECT * FROM unit_user WHERE id_unit_user = $val";
                                                    $result = mysqli_query($con, $query);
                                                    if($row = mysqli_fetch_assoc($result)){
                                                        $name = $row['name_unit_user'];
                                                        echo "<tr><td>$name</td>";
                                                        ?>
                                                        <td>
                                                            <button href='' class='btn btn-danger btn-sm' onclick='deleteUnitInSYS(<?php echo $idx; ?>, "list_unit_user_edit")'><i class='fa fa-trash'></i></button>
                                                        </td></tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-6 ">
                            <div class="col col-md-12 form-group">
                                <div class="row col col-md-12"  >
                                    <div class="row col col-md-12"  >
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
                                </div >
                                <div class="row col col-md-12" id="" >
                                    <div class="col col-md-12 form-group">
                                      <br/>
                                    </div>
                                </div>
                                <div class="row col col-md-12 m-auto"  >
                                        <div id="ubutton" class="col col-md-5 form-group float-right">
                                        <button class="btn btn-success form-control font-weight-bold"
                                        onclick="addUnitInSYS('list_unit_user_edit')">Thêm</button>
                                        </div>
                                        <div id="ubutton" class="col col-md-5 form-group float-right">
                                        <button class="btn btn-success form-control font-weight-bold"
                                        onclick="deleteCookie('list_unit_user_edit', 'unit_div')">Xoá toàn bộ</button>   
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col col-md-12" id="" >
                        <div class="col col-md-12 form-group">
                            <hr style="border: 1px solid green;">
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
                            <input id="describe_sys" type="text" class="form-control" placeholder="mô tả hệ thống" value='<?php echo $describe_sys; ?>'
                                 >
                        </div>
                    </div>
                    <div class="row col col-md-12" id="" >
                        <div class="col col-md-12 form-group">
                            <hr style="border: 1px solid green;">
                        </div>
                    </div>
                    <div class="row col col-md-12" id="block_info_div">
                        <div class="row col col-md-6">
                            <div class="col col-md-12 table-responsive">
                                <div class="table-responsive">
                                    <input type="hidden" id="list_block_infor_edit" name="list_block_infor"                                    
                                        value='<?php 
                                            if(isset($_COOKIE["list_block_infor_edit"]))
                                                echo $_COOKIE["list_block_infor_edit"];
                                            else
                                                echo ""; ?>'
                                            />
                                    <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                        <th>STT</th>
                                        <th>Server hệ thống</th>
                                        <th>IP hệ thống</th>
                                        <th>Cấu hình hệ thống</th>
                                        <th>File mô tả</th>
                                        <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody id="sys_div">
                                        <?php 
                                            if(isset($_COOKIE["list_block_infor_edit"]))
                                                $list_block_infor = explode('/',$_COOKIE["list_block_infor_edit"], -1);
                                            else
                                                $list_block_infor = array();
                                                
                                            if($list_block_infor){    
                                                foreach (array_values($list_block_infor) as $idx => $val) {
                                                    $list_block_infor_detail = explode('|',$val, -1);
                                                    echo "<tr>";
                                                    echo "<td>$idx</td>";
                                                    foreach($list_block_infor_detail as $detail){
                                                        echo "<td>$detail</td>";
                                                    }
                                                    ?>
                                                    <td> 
                                                        <button id="updateBlockInforButton<?php echo $idx; ?>" href='' style="display: none" class="btn btn-success btn-sm" onclick="updateBlockinfor('list_block_infor_edit', <?php echo $idx;?>)"><i class="fa fa-check"></i></button>
                                                        <button id="editBlockInforButton<?php echo $idx; ?>" href='' class='btn btn-info btn-sm' onclick='editUnitInSys("list_block_infor_edit", <?php echo $idx; ?>)'><i class='fa fa-pencil'></i></button>
                                                        <button href='' class='btn btn-danger btn-sm' onclick='deleteBlockInfor(<?php echo $idx; ?>, "list_block_infor_edit")'><i class='fa fa-trash'></i></button></td></tr>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row col col-md-6" id="form_block">
                        <div class="row col col-md-12">
                            <div class="row col col-md-12" id="file_des_div" >
                                <div class="col col-md-12 form-group">
                                    <label for="file">File mô tả :</label>
                                    <input id="file_des" type="file" name="file_des" onblur="checkInputFile(this.value, 'file_des_error');"/>
                                    <code class="text-danger small font-weight-bold float-right" id="file_des_error" style="display: none;"></code>
                                </div>
                            </div>
                            <div class="row col col-md-12">
                                <div class="col col-md-12 form-group">
                                    <label for="name_team_sys">Server hệ thống :</label>
                                    <input id="server_sys" type="text" class="form-control" 
                                        placeholder="server hệ thống"
                                        >
                                </div>
                            </div>

                            <div class="row col col-md-12">
                                <div class="col col-md-12 form-group">
                                    <label for="name_team_sys">Ip hệ thống :</label>
                                    <input id="ip_sys" type="number" class="form-control"
                                        placeholder="ip hệ thống" >
                                </div>
                            </div>
                            <div class="row col col-md-12">
                                <div class="col col-md-12 form-group">
                                    <label for="name_team_sys">Cấu hình hệ thống :</label>
                                    <input id="config_sys" type="text" class="form-control" 
                                        placeholder="cấu hình hệ thống"
                                        >
                                </div>
                            </div>
                            <div class="row col col-md-12 m-auto"  >

                                <div  class="col col-md-4 form-group float-right" >
                                <button id="abutton" class="btn btn-success form-control font-weight-bold" style="display: block"
                                        onclick="addBlockInfor('list_block_infor_edit')" >Thêm</button>
                                </div>
                                <div  class="col col-md-4 form-group float-right">
                                <button id="dbutton" class="btn btn-success form-control font-weight-bold" style="display: block"
                                        onclick="deleteCookie('list_block_infor_edit', 'block_info_div')">Xoá toàn bộ</button>   
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="row col col-md-12" id="" >
                        <div class="col col-md-12 form-group">
                            <hr style="border: 1px solid green;">
                        </div>
                    </div>                    
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="create_by">Người tạo:</label>
                            <input id="create_by" type="number" class="form-control" value='<?php echo $create_by; ?>'
                                placeholder="Người tạo">
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
                                onclick="update();">Chỉnh sửa</button>

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