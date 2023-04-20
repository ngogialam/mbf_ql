<?php
require "db_connection.php";
if ($con) {
    if (isset($_GET["action"]) && $_GET["action"] == "delete") {
        $id_device = $_GET["id_device"];
        try {
            $query1 = "DELETE FROM device WHERE id_device = $id_device";
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
        $id_device = $_GET["id_device"];
        showDevice($id_device);
    }

    if (isset($_GET["action"]) && $_GET["action"] == "update") {
        $id_device = $_GET["id_device"];
        $id_room = $_GET["id_room"];
        $name_owner = ucwords($_GET["name_owner"]);
        $name_tran = $_GET["name_tran"];
        $name_device = ucwords($_GET["name_device"]);
        $code_device = ucwords($_GET["code_device"]);
        $status_device = $_GET["status_device"];
        $created_at = $_GET["created_at"];
        updateDevice($id_device, $id_room, $name_owner, $name_tran, $name_device, $code_device, $status_device, $created_at);
    }

    if (isset($_GET["action"]) && $_GET["action"] == "cancel")
        showDevice(0);

    if (isset($_GET["action"]) && $_GET["action"] == "search")
        searchName(strtoupper($_GET["text"]));

    if (isset($_GET["action"]) && $_GET["action"] == "search1") {
        searchStatus(strtoupper($_GET["number1"]));
    }
    if (isset($_GET["action"]) && $_GET["action"] == "search2") {
        searchRoom(strtoupper($_GET["number2"]));
    }
    ///////
    // if (isset($_GET["action"]) && $_GET["action"] == "popup"){
    //   $ID = $_GET["ID"];
    // showUserPopup($ID);}
}

function searchStatus($number1)
{
    require "db_connection.php";
    if ($con) {
        $seq_no = 0;
        $query = "SELECT device.*, sys_room.name_room FROM device JOIN sys_room ON sys_room.id_room = device.id_room WHERE status_device = '$number1'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            $seq_no++;
            showDeviceRow($seq_no, $row);
        }
    }
}
function searchRoom($number2)
{
    require "db_connection.php";
    if ($con) {
        $seq_no = 0;
        $query = "SELECT device.*, sys_room.name_room FROM device JOIN sys_room ON sys_room.id_room = device.id_room WHERE device.id_room = '$number2'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            $seq_no++;
            showDeviceRow($seq_no, $row);
        }
    }
}
function showDevice($id_device)
{
    require "db_connection.php";
    if ($con) {
        $seq_no = 0;
        $query = "SELECT device.*, sys_room.name_room FROM device  JOIN sys_room ON sys_room.id_room = device.id_room";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            $seq_no++;
            if ($row['id_device'] == $id_device)
                showEditDevice($seq_no, $row);
            else
                showDeviceRow($seq_no, $row);
        }
    }
}

function showDeviceRow($seq_no, $row)
{
    ?>
    <tr>
        <td><?php echo $seq_no; ?></td>
        <!-- <td>
            <button type="button" class="button_popup" data-toggle="modal" data-target="#exampleModal" onclick="viewPopup(<?php echo $row['ID']; ?>);" value="<?php echo $row['ID']; ?>">
                <?php echo $row['name_user_manager']; ?>
            </button>
        </td> -->
        <td><?php echo $row['name_owner']; ?></td>
        <td><?php echo $row['name_tran']; ?></td>
        <td><?php echo $row['name_device']; ?></td>
        <td><?php echo $row['code_device']; ?></td>
        <td><?php echo $row['name_room'] ?></td>
        <!-- <td><?php echo $row['status_device']; ?></td> -->
        <td><?php if ($row['status_device'] == "0") {
                echo "Không dùng";
            } elseif ($row['status_device'] == "1") {
                echo "Đang sử dụng";
            } else {
                echo "Chuyển tiếp";
            } ?></td>
        <td><?php echo $row['created_at']; ?></td>
        <td>
            <button href="" class="btn btn-info btn-sm" onclick="editDecive(<?php echo $row['id_device']; ?>);">
                <i class="fa fa-pencil"></i>
            </button>
            <button class="btn btn-danger btn-sm" onclick="deleteUser(<?php echo $row['id_device']; ?>);">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
<?php
}

function showEditDevice($seq_no, $row)
{
?>
    <tr>
        <td><?php echo $seq_no; ?></td>


        <td>
            <input type="text" class="form-control" value="<?php echo $row['name_owner']; ?>" placeholder="Tên chủ sở hữu" id="name_owner" onblur="notNull(this.value, 'name_owner_err');">
            <code class="text-danger small font-weight-bold float-right" id=name_owner_err style="display: none;"></code>
        </td>
        <td>
            <input type="text" class="form-control" value="<?php echo $row['name_tran']; ?>" placeholder="Tên người chuyển" id="name_tran" onblur="notNull(this.value, 'name_tran_err');">
            <code class="text-danger small font-weight-bold float-right" id=name_tran_err style="display: none;"></code>
        </td>
        <td>
            <input type="text" class="form-control" value="<?php echo $row['name_device']; ?>" placeholder="Tên thiết bị" id="name_device" onblur="notNull(this.value, 'name_device_err');">
            <code class="text-danger small font-weight-bold float-right" id=name_device_err style="display: none;"></code>
        </td>
        <td>
            <input type="text" class="form-control" value="<?php echo $row['code_device']; ?>" placeholder="Mã thiết bị" id="code_device" onblur="notNull(this.value, 'code_device_err');">
            <code class="text-danger small font-weight-bold float-right" id=code_device_err style="display: none;"></code>
        </td>
        <td>
            <?php
            require "db_connection.php";
            if ($con) {
                $name_room = "";
                $query2 = "SELECT * FROM sys_room";
                $result2 = mysqli_query($con, $query2);

                echo '<select name="name_room" id="id_room" class=" form-control pdm chosen-select col col-md-12" >';
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $id_room = $row2['id_room'];
                    $name_room = $row2['name_room'];
                    if ($id_room == $id_room) {
                        echo "<option value= '$id_room' selected='selected'>$name_room</option>";
                    } else
                        echo "<option value= '$id_room' >$name_room</option>";
                }
                echo '</select>';
            }
            ?>
        </td>
        <td>
            <select id="status_device" class="form-control">
                <option value="1" <?php if ($row['status_device'] == "1") echo "selected" ?>>Đang sử dụng</option>
                <option value="0" <?php if ($row['status_device'] == "0") echo "selected" ?>>Không dùng</option>
                <option value="2" <?php if ($row['status_device'] == "2") echo "selected" ?>>Chuyển tiếp</option>
            </select>
        </td>
        <td>
            <input type="date" class="datepicker form-control hasDatepicker" value="<?php echo $row['created_at']; ?>" placeholder="Thời gian tạo" id="created_at" onblur="checkDate(this.value, 'created_at_err');">
            <code class="text-danger small font-weight-bold float-right" id="created_at_err" style="display: none;"></code>
        </td>
        <td>
            <button href="" class="btn btn-success btn-sm" onclick="updateDevice(<?php echo $row['id_device']; ?>);">
                <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm" onclick="cancel();">
                <i class="fa fa-close"></i>
            </button>
        </td>
    </tr>
<?php
}

function  updateDevice($id_device, $id_room, $name_owner, $name_tran, $name_device, $code_device, $status_device, $created_at)
{
    require "db_connection.php";
    $query = "UPDATE device SET id_room = '$id_room', name_owner = '$name_owner', name_tran = '$name_tran', name_device = '$name_device', code_device = '$code_device', status_device = '$status_device', created_at = '$created_at' WHERE id_device = $id_device";
    $result = mysqli_query($con, $query);

    if (!empty($result)) {
        echo "<td colspan='10'><div id='medicine_acknowledgement' class='col-md-12 h5 text-success font-weight-bold text-center' style='font-family: sans-serif;'>Cập nhật thành  người sử dụng :$name_owner </div></td>";
    } else {
        echo "<td colspan='10'><div id='medicine_acknowledgement' class='col-md-12 h5 text-success font-weight-bold text-center' style='font-family: sans-serif;'>Cập nhật không thành  người sử dụng :$name_owner </div></td>";
    }
    showDevice(0);
}
function show_alert($message, $is_success)
{
    echo '<script>
          document.getElementById("alert-message").innerHTML = "' . $message . '";
          document.getElementById("alert-box").style.display = "block";
          document.getElementById("alert-box").classList.add("' . ($is_success ? "alert-success" : "alert-danger") . '");
          
          setTimeout(function(){
              document.getElementById("alert-box").style.display = "none";
              document.getElementById("alert-box").classList.remove("alert-success", "alert-danger");
          }, 5000);
      </script>';
}
function searchName($text)
{
    require "db_connection.php";
    if ($con) {
        $seq_no = 0;
        $query = "SELECT device.*, sys_room.name_room FROM device JOIN sys_room ON sys_room.id_room = device.id_room WHERE name_owner LIKE '%$text%' OR name_tran LIKE '%$text%'";
        var_dump($query);
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            $seq_no++;
            showDeviceRow($seq_no, $row);
        }
    }
}

?>