<?php
  require "db_connection.php";
  if($con) {
    $name = ucwords($_GET["name_team_sys"]);
    $type = $_GET["type"];
    $describe = $_GET["describe"];
    $create_by = ucwords($_GET["create_by"]);

    $query = "SELECT * FROM team_sys_ql WHERE UPPER(name_team_sys) = '".strtoupper($name)."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "Nhóm hệ thống $name đã tồn tại!";
    else {
      $query = "INSERT INTO team_sys_ql (name_team_sys, type, describe, create_by) VALUES('$name', '$type', '$describe', '$create_by')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$name added...";
  		else
  			echo "Failed to add $name!";
    }
  }
?>
