<?php
require "db_connection.php";
if ($con) {
  if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id_user = $_GET["id_user"];
    try {
      $query1 = "DELETE FROM manager_user WHERE id_user = $id_user";
      $result1 = mysqli_query($con, $query1);
      if (!empty($result1))
        showUser(0);
    } catch (Exception $e) {
?>
      <td colspan="10">
        <div id="medicine_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;">Không xoá được</div>
      </td>
  <?php
      showUser(0);
    }
  }

  if (isset($_GET["action"]) && $_GET["action"] == "edit") {
    $id_user = $_GET["id_user"];
    showUser($id_user);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "update") {
    $id_user = $_GET["id_user"];
    $id_team_user = $_GET["id_team_user"];
    $name_user_manager = ucwords($_GET["name_user_manager"]);
    $sdt = $_GET["sdt"];
    $gmail = ucwords($_GET["gmail"]);
    $room = ucwords($_GET["room"]);
    $position_manager = ucwords($_GET["position_manager"]);
    $create_by = $_GET["create_by"];
    $created_at = $_GET["created_at"];
    updateUser($id_user, $id_team_user, $name_user_manager, $sdt, $gmail, $room, $position_manager, $create_by, $created_at);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "cancel")
    showUser(0);

  if (isset($_GET["action"]) && $_GET["action"] == "search")
    searchUser(strtoupper($_GET["text"]));
}

function showUser($id_user)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    // $query = "SELECT * FROM manager_user";
    $query = "SELECT manager_user.*, manager_team_user.name_team_user FROM manager_user JOIN manager_team_user ON manager_user.id_team_user = manager_team_user.id_team_user";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      if ($row['id_user'] == $id_user)
        showEditUserRow($seq_no, $row);
      else
        showUserRow($seq_no, $row);
    }
  }
}

function showUserRow($seq_no, $row)
{
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['name_team_user']; ?></td>
    <td><?php echo $row['name_user_manager'] ?></td>
    <td><?php echo $row['sdt']; ?></td>
    <td><?php echo $row['gmail']; ?></td>
    <td><?php echo $row['room']; ?></td>
    <td><?php echo $row['position_manager']; ?></td>
    <td><?php echo $row['create_by']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
    <td>
      <button href="" class="btn btn-info btn-sm" onclick="editUser(<?php echo $row['id_user']; ?>);">
        <i class="fa fa-pencil"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="deleteUser(<?php echo $row['id_user']; ?>);">
        <i class="fa fa-trash"></i>
      </button>
    </td>
  </tr>
<?php
}

function showEditUserRow($seq_no, $row)
{
?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td>
      <select id="id_team_user" class="form-control">
        <option value="<?php echo $row['id_team_user']; ?>"><?php echo $row['name_team_user']; ?></option>
        <option value="0">Chọn nhóm người dùng</option>
      </select>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['name_user_manager']; ?>" placeholder="Name" id="name_user_manager" onkeyup="validateName(this.value, 'name_err');">
      <code class="text-danger small font-weight-bold float-right" id="name_err" style="display: none;"></code>
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['sdt']; ?>" placeholder="số điện thoại" id="sdt" onblur="validateContactNumber(this.value, 'sdt_err');">
      <code class="text-danger small font-weight-bold float-right" id=sdt_err style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="gmail" id="gmail" onkeyup="validateAddress(this.value, 'gmail_err');"><?php echo $row['gmail']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="gmail_err" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['room']; ?>" placeholder="phòng ban" id="room" onkeyup="notNull(this.value, 'room_err');">
      <code class="text-danger small font-weight-bold float-right" id="room_err" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['position_manager']; ?>" placeholder="Name" id="position_manager" onblur="notNull(this.value, 'position_manager_err');">
      <code class="text-danger small font-weight-bold float-right" id="position_manager_err" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['create_by']; ?>" placeholder="Người tạo" id="create_by" onblur="notNull(this.value, 'create_by_error');">
      <code class="text-danger small font-weight-bold float-right" id="create_by_error" style="display: none;"></code>
      <!-- <input type="text" class="form-control" value="<?php echo $row['create_by']; ?>" placeholder="Name" id="create_by" onkeyup="validateName(this.value, 'create_by_error');">
      <code class="text-danger small font-weight-bold float-right" id="create_by_error" style="display: none;"></code> -->
    </td>
    <td>
      <input type="date" class="datepicker form-control hasDatepicker" value="<?php echo $row['created_at']; ?>" placeholder="Thời gian tạo" id="created_at" onblur="checkDate(this.value, 'created_at_err');">
      <code class="text-danger small font-weight-bold float-right" id="created_at_err" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateUser(<?php echo $row['id_user']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
<?php
}

function updateUser($id_user, $id_team_user, $name_user_manager, $sdt, $gmail, $room, $position_manager, $create_by, $created_at)
{
  require "db_connection.php";
  $query = "UPDATE manager_user SET id_team_user = $id_team_user, name_user_manager = '$name_user_manager', sdt = $sdt, gmail = '$gmail', room = '$room', position_manager = '$position_manager', create_by = '$create_by', created_at = '$created_at' WHERE id_user = $id_user";
  $result = mysqli_query($con, $query);
  var_dump($query);
  if (!empty($result)) {
    echo "thành công";
  } else {
    echo "Không thành công";
  }
  // showUser(0);

}

function searchUser($text)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT manager_user.*, manager_team_user.name_team_user FROM manager_user JOIN manager_team_user ON manager_user.id_team_user = manager_team_user.id_team_user WHERE name_user_manager LIKE '%$text%' OR name_team_user LIKE '%$text%' OR sdt LIKE '%$text%'";
    $result = mysqli_query($con, $query);    
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showUserRow($seq_no, $row);
    }
  }
}

?>