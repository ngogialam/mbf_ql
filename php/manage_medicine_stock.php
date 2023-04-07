<?php
require "db_connection.php";

if ($con) {
  if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id_unit_user = $_GET["id"];
    try{
      $query1 = "DELETE FROM unit_user WHERE id_unit_user = $id_unit_user";
      $result1 = mysqli_query($con, $query1);
      if (!empty($result1))
        showMedicinesStock("0");
    } catch (Exception $e){
      ?>
        <td colspan="10"><div id="medicine_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;">Không xoá được</div></td> 
      <?php
      showMedicinesStock("0");
    }
  }

  if (isset($_GET["action"]) && $_GET["action"] == "edit") {
    $id_unit_user = $_GET["id_unit_user"];
    showMedicinesStock($id_unit_user);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "update") {
    $id_unit_user = $_GET["id_unit_user"];
    $name_unit_user =  ucwords($_GET["name_unit_user"]);
    $name_room_unit = ucwords($_GET["name_room_unit"]);
    $create_by = ucwords($_GET["create_by"]);
    $created_at = $_GET["created_at"];
    updateMedicineStock($id_unit_user, $name_unit_user, $name_room_unit, $create_by, $created_at);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "cancel")
    showMedicinesStock("0");

  if (isset($_GET["action"]) && $_GET["action"] == "search")
    searchMedicineStock(strtoupper($_GET["text"]), $_GET["tag"]);
}

function showMedicinesStock($id_unit_user)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    if (isset($_POST['results_per_page_user'])) {
      $results_per_page_user = $_POST['results_per_page_user'];
    } else {
      $results_per_page_user = 10;
    }
    $sql = "SELECT COUNT(*) FROM unit_user";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);
    $total_results_user = $row[0];
    $total_pages_user = ceil($total_results_user / $results_per_page_user);

    // Xác định trang hiện tại và bản ghi bắt đầu và kết thúc trong truy vấn
    if (!isset($_GET['page_user'])) {
      $page_user = 1;
    } else {
      $page_user = $_GET['page_user'];
    }
    $start_limit = ($page_user - 1) * $results_per_page_user;
    $end_limit = $results_per_page_user;

    // Thực hiện truy vấn để lấy dữ liệu trong khoảng thời gian được chỉ định
    $sql = "SELECT * FROM unit_user LIMIT $start_limit, $end_limit";
    $result = mysqli_query($con, $sql);
    // fill dữ liệu 
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      if ($row['id_unit_user'] == $id_unit_user)
        showEditOptionsRow($seq_no, $row);
      else
        showMedicineStockRow($seq_no, $row);
    }
    for ($page_user = 1; $page_user <= $total_pages_user; $page_user++) {
      echo '<div class="pagination"><a  href="manage_medicine_stock.php?page_user=' . $page_user . '&results_per_page_user=' . $results_per_page_user . '">' . $page_user . '</a> </div>';
    }
  }
}
// function showMedicinesStock($id_unit_user) {
//   require "db_connection.php";
//   if($con) {
//     $seq_no = 0;
//     $query = "SELECT * FROM unit_user";
//     $result = mysqli_query($con, $query);
//     while($row = mysqli_fetch_array($result)) {
//       $seq_no++;
//       if($row['id_unit_user'] == $id_unit_user)
//       showEditOptionsRow($seq_no, $row);
//       else
//       showMedicineStockRow($seq_no, $row);
//     }
//   }
// }

function showMedicineStockRow($seq_no, $row)
{
?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['name_unit_user']; ?></td>
    <td><?php echo $row['name_room_unit']; ?></td>
    <td><?php echo $row['create_by']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
    <td>
      <button href="" class="btn btn-info btn-sm" onclick="editMedicineStock('<?php echo $row['id_unit_user']; ?>');">
        <i class="fa fa-pencil"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="deleteMedicineStock(<?php echo $row['id_unit_user']; ?>);">
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
      <input type="text" class="form-control" value="<?php echo $row['name_unit_user']; ?>" placeholder="Tên..." id="name_unit_user" onblur="notNull(this.value, 'name_unit_user_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_unit_user_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['name_room_unit']; ?>" placeholder="Phòng" id="name_room_unit" onblur="notNull(this.value, 'name_room_unit_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_room_unit_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['create_by']; ?>" placeholder="Người tạo" id="create_by" onkeyup="notNull(this.value, 'create_by_error');">
      <code class="text-danger small font-weight-bold float-right" id="create_by_error" style="display: none;"></code>
    </td>
    <td>
      <input type="date" class="datepicker form-control hasDatepicker" value="<?php echo $row['created_at']; ?>" placeholder="Thời gian tạo" id="created_at" onblur="checkDate(this.value, 'created_at_error');">
      <code class="text-danger small font-weight-bold float-right" id="created_at_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateMedicineStock(<?php echo $row['id_unit_user']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
<?php
}

function updateMedicineStock($id_unit_user, $name_unit_user, $name_room_unit, $create_by, $created_at)
{
  var_dump($name_unit_user);
  var_dump($name_room_unit);
  require "db_connection.php";
  $query = "UPDATE unit_user SET name_unit_user = '$name_unit_user', name_room_unit = '$name_room_unit', create_by = '$create_by', created_at= '$created_at' WHERE id_unit_user = $id_unit_user";  
  $result = mysqli_query($con, $query);
  if (!empty($result))
    // showMedicinesStock("0");
    echo "thành công";
  else
    echo "thất bại";
}

function searchMedicineStock($text, $column)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;

    if ($column == "EXPIRY_DATE")
      $query = "SELECT * FROM medicines INNER JOIN medicines_stock ON medicines.NAME = medicines_stock.NAME";
    else if ($column == 'QUANTITY')
      $query = "SELECT * FROM medicines INNER JOIN medicines_stock ON medicines.NAME = medicines_stock.NAME WHERE medicines_stock.$column = 0";
    else
      $query = "SELECT * FROM medicines INNER JOIN medicines_stock ON medicines.NAME = medicines_stock.NAME WHERE UPPER(medicines.$column) LIKE '%$text%'";

    $result = mysqli_query($con, $query);

    if ($column == 'EXPIRY_DATE') {
      while ($row = mysqli_fetch_array($result)) {
        $expiry_date = $row['EXPIRY_DATE'];
        if (substr($expiry_date, 3) < date('y'))
          showMedicineStockRow($seq_no, $row);
        else if (substr($expiry_date, 3) == date('y')) {
          if (substr($expiry_date, 0, 2) < date('m'))
            showMedicineStockRow($seq_no, $row);
        }
      }
    } else {
      while ($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showMedicineStockRow($seq_no, $row);
      }
    }
  }
}

?>