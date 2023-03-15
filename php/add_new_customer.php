<?php
  require "db_connection.php";
  if($con) {
    $name_user_manager = ucwords($_GET["name_user_manager"]);
    $sdt = $_GET["sdt"];
    $gmail = ucwords($_GET["gmail"]);
    $room = ucwords($_GET["room"]);
    $position_manager = ucwords($_GET["position_manager"]);
    $create_by = $_GET["create_by"];

    $query = "SELECT * FROM user_manager WHERE sdt = '$sdt'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "user_manager ".$row['name_user_manager']." with contact number $sdt already exists!";
    else {
      $query = "INSERT INTO user_manager (name_user_manager, sdt, gmail, room, position_manager, create_by) VALUES('$name_user_manager', '$sdt', '$gmail', '$room', '$position_manager', '$create_by')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$name_user_manager added...";
  		else
  			echo "Failed to add $$name_user_manager!";
    }
  }
?>
