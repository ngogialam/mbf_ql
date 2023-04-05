<?php
  require "db_connection.php";
  if($con) {
    $name_unit_sys = strtoupper($_GET["name_unit_sys"]);
    $name_room = ucwords($_GET["name_room"]);
    $create_by = $_GET["create_by"];

    $query = "SELECT * FROM unit_sys WHERE UPPER(name_unit_sys) = '".strtoupper($name_unit_sys)."' AND UPPER(name_room) = '".strtoupper($name_room)."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "Đơn vị quản lý $name_unit_sys với phòng ban $name_room đã tồn tại!";
    else {
      $query = "INSERT INTO unit_sys (name_unit_sys, name_room, create_by) VALUES('$name_unit_sys', '$name_room', '$create_by')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "Đơn vị quản lý $name_unit_sys đã được thêm vào...";
  		else
  			echo "Thêm đơn vị quản lý không thành công!";
    }
  }
?>
