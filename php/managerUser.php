<?php
require "db_connection.php";
if ($con) {
  if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $ID = $_GET["ID"];
    try {
      $query1 = "DELETE FROM manager_user WHERE ID = $ID";
      $result1 = mysqli_query($con, $query1);
      if (empty($result1))
        echo "<td colspan='10'><div id='medicine_acknowledgement' class='col-md-12 h5 text-success font-weight-bold text-center' style='font-family: sans-serif;'>Không xoá được do liên kết bảng</div></td>";
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
    $ID = $_GET["ID"];
    showUser($ID);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "update") {
    $ID = $_GET["ID"];
    $id_team_user = $_GET["id_team_user"];
    $USERNAME = ucwords($_GET["USERNAME"]);
    $CONTACT_NUMBER = $_GET["CONTACT_NUMBER"];
    $EMAIL = ucwords($_GET["EMAIL"]);
    $room = ucwords($_GET["room"]);
    $position_manager = ucwords($_GET["position_manager"]);
    $create_by = ucwords($_GET["create_by"]);
    $created_at = $_GET["created_at"];
    $PASSWORD_1 = ucwords($_GET["PASSWORD_1"]);
    updateUser($ID, $id_team_user, $USERNAME, $CONTACT_NUMBER, $EMAIL, $room, $position_manager, $create_by, $created_at, $PASSWORD_1);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "cancel")
    showUser(0);

  if (isset($_GET["action"]) && $_GET["action"] == "search")
    searchUser(strtoupper($_GET["text"]));
}

function showUser($ID)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    // $query = "SELECT * FROM manager_user";
    $query = "SELECT admin_credentials.*, manager_team_user.name_team_user FROM admin_credentials JOIN manager_team_user ON admin_credentials.id_team_user = manager_team_user.id_team_user";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      if ($row['ID'] == $ID)
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
    <td><?php echo $row['USERNAME']; ?></td>
    <td><?php echo $row['name_team_user']; ?></td>
    <td><?php echo $row['PASSWORD_1']; ?></td>
    <td><?php echo $row['CONTACT_NUMBER'] ?></td>
    <td><?php echo $row['EMAIL']; ?></td>
    <td><?php echo $row['room']; ?></td>
    <td><?php echo $row['position_manager']; ?></td>
    <td><?php echo $row['create_by']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
    <td>
      <button href="" class="btn btn-info btn-sm" onclick="editUser(<?php echo $row['ID']; ?>);">
        <i class="fa fa-pencil"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="deleteUser(<?php echo $row['ID']; ?>);">
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
      <input type="text" class="form-control" value="<?php echo $row['USERNAME']; ?>" placeholder="Name" id="USERNAME" onblur="validateName(this.value, 'USERNAME_err');">
      <code class="text-danger small font-weight-bold float-right" id="USERNAME_err" style="display: none;"></code>
    </td>
    <td>      
      <?php
      require "db_connection.php";
      if ($con) {
        $name_team_user = "";
        $query1 = "SELECT * FROM manager_team_user";
        $result1 = mysqli_query($con, $query1);

        echo '<select name="name_team_user" id="id_team_user" class=" form-control pdm chosen-select col col-md-12" >';
        while ($row1 = mysqli_fetch_assoc($result1)) {
          $id_team_user = $row1['id_team_user'];
          $name_team_user = $row1['name_team_user'];
          if ($id_team_user == $id_team_user) {
            echo "<option value= '$id_team_user' selected='selected'>$name_team_user</option>";
          } else
            echo "<option value= '$id_team_user' >$name_team_user</option>";
        }
        echo '</select>';
      }
      ?>
    </td>
    <td>
      <textarea class="form-control" placeholder="PASSWORD_1" id="PASSWORD_1" onkeyup="notNull(this.value, 'PASSWORD_1_err');"><?php echo $row['PASSWORD_1']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="PASSWORD_1_err" style="display: none;"></code>
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['CONTACT_NUMBER']; ?>" placeholder="số điện thoại" id="CONTACT_NUMBER" onblur="validateContactNumber(this.value, 'CONTACT_NUMBER_err');">
      <code class="text-danger small font-weight-bold float-right" id=CONTACT_NUMBER_err style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="gmail" id="EMAIL" onkeyup="validateAddress(this.value, 'EMAIL_err');"><?php echo $row['EMAIL']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="EMAIL_err" style="display: none;"></code>
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
    </td>
    <td>
      <input type="date" class="datepicker form-control hasDatepicker" value="<?php echo $row['created_at']; ?>" placeholder="Thời gian tạo" id="created_at" onblur="checkDate(this.value, 'created_at_err');">
      <code class="text-danger small font-weight-bold float-right" id="created_at_err" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateUser(<?php echo $row['ID']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
<?php
}

function updateUser($ID, $id_team_user, $USERNAME, $CONTACT_NUMBER, $EMAIL, $room, $position_manager, $create_by, $created_at, $PASSWORD_1)
{
  require "db_connection.php";
  $query = "UPDATE admin_credentials SET USERNAME = '$USERNAME', id_team_user = $id_team_user, CONTACT_NUMBER = '$CONTACT_NUMBER', EMAIL = '$EMAIL', room = '$room', position_manager = '$position_manager', create_by = '$create_by', created_at = '$created_at', PASSWORD_1 = '$PASSWORD_1' WHERE ID = $ID";
  $result = mysqli_query($con, $query);  
  var_dump( $query);
  if (!empty($result)) {
    show_alert("Thao tác thành công!", true);
    showUser(0);
  } else {
    show_alert("Thao tác thất bại!", false);
  }
  // showUser(0);

}
function show_alert($message, $is_success) {
  echo '<script>
          document.getElementById("alert-message").innerHTML = "'.$message.'";
          document.getElementById("alert-box").style.display = "block";
          document.getElementById("alert-box").classList.add("'.($is_success ? "alert-success" : "alert-danger").'");
          
          setTimeout(function(){
              document.getElementById("alert-box").style.display = "none";
              document.getElementById("alert-box").classList.remove("alert-success", "alert-danger");
          }, 5000);
      </script>';
}
function searchUser($text)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT admin_credentials.*, manager_team_user.name_team_user FROM admin_credentials JOIN manager_team_user ON admin_credentials.id_team_user = manager_team_user.id_team_user WHERE USERNAME LIKE '%$text%' OR name_team_user LIKE '%$text%' OR CONTACT_NUMBER LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showUserRow($seq_no, $row);
    }
  }
}

?>