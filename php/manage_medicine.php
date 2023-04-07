<?php
require "db_connection.php";

if ($con) {
  if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id = $_GET["id"];
    $query = "DELETE FROM medicines WHERE ID = $id";
    $result = mysqli_query($con, $query);
    if (!empty($result))
      showMedicines(0);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "edit") {
    $id_unit_sys = $_GET["id_unit_sys"];
    showMedicines($id_unit_sys);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "update") {
    $id_unit_sys = $_GET["id_unit_sys"];
    $name_unit_sys = ucwords($_GET["name_unit_sys"]);
    $name_room = ucwords($_GET["name_room"]);
    $create_by = ucwords($_GET["create_by"]);
    $created_at = $_GET["created_at"];
    updateMedicine($id_unit_sys, $name_unit_sys, $name_room, $create_by, $created_at);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "cancel")
    showMedicines(0);

  if (isset($_GET["action"]) && $_GET["action"] == "search")
    searchMedicine(strtoupper($_GET["text"]), $_GET["tag"]);
}
//id_unit_sys
function showMedicines($id_unit_sys)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM unit_sys";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      if ($row['id_unit_sys'] == $id_unit_sys)
        showEditOptionsRow($seq_no, $row);
      else
        showMedicineRow($seq_no, $row);
    }
  }
}

function showMedicineRow($seq_no, $row)
{
?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['name_unit_sys']; ?></td>
    <td><?php echo $row['name_room']; ?></td>
    <td><?php echo $row['create_by']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
    <td>
      <button href="" class="btn btn-info btn-sm" onclick="editMedicine(<?php echo $row['id_unit_sys']; ?>);">
        <i class="fa fa-pencil"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="deleteMedicine(<?php echo $row['id_unit_sys']; ?>);">
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
    <td>
      <input type="text" class="form-control" value="<?php echo $row['name_unit_sys']; ?>" placeholder="Tên đơn vị " id="name_unit_sys" onblur="notNull(this.value, 'name_unit_sys_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_unit_sys_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['name_room']; ?>" placeholder="Phòng" id="name_room" onblur="notNull(this.value, 'name_room_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_room_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['create_by']; ?>" placeholder="Người tạo" id="create_by" onblur="validateName(this.value, 'create_by_error');">
      <code class="text-danger small font-weight-bold float-right" id="create_by_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['created_at']; ?>" placeholder="Thời gian tạo" id="created_at" onblur="notNull(this.value, 'created_at_error');">
      <code class="text-danger small font-weight-bold float-right" id="created_at_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateMedicine(<?php echo $row['id_unit_sys']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
<?php
}

function updateMedicine($id_unit_sys, $name_unit_sys, $name_room, $create_by, $created_at)
{
  require "db_connection.php";
  $query = "UPDATE unit_sys SET name_unit_sys = '$name_unit_sys', name_room = '$name_room', create_by = '$create_by', created_at = '$created_at' WHERE id_unit_sys = $id_unit_sys";
  $result = mysqli_query($con, $query);
  // if ($result) {
  //   $_SESSION['message'] = "Cập nhật dữ liệu thành công.";
  //   $_SESSION['status'] = "success";
  // } else {
  //   $_SESSION['message'] = "Cập nhật dữ liệu thất bại: ";
  //   $_SESSION['status'] = "error";
  // }
  if (!empty($result))
    // showMedicines(0);
    echo "Thành công";
  else
    echo "Thất bại";
}

function searchMedicine($text, $tag)
{
  require "db_connection.php";
  if ($tag == "name")
    $column = "NAME";
  if ($tag == "generic_name")
    $column = "GENERIC_NAME";
  if ($tag == "suppliers_name")
    $column = "SUPPLIER_NAME";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM medicines WHERE UPPER($column) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showMedicineRow($seq_no, $row);
    }
  }
}

?>