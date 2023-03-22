<?php
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "DELETE FROM suppliers WHERE ID = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
    		showSuppliers(0);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showSuppliers($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id_team_sys = $_GET["id_team_sys"];
      $name_team_sys = ucwords($_GET["name_team_sys"]);
      $type_sys = $_GET["type_sys"];
      $describe_sys = $_GET["describe_sys"];
      updateSupplier($id_team_sys, $name_team_sys, $type_sys, $describe_sys);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showSuppliers(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchSupplier(strtoupper($_GET["text"]));
  }

  function showSuppliers($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM team_sys_manager";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['id_team_sys'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showSupplierRow($seq_no, $row);
      }
    }
  }


  function showSupplierRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['id_team_sys'] ?></td>
      <td><?php echo $row['name_team_sys']; ?></td>
      <td><?php echo $row['type_sys']; ?></td>
      <td><?php echo $row['describe_sys']; ?></td>
      <td><?php echo $row['created_at']; ?></td>
      <td>
      <button class="btn btn-warning btn-sm" onclick="viewItem(<?php echo $row['id_team_sys']; ?>);">
        <i class="fa fa-eye"></i>
        </button>
        <button href="" class="btn btn-info btn-sm" onclick="editSupplier(<?php echo $row['id_team_sys']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteSupplier(<?php echo $row['id_team_sys']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    </tr>
    <?php
  }

function showEditOptionsRow($seq_no, $row) {
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

function updateSupplier($id_team_sys, $name_team_sys, $type_sys, $describe_sys) {
  require "db_connection.php";
  $query = "UPDATE team_sys_manager SET name_team_sys = '$name_team_sys', type_sys = '$type_sys', describe_sys = '$describe_sys' WHERE id_team_sys = $id_team_sys";
  $result = mysqli_query($con, $query);
  if(!empty($result))
    showSuppliers(0);
}

function searchSupplier($text) {
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM team_sys_manager WHERE UPPER(name_team_sys) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showSupplierRow($seq_no, $row);
    }
  }
}

?>
