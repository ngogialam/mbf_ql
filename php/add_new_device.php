<?php

  if (isset($_GET["action"]) && $_GET["action"] == "individual") {
    $id_room = $_GET['id_room'];
    $name_device = $_GET['name_device'];
    $code_device = $_GET['code_device'];
    $status_device = $_GET['status_device'];
    $name_owner = $_GET['name_owner'];

    create_individual_device($id_room, $name_device, $code_device, $status_device, $name_owner);

  }

  if (isset($_GET["action"]) && $_GET["action"] == "department") {
    $id_room = $_GET['id_room'];
    $name_device = $_GET['name_device'];
    $code_device = $_GET['code_device'];
    $status_device = $_GET['status_device'];

    create_department_device($id_room, $name_device, $code_device, $status_device);

  }

  function create_individual_device($id_room, $name_device, $code_device, $status_device, $name_owner){
    require "db_connection.php";
    if ($con) {
        $query = "SELECT * FROM device WHERE code_device = '$code_device'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        if($row){
            $mess = "Thiết bị $name_device, mã serial $code_device đã tồn tại!";
            show_form_new_device($mess);
        }
        else {
            $query = "INSERT INTO device (id_room, name_device, code_device, status_device, name_owner) VALUES('$id_room', '$name_device', '$code_device', '$status_device', '$name_owner')";
            $result = mysqli_query($con, $query);
            if(!empty($result)){
                $mess = "Thiết bị $name_device với mã serial $code_device đã thêm thành công";
                show_form_new_device($mess);
            }

            else{
                $mess = "Không thể thêm thiết bị $name_device, mã serial $code_device vào hệ thống!";
                show_form_new_device($mess);
            }

            }
        }

}

    function show_form_new_device($mess){

        ?>
        <div class="container">
            <div class="row" id='decive_div'>
            <div class="row col col-md-6">
            <div class="row col col-md-12">
                <div class="col col-md-12 form-group">
                    <label class="font-weight-bold" for="">Tên thiết bị:</label>
                    <input type="text" class="form-control" id="name_device" placeholder="Tên thiết bị">
                </div>
                </div>
                
                <div class="row col col-md-12">
                <div class="col col-md-12 form-group">
                    <label class="font-weight-bold" for="">Số serial thiết bị :</label>
                    <input type="text" class="form-control" id="code_device" placeholder="Số serial">
                </div>
                </div>
                
                <div class="row col col-md-12">
                <div class="col col-md-12 form-group">
                    <label class="font-weight-bold" for="suppliers_name">Trạng thái</label>
                    <select name="" id="status_device" class=" form-control pdm chosen-select col col-md-12" >
                    <option value= '0' selected='selected'>Không dùng</option>
                    <option value= '1' >Đang dùng</option>
                    <option value= '2' >Chuyển tiếp</option>
                    </select>
                </div>
                </div>

                <div class="row col col-md-12">
                <div class="col col-md-12 form-group">
                    <label class="font-weight-bold" for="suppliers_name">Người dùng</label>
                    <!-- <select name="type_sys" id="type_sys" class=" form-control pdm chosen-select col col-md-12" > -->
                    <input type="text" class="form-control" id="name_owner" placeholder="Người dùng">
                </div>
                </div>

                <div class="row col col-md-12">
                <div class="col col-md-12 form-group">
                    <label class="font-weight-bold" for="suppliers_name">Phòng ban</label>
                    <?php
                        require "db_connection.php";
                        if ($con) {
                            $query = "SELECT * FROM sys_room";
                            $result = mysqli_query($con, $query);
                            echo '<select name="sys_room" id="id_room" class=" form-control pdm chosen-select col col-md-12" >';
                            echo "<option value= '0' selected='selected'>Chọn 1 phòng ban...</option>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id_room = $row['id_room'];
                                $name_room = $row['name_room'];
                                echo "<option value= '$id_room'>$name_room</option>";
                            }
                            echo '</select>';
                        }
                        ?>
                    </select>
                </div>
                </div>
                <!-- new user button -->
                <div class="row col col-md-12">
                &emsp;
                <div class="form-group m-auto">
                    <button class="btn btn-primary form-control" onclick="addNewDeviceIndividual();">Thêm mới thiết bị cá nhân</button>
                </div>
                </div>
                <!-- customer details content end -->
                <!-- result message -->
                <div id="medicine_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"><?php echo $mess; ?></div>
            </div>
            </div>
            </div>
        <?php

    }



    function create_department_device($id_room, $name_device, $code_device, $status_device){
        require "db_connection.php";
        if ($con) {
            $query = "SELECT * FROM device_room WHERE code_device = '$code_device'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_array($result);
            if($row){
                $mess = "Thiết bị $name_device, mã serial $code_device đã tồn tại!";
                show_form_new_device_department($mess);
            }
            else {
                $query = "INSERT INTO device_room (id_room, name_device, code_device, status_device) VALUES('$id_room', '$name_device', '$code_device', '$status_device')";
                $result = mysqli_query($con, $query);
                if(!empty($result)){
                    $mess = "Thiết bị $name_device với mã serial $code_device đã thêm thành công";
                    show_form_new_device_department($mess);
                }
    
                else{
                    $mess = "Không thể thêm thiết bị $name_device, mã serial $code_device vào hệ thống!";
                    show_form_new_device_department($mess);
                }
    
                }
            }
    
    }

    function show_form_new_device_department($mess){

        ?>
        <div class="container">
            <div class="row" id='decive_div'>
            <div class="row col col-md-6">
            <div class="row col col-md-12">
                <div class="col col-md-12 form-group">
                    <label class="font-weight-bold" for="">Tên thiết bị:</label>
                    <input type="text" class="form-control" id="name_device" placeholder="Tên thiết bị">
                </div>
                </div>
                
                <div class="row col col-md-12">
                <div class="col col-md-12 form-group">
                    <label class="font-weight-bold" for="">Số serial thiết bị :</label>
                    <input type="text" class="form-control" id="code_device" placeholder="Số serial">
                </div>
                </div>
                
                <div class="row col col-md-12">
                <div class="col col-md-12 form-group">
                    <label class="font-weight-bold" for="suppliers_name">Trạng thái</label>
                    <select name="" id="status_device" class=" form-control pdm chosen-select col col-md-12" >
                    <option value= '0' selected='selected'>Không dùng</option>
                    <option value= '1' >Đang dùng</option>
                    <option value= '2' >Chuyển tiếp</option>
                    </select>
                </div>
                </div>

                <div class="row col col-md-12">
                <div class="col col-md-12 form-group">
                    <label class="font-weight-bold" for="suppliers_name">Phòng ban</label>
                    <?php
                        require "db_connection.php";
                        if ($con) {
                            $query = "SELECT * FROM sys_room";
                            $result = mysqli_query($con, $query);
                            echo '<select name="sys_room" id="id_room" class=" form-control pdm chosen-select col col-md-12" >';
                            echo "<option value= '0' selected='selected'>Chọn 1 phòng ban...</option>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id_room = $row['id_room'];
                                $name_room = $row['name_room'];
                                echo "<option value= '$id_room'>$name_room</option>";
                            }
                            echo '</select>';
                        }
                        ?>
                    </select>
                </div>
                </div>
                <!-- new user button -->
                <div class="row col col-md-12">
                &emsp;
                <div class="form-group m-auto">
                    <button class="btn btn-primary form-control" onclick="addNewDeviceDepartment();">Thêm mới thiết bị cho phòng</button>
                </div>
                </div>
                <!-- customer details content end -->
                <!-- result message -->
                <div id="medicine_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"><?php echo $mess; ?></div>
            </div>
            </div>
            </div>
        <?php

    }