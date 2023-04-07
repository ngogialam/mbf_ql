<?php

  if(isset($_GET["action"]) && $_GET["action"] == "delete") {
    require "db_connection.php";
    $id_sys = $_GET["id_sys"];
    $query = "DELETE FROM sys_ql WHERE id_sys = $id_sys";
    $result = mysqli_query($con, $query);
    if(!empty($result))
  		showInvoices();
  }

  if(isset($_GET["action"]) && $_GET["action"] == "refresh")
    showInvoices();


  if(isset($_GET["action"]) && $_GET["action"] == "search")
   searchInvoice(strtoupper($_GET["text"]));

  ////////////////////////// POST edit ////////////////////////
  if ($_SERVER["REQUEST_METHOD"] == "POST"  ) {
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

    if(!empty($_FILES["file_des"])){
      $file_des = basename($_FILES["file_des"]["name"]);
    
    // collect value of input field
      $check = False;

      $target_dir = "../uploads/";
      $target_file = $target_dir . basename($_FILES["file_des"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      
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
      if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "ppt"
      && $imageFileType != "xlsx" && $imageFileType != "docx" ) {
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
          $mess= "Upload file ". htmlspecialchars( basename( $_FILES["file_des"]["name"])). " thành công";
          updateSys($id_sys, $team_sys_id, $unit_sys, $unit_user, $manager_user, $name_sys, $first_number, $describe_sys, $document_sys, $server_sys, $ip_sys, $config_sys, $create_by, $file_des);
        } else {
          $mess = "Chỉnh sửa không thành công. Upload file không thành công";
          showDetailSys($team_sys_id, $mess);
        }
      }
    }
    else{
      updateSys($id_sys, $team_sys_id, $unit_sys, $unit_user, $manager_user, $name_sys, $first_number, $describe_sys, $document_sys, $server_sys, $ip_sys, $config_sys, $create_by, false);
    }
  }

  function showInvoices() {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM sys_ql";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showInvoiceRow($seq_no, $row);
      }
    }
  }

  function showNameUnit(){
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
  
  function showInvoiceRow($seq_no, $row) {

    $team_sys_id = $row['team_sys_id'];
    $unit_sys_id = $row['unit_sys_id'];
    $unit_user_id = $row['unit_user_id'];
    $user_manager_id = $row['user_manager_id'];

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

        $query = "SELECT * FROM unit_user WHERE id_unit_user = $unit_user_id";
        $result = mysqli_query($con, $query);
        $row3 = mysqli_fetch_assoc($result);
        $name_user_manager = $row3['name_unit_user'];

        $query = "SELECT * FROM user_manager WHERE id_user_manager = $user_manager_id";
        $result = mysqli_query($con, $query);
        $row4 = mysqli_fetch_assoc($result);
        $name_unit_manager = $row4['name_user_manager'];
    }

    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['id_sys']; ?></td>
      <td><?php echo $row['name_sys']; ?></td> 
      <td><?php echo $row['first_number']; ?></td>
      <td><?php echo $name_unit_manager; ?></td>
      <td><?php echo $name_user_manager; ?></td>
      <td><?php echo $name_team_sys; ?></td>
      <td><?php echo $row['ip_sys']; ?></td>
      <td><?php echo $row['server_sys']; ?></td>
      <td><?php echo $row['config_sys']; ?></td>
      <td><?php echo $row['created_at']; ?></td>
      <td class="button-container">      
        <button class="btn btn-warning btn-sm" onclick="viewItem(<?php echo $row['id_sys']; ?>);">
        <i class="fa fa-eye"></i>
        </button>
        <button  class="btn btn-info btn-sm" onclick="viewEdit(<?php echo $row['id_sys']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteInvoice(<?php echo $row['id_sys']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    </tr>
    <?php
  }

  function searchInvoice($text) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM sys_ql WHERE UPPER(name_sys) LIKE '%$text%'";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showInvoiceRow($seq_no, $row);
      }
    }
  }
  function searchSysNumber($number) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM sys_ql WHERE UPPER(ip_sys) LIKE '%$number%'";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showInvoiceRow($seq_no, $row);
      }
    }
  }




  function showDetailSys($id_sys, $mess){
    // header section end
    require "db_connection.php";
    if ($con) {
        $query = "SELECT * FROM sys_ql WHERE id_sys = $id_sys";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
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
        $file_des = $row['file_des'];
    }
    ?>
    <div class="row">
        <div class="row col col-md-12">
          <div id="admin_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center"
                  style="font-family: sans-serif;">
                <?php 
                  echo $mess;
                ?>                     
                </div>

            <div class="row col col-md-12">
                <div class="col col-md-12 form-group">
                    <label for="id_sys">Id hệ thống :</label>
                    <input id="id_sys" type="text" class="form-control" value="<?php echo $id_sys; ?>"
                        placeholder="id_sys" onkeyup="validateName(this.value, 'id_error');" disabled>
                    <code class="text-danger small font-weight-bold float-right mb-2" id="id_error"
                        style="display: none;"></code>
                </div>
            </div>
            <div class="row col col-md-12" style="flex-direction: row-reverse;">
                <?php
                    $query = "SELECT * FROM team_sys_manager WHERE id_team_sys = $id_team_sys_sys";
                    $result1 = mysqli_query($con, $query);
                    $row1 = mysqli_fetch_assoc($result1);
                    $team_sys = $row1['name_team_sys'];
                ?>
                <div class="col col-md-12 form-group">
                    <label for="name_team_sys">Tên nhóm hệ thống :</label>
                    <input id="name_team_sys" type="text" class="form-control"
                        value="<?php echo $team_sys; ?>" placeholder="name_team_sys"
                        onkeyup="validateName(this.value, 'name_team_sys_error');" disabled>
                    <code class="text-danger small font-weight-bold float-right mb-2" id="name_team_sys_error"
                        style="display: none;"></code>
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
                <?php
                    $query = "SELECT * FROM unit_sys WHERE id_unit_sys = $id_team_sys_sys";
                    $result2 = mysqli_query($con, $query);
                    $row2 = mysqli_fetch_assoc($result2);
                    $name_unit_sys = $row2['name_unit_sys'];
                ?>
                <div class="col col-md-12 form-group">
                    <label for="name_team_sys">Đơn vị quản lý :</label>
                    <input id="name_team_sys" type="text" class="form-control"
                        value="<?php echo $name_unit_sys; ?>" placeholder="name_team_sys"
                        onkeyup="validateName(this.value, 'name_team_sys_error');" disabled>
                </div>
            </div>
            <div class="row col col-md-12">
                <?php
                    $query = "SELECT * FROM unit_user WHERE id_unit_user = $id_unit_user_sys ";
                    $result3 = mysqli_query($con, $query);
                    $row3 = mysqli_fetch_assoc($result3);
                    $name_unit_user = $row3['name_unit_user'];
                ?>
                <div class="col col-md-12 form-group">
                    <label for="name_team_sys">Đơn vị sử dụng :</label>
                    <input id="describe_sys" type="text" class="form-control"
                        value="<?php echo $name_unit_user; ?>" placeholder="describe_sys"
                        onkeyup="validateName(this.value, 'describe_sys_error');" disabled >
                </div>
            </div>
            <div class="row col col-md-12">
                <div class="col col-md-12 form-group">
                    <?php
                      $query = "SELECT * FROM manager_user WHERE id_user = $id_user_manager_sys";
                      $result4 = mysqli_query($con, $query);
                      $row4 = mysqli_fetch_assoc($result4);
                      $name_user_manager = $row4['name_user_manager'];
                    ?>
                    <label for="name_team_sys">Người quản lý :</label>
                    <input id="manager_user" type="text" class="form-control"
                        value="<?php echo $name_user_manager; ?>" placeholder="manager_user"
                        onkeyup="validateName(this.value, 'describe_sys_error');" disabled >
                    <code class="text-danger small font-weight-bold float-right mb-2" id="describe_sys_error"
                        style="display: none;"></code>
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
                        placeholder="" onkeyup="validateName(this.value, 'document_sys_error');" disabled
                        >
                    <code class="text-danger small font-weight-bold float-right mb-2" id="document_sys_error"
                        style="display: none;"></code>
                </div>
            </div>
            <div class="row col col-md-12">
                <div class="col col-md-12 form-group">
                    <label for="name_team_sys">Server hệ thống :</label>
                    <input id="server_sys" type="text" class="form-control" value="<?php echo $server_sys; ?>"
                        placeholder="server_sys" onkeyup="validateName(this.value, 'server_sys_error');" disabled
                        >
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
                        placeholder="config_sys" onkeyup="validateName(this.value, 'config_sys_error');" disabled
                        >
                    <code class="text-danger small font-weight-bold float-right mb-2" id="config_sys_error"
                        style="display: none;"></code>
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

            <!-- horizontal line -->
            <div class="col col-md-12">
                <hr class="col-md-12 float-left"
                    style="padding: 0px; width: 95%; border-top: 2px solid  #02b6ff;">
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
            <div id="admin_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center"
                style="font-family: sans-serif;"></div>
        </div>
    </div>
    <hr style="border-top: 2px solid #ff5252;">

  <?php
  }

  function updateSys($id_sys, $team_sys_id, $unit_sys, $unit_user, $manager_user, $name_sys, $first_number, $describe_sys, $document_sys, $server_sys, $ip_sys, $config_sys, $create_by, $file_des){
    require "db_connection.php";
    if($file_des){
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
    if(!empty($result)){
      $mess = "Chỉnh sửa thành công";
      showDetailSys($id_sys, $mess);
    } else {
      $mess = "Chỉnh sửa không thành công";
      showDetailSys($id_sys, $mess);
    }
      
  }


  function createSys($team_sys_id, $unit_sys, $unit_user, $manager_user, $name_sys, $first_number, $describe_sys, $document_sys, $server_sys, $ip_sys, $config_sys, $create_by, $file_des){
    require "db_connection.php";
    $query = "INSERT INTO sys_ql (unit_user_id, unit_sys_id, user_manager_id, team_sys_id, name_sys, first_number, describe_sys, document_sys, ip_sys, server_sys, config_sys, create_by, file_des)
              VALUE ('$unit_user', '$unit_sys', '$manager_user', '$team_sys_id', '$name_sys', '$first_number', '$describe_sys', '$document_sys', '$ip_sys', '$server_sys', '$config_sys', '$create_by', '$file_des')";

    $result = mysqli_query($con, $query);
    if(!empty($result)){
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