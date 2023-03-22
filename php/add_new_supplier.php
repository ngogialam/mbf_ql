<?php
  require "db_connection.php";
  if($con) {
    $name_team_sys = ucwords($_GET["name_team_sys"]);
    $type_sys = $_GET["type_sys"];
    $describe_sys = $_GET["describe_sys"];
    $create_by = $_GET["create_by"];

    $query = "SELECT * FROM team_sys_manager WHERE UPPER(name_team_sys) = '".strtoupper($name_team_sys)."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "Nhóm hệ thống $name_team_sys đã tồn tại!";
    else {
      $query = "INSERT INTO team_sys_manager (name_team_sys, type_sys, describe_sys, create_by) VALUES('$name_team_sys', '$type_sys', '$describe_sys', '$create_by')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$name_team_sys added...";
  		else
  			echo "Failed to add $name_team_sys!";
    }
  }
?>
