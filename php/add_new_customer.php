<?php
  require "db_connection.php";
  if($con) {
    $name = ucwords($_GET["name_user_manager"]);
    $contact_number = $_GET["sdt"];
    $address = ucwords($_GET["gmail"]);
    $room = ucwords($_GET["room"]);
    $position = ucwords($_GET["position_manager"]);
    

    $query = "SELECT * FROM manager_user WHERE gmail = '$address'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "Customer ".$row['gmail']." with contact number $address already exists!";
    else {
      $query = "INSERT INTO manager_user (name_user_manager, sdt, gmail, room, position_manager) VALUES('$name', '$contact_number', '$address', '$room', '$position')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$name added...";
  		else
  			echo "Failed to add $name!";
    }
  }
?>
