<?php
require "db_connection.php";
$target_dir = "../uploads/";
if ($con) {
  if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id = $_GET["id"];

    try {
      $query1 = "DELETE FROM team_sys_manager WHERE id_team_sys = $id";
      $result1 = mysqli_query($con, $query1);
      if (empty($result1))
        echo "<td colspan='10'><div id='medicine_acknowledgement' class='col-md-12 h5 text-success font-weight-bold text-center' style='font-family: sans-serif;'>Không xoá được</div></td>";
      showSuppliers(0);
    } catch (Exception $e) {
?>
      <td colspan="10">
        <div id="medicine_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;">Không xoá được</div>
      </td>
      <?php
      showSuppliers(0);
    }
  }

  if (isset($_GET["action"]) && $_GET["action"] == "edit") {
    $id = $_GET["id"];
    showSuppliers($id);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "update") {
    $id_team_sys = $_GET["id_team_sys"];
    $name_team_sys = ucwords($_GET["name_team_sys"]);
    $type_sys = $_GET["type_sys"];
    $describe_sys = $_GET["describe_sys"];
    $create_by = $_GET["create_by"];
    $file_des = $_FILES["file_des"]["name"];

    updateSupplier($id_team_sys, $name_team_sys, $type_sys, $describe_sys, $create_by, $file_des);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "cancel")
    showSuppliers(0);

  if (isset($_GET["action"]) && $_GET["action"] == "search")
    searchSupplier(strtoupper($_GET["text"]));

  if (isset($_GET["action"]) && $_GET["action"] == "search1") {
    searchTeamSys(strtoupper($_GET["number1"]));
  }

  if (isset($_GET["action"]) && $_GET["action"] == "refresh")
    showSuppliers(0);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_team_sys = $_POST["id_team_sys"];
    $name_team_sys = ucwords($_POST["name_team_sys"]);
    $type_sys = $_POST["type_sys"];
    $describe_sys = $_POST["describe_sys"];
    $create_by = $_POST["create_by"];
    $file_des_sv = $_POST["file_des_sv"];

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
                echo "Sorry, file already exists";
                ?>
                <label>
            </div>
          </div>
        </div>
      <?php
        $uploadOk = 0;
      } else {
      }

      // Check file file_des
      if ($_FILES["file_des"]["size"] > 5000000) {
      ?>
        <div class="row col col-md-12">
          <div class="row col col-md-12">
            <div class="col col-md-12 form-group">
              <label for="id_team_sys">
                <?php
                echo "Sorry, your file is too large.";
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
                echo "Sorry, only pdf, ppt, doc & xlsx files are allowed.";
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
        showDetailSuppliers($id_team_sys);
        // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["file_des"]["tmp_name"], $target_file)) {
        ?>
          <div class="row col col-md-12">
            <div class="row col col-md-12">
              <div class="col col-md-12 form-group">
                <label for="id_team_sys">
                  <?php
                  echo "The file " . htmlspecialchars(basename($_FILES["file_des"]["name"])) . " has been uploaded.";
                  ?>
                  <label>
              </div>
            </div>
          </div>
    <?php
          updateSupplier($id_team_sys, $name_team_sys, $type_sys, $describe_sys, $create_by, $file_des);
        } else {
          showDetailSuppliers($id_team_sys);
        }
      }
    } else {
      updateSupplier($id_team_sys, $name_team_sys, $type_sys, $describe_sys, $create_by, $file_des_sv);
    }
  }
}

function showSuppliers($id)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM team_sys_manager";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      if ($row['id_team_sys'] == $id)
        showEditOptionsRow($seq_no, $row);
      else
        showSupplierRow($seq_no, $row);
    }
  }
}

function showDetailSuppliers($id)
{
  require "db_connection.php";
  $target_dir = "../uploads/";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM team_sys_manager WHERE id_team_sys=$id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $id_team_sys = $row['id_team_sys'];
    $name_team_sys = $row['name_team_sys'];
    $type_sys = $row['type_sys'];
    $describe_sys = $row['describe_sys'];
    $create_by = $row['create_by'];
    $created_at = $row['created_at'];
    $file_des = $row['file_des'];

    ?>
    <div class="container">

      <div class="row" id='suppliers_div'>
        <div class="row col col-md-12">
          <div class="row col col-md-12">
            <div class="col col-md-12 form-group">
              <label for="id_team_sys">Id nhóm hệ thống :</label>
              <input id="id_team_sys" type="text" class="form-control" value="<?php echo $id_team_sys; ?>" placeholder="id_team_sys" onkeyup="validateName(this.value, 'id_error');" disabled>
              <code class="text-danger small font-weight-bold float-right mb-2" id="id_error" style="display: none;"></code>
            </div>
          </div>
          <div class="row col col-md-12">
            <div class="col col-md-12 form-group">
              <label for="name_team_sys">Tên nhóm hệ thống :</label>
              <input id="name_team_sys" type="text" class="form-control" value="<?php echo $name_team_sys; ?>" placeholder="name_team_sys" onkeyup="validateName(this.value, 'name_team_sys_error');">
              <code class="text-danger small font-weight-bold float-right mb-2" id="name_team_sys_error" style="display: none;"></code>
            </div>
          </div>
          <div class="row col col-md-12">
            <div class="col col-md-12 form-group">
              <label for="type_sys">Loại:</label>
              <input id="type_sys" type="number" class="form-control" value="<?php echo $type_sys; ?>" placeholder="type_sys" onkeyup="validateName(this.value, 'type_sys');">
              <code class="text-danger small font-weight-bold float-right mb-2" id="type_sys" style="display: none;"></code>
            </div>
          </div>
          <div class="row col col-md-12">
            <div class="col col-md-12 form-group">
              <label for="describe_sys">Mô tả :</label>
              <input id="describe_sys" type="text" class="form-control" value="<?php echo $describe_sys; ?>" placeholder="describe_sys">
            </div>
          </div>
          <div class="row col col-md-12">
            <div class="col col-md-12 form-group">
              <label for="create_by">Người tạo :</label>
              <input id="create_by" type="text" class="form-control" value="<?php echo $create_by; ?>" placeholder="create by" onkeyup="validateName(this.value, 'create_by');">
              <code class="text-danger small font-weight-bold float-right mb-2" id="create_by" style="display: none;"></code>
            </div>
          </div>
          <div class="row col col-md-12">
            <div class="col col-md-12 form-group">
              <label for="created_at">Ngày tạo :</label>
              <input id="created_at" type="text" class="form-control" value="<?php echo $created_at; ?>" placeholder="created_at" onkeyup="validateName(this.value, 'created_at');" disabled>
              <code class="text-danger small font-weight-bold float-right mb-2" id="created_at" style="display: none;"></code>
            </div>
          </div>
          <div class="row col col-md-12">
            <div class="col col-md-12 form-group">
              <label for="file">File mô tả :</label>
              <tr>
                <td><?php
                    ?>
                <td><a href="php/read.php?filename=<?php echo $target_dir . $file_des; ?>" formtarget="_blank" id="file_des_sv">
                    <input id="file_des_sv" type="text" class="form-control" value="<?php echo $file_des; ?>" disabled></a></td>
              </tr>
            </div>
          </div>

          <div class="row col col-md-12">
            <div class="col col-md-12 form-group">
              <label for="file_des">File mô tả mới:</label>
              <input id="file_des" type="file" name="file_des">
            </div>
          </div>
          <!-- horizontal line -->
          <div class="col col-md-12">
            <hr class="col-md-12 float-left" style="padding: 0px; width: 95%; border-top: 2px solid  #02b6ff;">
          </div>
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
        <?php

      }
    }

    function showSupplierRow($seq_no, $row)
    {
        ?>
        <tr>
          <td><?php echo $seq_no; ?></td>
          <td><?php echo $row['id_team_sys'] ?></td>
          <td><?php echo $row['name_team_sys']; ?></td>
          <td><?php if ($row['type_sys'] == "1") {
                echo "Đầu tư";
              } else {
                echo "Hợp tác";
              } ?></td>
          <td><?php echo $row['describe_sys']; ?></td>
          <td><?php echo $row['created_at']; ?></td>
          <td>
            <button class="btn btn-warning btn-sm" onclick="viewItem(<?php echo $row['id_team_sys']; ?>);">
              <i class="fa fa-eye"></i>
            </button>
            <button href="" class="btn btn-info btn-sm" onclick="viewEdit(<?php echo $row['id_team_sys']; ?>);">
              <i class="fa fa-pencil"></i>
            </button>
            <button class="btn btn-danger btn-sm" onclick="deleteSupplier(<?php echo $row['id_team_sys']; ?>);">
              <i class="fa fa-trash"></i>
            </button>
          </td>
        </tr>
      <?php
    }

    function showEditOptionsRow($seq_no, $row)
    {
      ?>
        <tr>
          <td><?php echo $seq_no; ?></td>
          <td><?php echo $row['id_team_sys'] ?></td>
          <td>
            <input type="text" class="form-control" value="<?php echo $row['name_team_sys']; ?>" placeholder="Name" id="name_team_sys" onkeyup="validateName(this.value, 'name_error');">
          </td>
          <td>
            <input type="text" class="form-control" value="<?php echo $row['type_sys']; ?>" placeholder="type sys" id="type_sys" onblur="validateContactNumber(this.value, 'email_error');">
          </td>
          <td>
            <input type="text" class="form-control" value="<?php echo $row['describe_sys']; ?>" placeholder="describe sys" id="describe_sys" onblur="validateContactNumber(this.value, 'contact_number_error');">
          </td>
          <td>
            <textarea class="form-control" placeholder="tạo bởi" id="created_at" onblur="validateAddress(this.value, 'address_error');" readonly><?php echo $row['created_at']; ?></textarea>
          </td>
          <td>

            <button href="" class="btn btn-success btn-sm" onclick="updateSupplier(<?php echo $row['id_team_sys']; ?>);">
              <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm" onclick="cancel();">
              <i class="fa fa-close"></i>
            </button>
          </td>
        </tr>
      <?php
    }

    function updateSupplier($id_team_sys, $name_team_sys, $type_sys, $describe_sys, $create_by, $file_des)
    {
      require "db_connection.php";
      if ($file_des) {
        $query = "UPDATE team_sys_manager SET name_team_sys = '$name_team_sys', type_sys = '$type_sys', describe_sys = '$describe_sys', create_by = '$create_by' , file_des = '$file_des' WHERE id_team_sys = $id_team_sys";
      } else {
        $query = "UPDATE team_sys_manager SET name_team_sys = '$name_team_sys', type_sys = '$type_sys', describe_sys = '$describe_sys', create_by = '$create_by' , file_des = '$file_des' WHERE id_team_sys = $id_team_sys";
      }
      $result = mysqli_query($con, $query);
      if (!empty($result))
        showDetailSuppliers($id_team_sys, True);
    }

    function searchSupplier($text)
    {
      require "db_connection.php";
      if ($con) {
        $seq_no = 0;
        $query = "SELECT * FROM team_sys_manager WHERE UPPER(name_team_sys) LIKE '%$text%'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
          $seq_no++;
          showSupplierRow($seq_no, $row);
        }
      }
    }
    function searchTeamSys($number1)
    {
      require "db_connection.php";
      if ($con) {
        $seq_no = 0;
        $query = "SELECT * FROM team_sys_manager WHERE type_sys = '$number1'";
        var_dump($query);
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
          $seq_no++;
          showSupplierRow($seq_no, $row);
        }
      }
    }

      ?>