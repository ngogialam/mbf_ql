<?php

if (isset($_GET["action"]) && $_GET["action"] == "delete") {
  require "db_connection.php";
  $id_sys = $_GET["id_sys"];

  try {
    $query1 = "DELETE FROM sys_ql WHERE id_sys = $id_sys";
    $result1 = mysqli_query($con, $query1);
    if (!empty($result1))
      showInvoices();
    else {
      echo "<td colspan='10'><div id='medicine_acknowledgement' class='col-md-12 h5 text-success font-weight-bold text-center' style='font-family: sans-serif;'>Không xoá được</div></td>";
      showInvoices();
    }
  } catch (Exception $e) {
?>
    <td colspan="10">
      <div id="medicine_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;">Không xoá được</div>
    </td>
    <?php
    showInvoices();
  }
}

if (isset($_GET["action"]) && $_GET["action"] == "refresh")
  showInvoices();


if (isset($_GET["action"]) && $_GET["action"] == "search")
  searchInvoice(strtoupper($_GET["text"]));

////////////////////////// POST edit ////////////////////////
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_sys = $_POST["id_sys"];
  $team_sys_id = $_POST["team_sys_manager"];
  $first_number = $_POST["first_number"];
  $unit_sys = $_POST["unit_sys"];
  $unit_user = $_POST["unit_user"];
  $manager_user = $_POST["manager_user"];
  $name_sys = $_POST["name_sys"];
  $describe_sys = $_POST["describe_sys"];
  $document_sys = $_POST["document_sys"];
  $describe_sys = $_POST["describe_sys"];
  $server_sys = $_POST["server_sys"];
  $ip_sys = $_POST["ip_sys"];
  $config_sys = $_POST["config_sys"];
  $create_by = $_POST["create_by"];
  $file_des = $_POST["file_des"];

  if (!empty($_FILES["file_des"])) {
    $file_des = basename($_FILES["file_des"]["name"]);

    // collect value of input field
    $check = False;

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["file_des"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
    ?>
      <div class="row col col-md-12">
        <div class="row col col-md-12">
          <div class="col col-md-12 form-group">
            <label for="id_team_sys">
              <?php
              echo "Chỉnh sửa không thành công. File đã tồn tại.";
              ?>
              <label>
          </div>
        </div>
      </div>
    <?php
      $uploadOk = 0;
    }

    // Check file file_des
    if ($_FILES["file_des"]["size"] > 5000000) {
    ?>
      <div class="row col col-md-12">
        <div class="row col col-md-12">
          <div class="col col-md-12 form-group">
            <label for="id_team_sys">
              <?php
              echo "Chỉnh sửa không thành cônng. File quá lớn";
              ?>
              <label>
          </div>
        </div>
      </div>
    <?php
      $uploadOk = 0;
    }

    // Allow certain file formats
    if (
      $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "ppt"
      && $imageFileType != "xlsx" && $imageFileType != "docx"
    ) {
    ?>
      <div class="row col col-md-12">
        <div class="row col col-md-12">
          <div class="col col-md-12 form-group">
            <label for="id_team_sys">
              <?php
              echo "Chỉnh sửa không thành công. Chỉ upload file pdf, ppt, doc & xlsx.";
              ?>
              <label>
          </div>
        </div>
      </div>
  <?php
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $mess = "Chỉnh sửa file không thành công";
      showDetailSys($id_team_sys, $mess);
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["file_des"]["tmp_name"], $target_file)) {
        $mess = "Upload file " . htmlspecialchars(basename($_FILES["file_des"]["name"])) . " thành công";
        updateSys($id_sys, $team_sys_id, $unit_sys, $unit_user, $manager_user, $name_sys, $first_number, $describe_sys, $document_sys, $server_sys, $ip_sys, $config_sys, $create_by, $file_des);
      } else {
        $mess = "Chỉnh sửa không thành công. Upload file không thành công";
        showDetailSys($team_sys_id, $mess);
      }
    }
  } else {
    updateSys($id_sys, $team_sys_id, $unit_sys, $unit_user, $manager_user, $name_sys, $first_number, $describe_sys, $document_sys, $server_sys, $ip_sys, $config_sys, $create_by, false);
  }
}

function showInvoices()
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM sys_ql";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showInvoiceRow($seq_no, $row);
    }
  }
}

function showNameUnit()
{
  require "db_connection.php";
  if ($con) {
    $query = "SELECT * FROM unit_user ";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    echo '<select name="select_name" class="col col-md-12" >';
    while ($row = mysqli_fetch_assoc($result)) {
      $id_unit_user = $row['id_unit_user'];
      $name_unit_user = $row['name_unit_user'];
      echo "<option value='$id_unit_user'>$name_unit_user</option>";
    }
    echo '</select>';
  }
}

function showInvoiceRow($seq_no, $row)
{

  $team_sys_id = $row['team_sys_id'];
  $unit_sys_id = $row['unit_sys_id'];
  $user_manager_id = $row['user_manager_id'];
  $list_unit_user = $row['list_unit_user'];
  $list_block_infor = $row['list_block_infor'];

  require "db_connection.php";
  if ($con) {
    $query = "SELECT * FROM team_sys_manager WHERE id_team_sys = $team_sys_id";
    $result = mysqli_query($con, $query);
    $row1 = mysqli_fetch_assoc($result);
    $name_team_sys = $row1['name_team_sys'];

    $query = "SELECT * FROM unit_sys WHERE id_unit_sys = $unit_sys_id";
    $result = mysqli_query($con, $query);
    $row2 = mysqli_fetch_assoc($result);
    $name_unit_sys = $row2['name_unit_sys'];
                                          
    $query = "SELECT * FROM user_manager WHERE id_user_manager = $user_manager_id";
    $result = mysqli_query($con, $query);
    $row4 = mysqli_fetch_assoc($result);
    $name_unit_manager = $row4['name_user_manager'];
  }
    $describle = $row['describe_sys'];
  ?>
  <tr >
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['name_sys']; ?></td>
    <td><?php if ($row['type_sys'] == "1") {
          echo "Đầu tư";
        } else {
          echo "Hợp tác";
        } ?></td>
    <td><?php echo $row['first_number']; ?></td>
    <td><?php echo $name_unit_sys; ?></td>
    <td><?php echo $name_unit_manager; ?></td>
    <td>
      <div style="width:100px;">
      <table class="table">
        <tbody><?php 
        $list_unit_user = explode('/',$list_unit_user, -1);   
        foreach (array_values($list_unit_user) as $idx => $val) {
          $query = "SELECT * FROM unit_user WHERE id_unit_user = $val";
          $result = mysqli_query($con, $query);
          if($row = mysqli_fetch_assoc($result)){
              $name = $row['name_unit_user'];
              echo "<tr class='table'><td>$name</td></tr>";
          }
        }
    ?></tbody></table></div></td>
    <td><?php echo $describle; ?></td>
    <td><?php echo $name_team_sys; ?></td>
    <td><div style="width:500px;"><table class="table" >
    <tbody>
      <?php
        $list_block_infor = explode('/',$list_block_infor, -1); 
        foreach (array_values($list_block_infor) as $idx => $val) {
            $list_block_infor_detail = explode('|',$val, -1);
            ?><tr ><?php
            foreach($list_block_infor_detail as $detail){
              ?>
              <td style="width: 75px;"><?php echo $detail; ?></td>
              <?php
            }
            ?></tr><?php
        }
    ?>
    </tbody></table></div></td>
    <td><?php echo $row['created_at']; ?></td>
    <td class="button-container" style="height:100%">
      <button class="btn btn-warning btn-sm" onclick="viewItem(<?php echo $row['id_sys']; ?>);">
        <i class="fa fa-eye"></i>
      </button>
      <button class="btn btn-info btn-sm" onclick="viewEdit(<?php echo $row['id_sys']; ?>);">
        <i class="fa fa-pencil"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="deleteInvoice(<?php echo $row['id_sys']; ?>);">
        <i class="fa fa-trash"></i>
      </button>
    </td>
  </tr>
<?php
}

function searchInvoice($text)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM sys_ql WHERE UPPER(name_sys) LIKE '%$text%' OR ip_sys like '%$text%' ";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showInvoiceRow($seq_no, $row);
    }
  }
}
function printInvoice($invoice_number)
{
  require "db_connection.php";
  if ($con) {
    $query = "SELECT * FROM sales INNER JOIN customers ON sales.CUSTOMER_ID = customers.ID WHERE INVOICE_NUMBER = $invoice_number";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $customer_name = $row['NAME'];
    $address = $row['ADDRESS'];
    $contact_number = $row['CONTACT_NUMBER'];
    $doctor_name = $row['DOCTOR_NAME'];
    $doctor_address = $row['DOCTOR_ADDRESS'];

    $query = "SELECT * FROM invoices WHERE INVOICE_NUMBER = $invoice_number";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $invoice_date = $row['INVOICE_DATE'];
    $total_amount = $row['TOTAL_AMOUNT'];
    $total_discount = $row['TOTAL_DISCOUNT'];
    $net_total = $row['NET_TOTAL'];
  }
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

      <!-- form submit button -->
      <div class="row col col-md-12 m-auto" id="edit">
        <div class="col col-md-2 form-group float-right"></div>
        <div id="edit_button" class="col col-md-3 form-group float-right">
          <button class="btn btn-primary form-control font-weight-bold" onclick="viewEdit(<?php echo $id_sys; ?>);">Chỉnh sửa</button>
        </div>
        <div id="update_button" class="col col-md-3 form-group float-right">
          <button class="btn btn-secondary form-control font-weight-bold" onclick="goBack();">Quay lại
          </button>
        </div>
      </div>
      <!-- result message -->
      <div id="admin_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"></div>
    </div>
  </div>
  <hr style="border-top: 2px solid #ff5252;">

<?php
}

function updateSys($id_sys, $team_sys_id, $unit_sys, $unit_user, $manager_user, $name_sys, $first_number, $describe_sys, $document_sys, $server_sys, $ip_sys, $config_sys, $create_by, $file_des)
{
  require "db_connection.php";
  if ($file_des) {
    $query = "UPDATE sys_ql 
                SET 
                  unit_user_id='$unit_user', 
                  unit_sys_id='$unit_sys', 
                  user_manager_id='$manager_user', 
                  team_sys_id='$team_sys_id', 
                  name_sys='$name_sys',
                  first_number='$first_number',
                  describe_sys='$describe_sys',
                  document_sys='$document_sys',
                  ip_sys='$ip_sys',
                  server_sys='$server_sys',
                  config_sys='$config_sys',
                  create_by='$create_by',
                  file_des='$file_des'
                WHERE id_sys='$id_sys'";
  } else {
    $query = "UPDATE sys_ql 
                SET 
                  unit_user_id='$unit_user', 
                  unit_sys_id='$unit_sys', 
                  user_manager_id='$manager_user', 
                  team_sys_id='$team_sys_id', 
                  name_sys='$name_sys',
                  first_number='$first_number',
                  describe_sys='$describe_sys',
                  document_sys='$document_sys',
                  ip_sys='$ip_sys',
                  server_sys='$server_sys',
                  config_sys='$config_sys',
                  create_by='$create_by'
                WHERE id_sys='$id_sys'";
  }

  $result = mysqli_query($con, $query);
  if (!empty($result)) {
    $mess = "Chỉnh sửa thành công";
    showDetailSys($id_sys, $mess);
  } else {
    $mess = "Chỉnh sửa không thành công";
    showDetailSys($id_sys, $mess);
  }
}


function createSys($team_sys_id, $unit_sys, $unit_user, $manager_user, $name_sys, $first_number, $describe_sys, $document_sys, $server_sys, $ip_sys, $config_sys, $create_by, $file_des)
{
  require "db_connection.php";
  $query = "INSERT INTO sys_ql (unit_user_id, unit_sys_id, user_manager_id, team_sys_id, name_sys, first_number, describe_sys, document_sys, ip_sys, server_sys, config_sys, create_by, file_des)
              VALUE ('$unit_user', '$unit_sys', '$manager_user', '$team_sys_id', '$name_sys', '$first_number', '$describe_sys', '$document_sys', '$ip_sys', '$server_sys', '$config_sys', '$create_by', '$file_des')";

  $result = mysqli_query($con, $query);
  if (!empty($result)) {
    $mess = "Thêm mới $name_sys thành công";
    header("Location : new_invoice.php?mess=$mess", true);
    exit();
  } else {
    $mess = "Thêm mới $name_sys không thành công";
    header("Location : new_invoice.php?mess=$mess", true);
    exit();
  }
}


?>