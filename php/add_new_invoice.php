<?php

  if(isset($_GET['action']) && $_GET['action'] == "add_row")
    createMedicineInfoRow();

  if(isset($_GET['action']) && $_GET['action'] == "is_customer")
    isCustomer(strtoupper($_GET['name']), $_GET['contact_number']);

  if(isset($_GET['action']) && $_GET['action'] == "is_invoice")
    isInvoiceExist($_GET['invoice_number']);

  if(isset($_GET['action']) && $_GET['action'] == "is_medicine")
    isMedicine(strtoupper($_GET['name']));

  if(isset($_GET['action']) && $_GET['action'] == "current_invoice_number")
    getInvoiceNumber();

  if(isset($_GET['action']) && $_GET['action'] == "medicine_list")
    showMedicineList(strtoupper($_GET['text']));

  if(isset($_GET['action']) && $_GET['action'] == "fill")
    fill(strtoupper($_GET['name']), $_GET['column']);

  if(isset($_GET['action']) && $_GET['action'] == "check_quantity")
    checkAvailableQuantity(strtoupper($_GET['medicine_name']));

  if(isset($_GET['action']) && $_GET['action'] == "update_stock")
    updateStock(strtoupper($_GET['name']), $_GET['batch_id'], intval($_GET['quantity']));

  if(isset($_GET['action']) && $_GET['action'] == "add_sale")
    addSale();

  if(isset($_GET['action']) && $_GET['action'] == "add_new_invoice"){
    
    $list_unit_user = $_GET['invoice_number'];
  }

  if(isset($_GET['action']) && $_GET['action'] == "add_unit_user")
    addNewInvoice();

  function isCustomer($name, $contact_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM customers WHERE UPPER(NAME) = '$name' AND CONTACT_NUMBER = '$contact_number'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  function isInvoiceExist($invoice_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM sales WHERE INVOICE_NUMBER = $invoice_number";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  function isMedicine($name) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM medicines_stock WHERE UPPER(NAME) = '$name'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  function createMedicineInfoRow() {
    $row_id = $_GET['row_id'];
    $row_number = $_GET['row_number'];
    ?>
    <div class="row col col-md-12">
      <div class="col-md-2">
        <input id="medicine_name_<?php echo $row_number; ?>" name="medicine_name" class="form-control" list="medicine_list_<?php echo $row_number; ?>" placeholder="" onkeydown="medicineOptions(this.value, 'medicine_list_<?php echo $row_number; ?>');" onfocus="medicineOptions(this.value, 'medicine_list_<?php echo $row_number; ?>');" onchange="fillFields(this.value, '<?php echo $row_number; ?>');">
        <code class="text-danger small font-weight-bold float-right" id="medicine_name_error_<?php echo $row_number; ?>" style="display: none;"></code>
        <datalist id="medicine_list_<?php echo $row_number; ?>" style="display: none; max-height: 200px; overflow: auto;">
          <?php showMedicineList("") ?>
        </datalist>
      </div>
      <div class="col col-md-1"><input type="text" class="form-control" id="batch_id_<?php echo $row_number; ?>" ></div>
      <div class="col col-md-1"><input type="text" class="form-control" id="available_quantity_<?php echo $row_number; ?>" ></div>
      <div class="col col-md-1"><input type="text" class="form-control" id="expiry_date_<?php echo $row_number; ?>" ></div>
      <div class="col col-md-1">
        <input type="text" class="form-control" id="quantity_<?php echo $row_number; ?>" value="" onkeyup="getTotal('<?php echo $row_number; ?>');" onblur="checkAvailableQuantity(this.value, '<?php echo $row_number; ?>');">
        <code class="text-danger small font-weight-bold float-right" id="quantity_error_<?php echo $row_number; ?>" style="display: none;"></code>
      </div>
      <div class="col col-md-2"><input type="text" class="form-control" id="mrp_<?php echo $row_number; ?>" onchange="getTotal('<?php echo $row_number; ?>');" ></div>
      <div class="col col-md-1">
        <input type="text" class="form-control" id="discount_<?php echo $row_number; ?>" value="" onkeyup="getTotal('<?php echo $row_number; ?>');">
        <code class="text-danger small font-weight-bold float-right" id="discount_error_<?php echo $row_number; ?>" style="display: none;"></code>
      </div>
      <div class="col col-md-1"><input type="text" class="form-control" id="batch_id_<?php echo $row_number; ?>" ></div>
      <div class="col col-md-1"><input type="text" class="form-control" id="available_quantity_<?php echo $row_number; ?>" ></div>
      <div class="col col-md-1">
        <button class="btn btn-primary" onclick="addRow();">
          <i class="fa fa-plus"></i>
        </button>
        <button class="btn btn-danger"  onclick="removeRow('<?php echo $row_id ?>');">
          <i class="fa fa-trash"></i>
        </button>
      </div>
    </div>
    <div class="col col-md-12">
      <hr class="col-md-12" style="padding: 0px;">
    </div>
    <?php
  }

  function getInvoiceNumber() {
    require 'db_connection.php';
    if($con) {
      $query = "SELECT * FROM sys_ql";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo $row['id_sys'];
    }
  }

  function showMedicineList($text) {
    require 'db_connection.php';
    if($con) {
      if($text == "")
        $query = "SELECT * FROM sys_ql";
      else
        $query = "SELECT * FROM sys_ql WHERE UPPER(name_sys) LIKE '%$text%'";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result))
        echo '<option value="'.$row['NAME'].'">'.$row['NAME'].'</option>';
    }
  }

  function fill($name, $column) {
    require 'db_connection.php';
    if($con) {
      $query = "SELECT * FROM sys_ql WHERE UPPER(NAME) = '$name'";
      $result = mysqli_query($con, $query);
      if(mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_array($result);
        echo $row[$column];
      }
    }
  }

  function checkAvailableQuantity($name) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM sys_ql WHERE UPPER(NAME) = '$name'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? $row['QUANTITY'] : "false";
    }
  }

  function updateStock($name, $batch_id, $quantity) {
    require "db_connection.php";
    if($con) {
      $query = "UPDATE medicines_stock SET QUANTITY = QUANTITY - $quantity WHERE UPPER(NAME) = '$name' AND BATCH_ID = '$batch_id'";
      $result = mysqli_query($con, $query);
      echo ($result) ? "stock updated" : "failed to update stock";
    }
  }

  function getCustomerId($name, $contact_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT ID FROM customers WHERE UPPER(NAME) = '$name' AND CONTACT_NUMBER = '$contact_number'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      return ($row) ? $row['ID'] : 0;
    }
  }

  function addSale() {
    $customer_id = getCustomerId(strtoupper($_GET['customers_name']), $_GET['customers_contact_number']);
    $invoice_number = $_GET['invoice_number'];
    $medicine_name = $_GET['medicine_name'];
    $batch_id = $_GET['batch_id'];
    $expiry_date = $_GET['expiry_date'];
    $quantity = $_GET['quantity'];
    $mrp = $_GET['mrp'];
    $discount = $_GET['discount'];
    $total = $_GET['total'];

    require "db_connection.php";
    if($con) {
      $query = "INSERT INTO sales (CUSTOMER_ID, INVOICE_NUMBER, MEDICINE_NAME, BATCH_ID, EXPIRY_DATE, QUANTITY, MRP, DISCOUNT, TOTAL) VALUES($customer_id, $invoice_number, '$medicine_name', '$batch_id', '$expiry_date', $quantity, $mrp, $discount, $total)";
      $result = mysqli_query($con, $query);
      echo ($result) ? "inserted sale" : "falied to add sale...";
    }
  }

  function addNewInvoice() {
    $customer_id = getCustomerId(strtoupper($_GET['customers_name']), $_GET['customers_contact_number']);
    $invoice_date = $_GET['invoice_date'];
    //$payment_status = ($_GET['payment_type'] == "");
    $total_amount = $_GET['total_amount'];
    $total_discount = $_GET['total_discount'];
    $net_total = $_GET['net_total'];

    require "db_connection.php";
    if($con) {
      $query = "INSERT INTO invoices (CUSTOMER_ID, INVOICE_DATE, TOTAL_AMOUNT, TOTAL_DISCOUNT, NET_TOTAL) VALUES($customer_id, '$invoice_date', $total_amount, $total_discount, $net_total)";
      $result = mysqli_query($con, $query);
      echo ($result) ? "Invoice saved..." : "falied to add invoice...";
    }
  }



  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name_sys = $_POST["name_sys"];
    if (empty($name_sys)) {
      $mess = "Hệ thống đã tồn tại";
      createForm($mess);
      exit();
    } 
    $team_sys_id = $_POST["team_sys_manager"];
    $first_number = $_POST["first_number"];
    $unit_sys = $_POST["unit_sys"];
    $manager_user = $_POST["manager_user"];
    $type_sys = $_POST['type_sys'];
    $describe_sys = $_POST["describe_sys"];

    $list_block_infor = $_POST["list_block_infor"];
    $list_unit_user = $_POST["list_unit_user"];
    $create_by = $_POST["create_by"];
    $list_block_infor_temp = explode('/', $list_block_infor, -1);
    foreach (array_values($list_block_infor_temp) as $idx => $val) {
      $list_block_infor_detail = array_slice(explode('|',$val, -1), -1, 1);
      if($list_block_infor_detail[0] != ""){
        $old_name = "../upload_temps/" . (string)$list_block_infor_detail[0];
        $new_name = "../uploads/" . (string)$list_block_infor_detail[0] ;
        rename($old_name, $new_name);
      }
    }
    // insert 1 system
    createSys($team_sys_id, $unit_sys, $type_sys, $manager_user, $name_sys, $first_number, $describe_sys, $create_by, $list_unit_user, $list_block_infor);
  }


  function createSys($team_sys_id, $unit_sys, $type_sys, $manager_user, $name_sys, $first_number, $describe_sys, $create_by, $list_unit_user, $list_block_infor){
    require "db_connection.php";
    $list_unit_user = (string)$list_unit_user;
    $list_block_infor = (string)$list_block_infor;
    $query = "INSERT INTO sys_ql (unit_sys_id, user_manager_id, team_sys_id, name_sys, type_sys, first_number, describe_sys, create_by, list_unit_user, list_block_infor)
              VALUE ( '$unit_sys', '$manager_user', '$team_sys_id', '$name_sys', '$type_sys', '$first_number', '$describe_sys', '$create_by', '$list_unit_user', '$list_block_infor')";
    $result = mysqli_query($con, $query);
    // var_dump($result);
    if(!empty($result)){
      $mess = "Hệ thống $name_sys đã được thêm thành công";
      createForm($mess);
    } else {
      $mess = "Thêm hệ thống $name_sys thất bại";
      createForm($mess);
    }
      
  }

function createForm($mess){
  ?>
    <?php
      require "header.php";
      createHeader('user', 'Thêm mới thông tin hệ thống', 'Tạo mới thông tin');
    ?>
    <div class="row">
                <div class="row col col-md-12">
                    
                    <div id="admin_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center"
                        style="font-family: sans-serif;">
                            <?php
                               if(isset($_GET['mess'])){
                                   echo $_GET['mess'];
                               }
                               echo $mess;
                            ?>

                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_sys">Tên hệ thống :</label>
                            <input id="name_sys" type="text" class="form-control" placeholder="tên hệ thống" >
                        </div>
                    </div>
                    <div class="col col-md-12 form-group">
                        <label for="name_sys">Loại hệ thống :</label>
                        <select name="type_sys" id="type_sys" class=" form-control pdm chosen-select col col-md-12" >
                            <option value= '1' selected='selected'>Đầu tư</option>
                            <option value= '0' >Hợp tác</option>
                        </select>
                    </div>
                    <div class="row col col-md-12" style="flex-direction: row-reverse;">

                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Tên nhóm hệ thống :</label>
                            <?php
                            require "db_connection.php";
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
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="first_number">Tên đầu số :</label>
                            <input id="first_number" type="number" class="form-control"
                                placeholder="tên đầu số"
                            >
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label for="name_team_sys">Đơn vị quản lý :</label>
                            <input type="hidden" id="list_unit_user" name="list_unit_user"/>
                            <?php
                            require "db_connection.php";
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
                                    <input type="hidden" id="list_unit_user" name="list_unit_user" />
                                    <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                        <th>Đơn vị sử dụng</th>
                                        <th >Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php 
                                            if(isset($_COOKIE["list_unit_user"]))
                                                $list_unit_user = explode('/',$_COOKIE["list_unit_user"], -1);
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
                                                        <td><button href='' class='btn btn-info btn-sm' onclick='deleteUnitInSYS(<?php echo $idx; ?>)'><i class='fa fa-trash'></i></button></td></tr>
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
                                        require "db_connection.php";
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
                                        onclick="addUnitInSYS()">Thêm</button>
                                        </div>
                                        <div id="ubutton" class="col col-md-5 form-group float-right">
                                        <button class="btn btn-success form-control font-weight-bold"
                                        onclick="deleteCookie('list_unit_user', 'unit_div')">Xoá toàn bộ</button>   
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
                            require "db_connection.php";
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
                            <input id="describe_sys" type="text" class="form-control" placeholder="mô tả hệ thống"
                                 >
                        </div>
                    </div>
                    <div class="row col col-md-12" id="" >
                        <div class="col col-md-12 form-group">
                            <hr style="border: 1px solid green;">
                        </div>
                    </div>
                    <div class="row col col-md-12" id="block_info_div">
                        <input type="hidden" id="list_block_infor" name="list_block_infor" value='<?php echo $_COOKIE["list_block_infor"];?>'/>
                        <div class="row col col-md-6">
                            <div class="col col-md-12 table-responsive">
                                <div class="table-responsive">
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
                                            if(isset($_COOKIE["list_block_infor"]))
                                                $list_block_infor = explode('/',$_COOKIE["list_block_infor"], -1);
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
                                                    <td><button href='' class='btn btn-info btn-sm' onclick='deleteBlockInfor(<?php echo $idx; ?>)'><i class='fa fa-trash'></i></button></td></tr>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row col col-md-6">
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
                                <div id="ubutton" class="col col-md-5 form-group float-right">
                                <button class="btn btn-success form-control font-weight-bold"
                                        onclick="addBlockInfor()">Thêm</button>
                                </div>
                                <div id="ubutton" class="col col-md-5 form-group float-right">
                                <button class="btn btn-success form-control font-weight-bold"
                                        onclick="deleteCookie('list_block_infor', 'block_info_div')">Xoá toàn bộ</button>   
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
                            <input id="create_by" type="number" class="form-control"
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
                                onclick="create();">Tạo mới</button>

                        </div>
                    </div>
                    <!-- result message -->
                    <div id="admin_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center"
                        style="font-family: sans-serif;"></div>
                </div>
            </div>
<?php
}

?>
