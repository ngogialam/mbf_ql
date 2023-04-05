<?php
  require "db_connection.php";
  if($con) {
    $name_unit_user = strtoupper($_GET["name_unit_user"]);
    $name_room_unit = ucwords($_GET["name_room_unit"]);
    $create_by = $_GET["create_by"];

    $query = "SELECT * FROM unit_user WHERE UPPER(name_unit_user) = '".strtoupper($name_unit_user)."' AND UPPER(name_room_unit) = '".strtoupper($name_room_unit)."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "Đơn vị quản lý $name_unit_user với phòng ban $name_room_unit đã tồn tại!";
    else {
      $query = "INSERT INTO unit_user (name_unit_user, name_room_unit, create_by) VALUES('$name_unit_user', '$name_room_unit', '$create_by')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "Đơn vị quản lý $name_unit_user đã được thêm vào...";
  		else
  			echo "Thêm đơn vị quản lý không thành công!";
    }
  }
?>
