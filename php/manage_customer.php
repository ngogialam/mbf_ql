<?php
require "db_connection.php";

if ($con) {
  if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id_user_manager = $_GET["id_user_manager"];
    try{
      $query1 = "DELETE FROM user_manager WHERE id_user_manager = $id_user_manager";
      $result1 = mysqli_query($con, $query1);
      if (!empty($result1))
        showCustomers(0);
    } catch (Exception $e){
      ?>
        <td colspan="10"><div id="medicine_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;">Không xoá được, do người quản trị đang sử dụng hệ thống được lưu trong cơ sở dữ liệu</div></td> 
      <?php
      showCustomers(0);
    }

  }

  if (isset($_GET["action"]) && $_GET["action"] == "edit") {
    $id_user_manager = $_GET["id_user_manager"];
    showCustomers($id_user_manager);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "update") {
    $id_user_manager = $_GET["id_user_manager"];
    $name_user_manager = ucwords($_GET["name_user_manager"]);
    $sdt = $_GET["sdt"];
    $gmail = ucwords($_GET["gmail"]);
    $room = ucwords($_GET["room"]);
    $position_manager = ucwords($_GET["position_manager"]);
    $create_by = $_GET["create_by"];
    updateCustomer($id_user_manager, $name_user_manager, $sdt, $gmail, $room, $position_manager, $create_by);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "cancel")
    showCustomers(0);

  if (isset($_GET["action"]) && $_GET["action"] == "search")
    searchCustomer(strtoupper($_GET["text"]));
}

// function showCustomers($id) {
//   require "db_connection.php";
//   if($con) {
//     $seq_no = 0;
//     $query = "SELECT * FROM user_manager";
//     $result = mysqli_query($con, $query);
//     while($row = mysqli_fetch_array($result)) {
//       $seq_no++;
//       if($row['id_user_manager'] == $id)
//         showEditOptionsRow($seq_no, $row);
//       else
//         showCustomerRow($seq_no, $row);
//     }
//   }
// }
function showCustomers($id_user_manager)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    if (isset($_POST['results_per_page'])) {
      $results_per_page = $_POST['results_per_page'];
    } else {
      $results_per_page = 10;
    }
    $sql = "SELECT COUNT(*) FROM user_manager";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);
    $total_results = $row[0];
    $total_pages = ceil($total_results / $results_per_page);

    // Xác định trang hiện tại và bản ghi bắt đầu và kết thúc trong truy vấn
    if (!isset($_GET['page'])) {
      $page = 1;
    } else {
      $page = $_GET['page'];
    }
    $start_limit = ($page - 1) * $results_per_page;
    $end_limit = $results_per_page;

    // Thực hiện truy vấn để lấy dữ liệu trong khoảng thời gian được chỉ định
    $sql = "SELECT * FROM user_manager LIMIT $start_limit, $end_limit";
    $result = mysqli_query($con, $sql);
    // fill dữ liệu 
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      if ($row['id_user_manager'] == $id_user_manager)
        showEditOptionsRow($seq_no, $row);
      else
        showCustomerRow($seq_no, $row);
    }
    for ($page = 1; $page <= $total_pages; $page++) {
      echo '<div class="pagination"><a  href="manage_customer.php?page=' . $page . '&results_per_page=' . $results_per_page . '">' . $page . '</a> </div>';
    }
  }
}

function showCustomerRow($seq_no, $row)
{
?>
  <tr>
    <td>
      <?php echo $seq_no; ?>
    </td>
    <td>
      <?php echo $row['id_user_manager'] ?>
    </td>
    <td>
      <?php echo $row['name_user_manager']; ?>
    </td>
    <td>
      <?php echo $row['sdt']; ?>
    </td>
    <td>
      <?php echo $row['gmail']; ?>
    </td>
    <td>
      <?php echo $row['room']; ?>
    </td>
    <td>
      <?php echo $row['position_manager']; ?>
    </td>
    <td>
      <?php echo $row['create_by']; ?>
    </td>
    <td>
      <?php echo $row['created_at']; ?>
    </td>
    <td>
      <button href="" class="btn btn-info btn-sm" onclick="editCustomer(<?php echo $row['id_user_manager']; ?>);">       
        <i class="fa fa-pencil"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="deleteCustomer(<?php echo $row['id_user_manager']; ?>);">
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
    <td>
      <?php echo $seq_no; ?>
    </td>
    <td>
      <?php echo $row['id_user_manager'] ?>
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
      <input type="text" class="form-control" value="<?php echo $row['room']; ?>" placeholder="phòng ban" id="room" onkeyup="validateName(this.value, 'room_err');">
      <code class="text-danger small font-weight-bold float-right" id="room_err" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="Chức vụ" id="position_manager" onblur="validateAddress(this.value, 'position_manager_err');"><?php echo $row['position_manager']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="position_manager_err" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="người tạo" id="create_by" onblur="validateName(this.value, 'create_by_err');"><?php echo $row['create_by']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="create_by_err" style="display: none;"></code>
    </td>
    <td>
      <?php echo $row['created_at'] ?>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateCustomer(<?php echo $row['id_user_manager']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
<?php
}

function updateCustomer($id_user_manager, $name_user_manager, $sdt, $gmail, $room, $position_manager, $create_by)
{
  require "db_connection.php";
  $query = "UPDATE user_manager SET name_user_manager = '$name_user_manager', sdt = '$sdt', gmail = '$gmail', room = '$room', position_manager = '$position_manager', create_by = '$create_by' WHERE id_user_manager = $id_user_manager";
  $result = mysqli_query($con, $query);
  // if (!empty($result))  
  //   showCustomers(0);  
  if (!empty($result))
    echo '<div id="myDiv">
    <h6> Cập nhật thành công !</h6>    
    </div>';
    showCustomers(0);  
}

function searchCustomer($text)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM customers WHERE UPPER(NAME) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showCustomerRow($seq_no, $row);
    }
  }
}
?>