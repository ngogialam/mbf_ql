<?php
require "db_connection.php";

if ($con) {
  if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id_team_user = $_GET["id"];

    try {
      $query1 = "DELETE FROM manager_team_user WHERE id_team_user = $id_team_user";
      $result1 = mysqli_query($con, $query1);
      if (!empty($result1))
        showPurchases(0);
      else{
        echo "<td colspan='10'><div id='medicine_acknowledgement' class='col-md-12 h5 text-success font-weight-bold text-center' style='font-family: sans-serif;'>Không xoá được</div></td>";
        showPurchases(0);
      }
    } catch (Exception $e){
      ?>
        <td colspan="10"><div id="medicine_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;">Không xoá được</div></td> 
      <?php
        showPurchases(0);
      }
  }

  if (isset($_GET["action"]) && $_GET["action"] == "edit") {
    $id_team_user = $_GET["id_team_user"];
    showPurchases($id_team_user);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "update") {
    $id_team_user = $_GET["id_team_user"];
    $name_team_user = ucwords($_GET["name_team_user"]);
    $user_status = $_GET["user_status"];
    $create_by = ucwords($_GET["create_by"]);
    $created_at = $_GET["created_at"];
    updatePurchase($id_team_user, $name_team_user, $user_status, $create_by, $created_at);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "cancel")
    showPurchases(0);

  if (isset($_GET["action"]) && $_GET["action"] == "search")
    searchPurchase(strtoupper($_GET["text"]));

  if (isset($_GET["action"]) && $_GET["action"] == "search1") {
    searchStatus(strtoupper($_GET["number1"]));
  }
}

function showPurchases($id_team_user)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM manager_team_user";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      if ($row['id_team_user'] == $id_team_user)
        showEditOptionsRow($seq_no, $row);
      else
        showPurchaseRow($seq_no, $row);
    }
  }
}

function showPurchaseRow($seq_no, $row)
{
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['name_team_user'] ?></td>
    <td><?php if ($row['user_status'] == "1") {
          echo "Hoạt động";
        } else {
          echo "Đã tắt";
        } ?></td>
    <td><?php echo $row['create_by']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
    <td>
      <button href="" class="btn btn-info btn-sm" onclick="editPurchase(<?php echo $row['id_team_user']; ?>);">
        <i class="fa fa-pencil"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="deletePurchase(<?php echo $row['id_team_user']; ?>);">
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
      <input type="text" class="form-control" value="<?php echo $row['name_team_user']; ?>" placeholder="Tên nhóm " id="name_team_user" onblur="notNull(this.value, 'name_team_user_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_team_user_error" style="display: none;"></code>
    </td>
    <td>
      <select id="user_status" class="form-control">
        <option value="1" <?php if ($row['user_status'] == "1") echo "selected" ?>>Họat động</option>
        <option value="0" <?php if ($row['user_status'] == "0") echo "selected" ?>>Đang tắt</option>
      </select>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['create_by']; ?>" placeholder="Người tạo" id="create_by" onblur="notNull(this.value, 'create_by_error');">
      <code class="text-danger small font-weight-bold float-right" id="create_by_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['created_at']; ?>" placeholder="Thời gian tạo" id="created_at" onblur="notNull(this.value, 'created_at_error');">
      <code class="text-danger small font-weight-bold float-right" id="created_at_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updatePurchase(<?php echo $row['id_team_user']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
<?php
}

function updatePurchase($id_team_user, $name_team_user, $user_status, $create_by, $created_at)
{
  require "db_connection.php";
  $query = "UPDATE manager_team_user SET name_team_user = '$name_team_user', user_status = '$user_status', create_by = '$create_by', created_at = '$created_at' WHERE id_team_user = $id_team_user";
  $result = mysqli_query($con, $query);
  var_dump($query);
  if (!empty($result)) {
    echo "thành công";
  } else {
    echo "thất bại";
  }

  showPurchases(0);
}

function searchPurchase($text)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM manager_team_user WHERE name_team_user LIKE '%$text%' or user_status LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showPurchaseRow($seq_no, $row);
    }
  }
}
function searchStatus($number1)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM manager_team_user WHERE user_status = '$number1'";
    // $query = "SELECT * FROM manager_team_user WHERE user_status = '$user_status'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showPurchaseRow($seq_no, $row);
    }
  }
}

?>