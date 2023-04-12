<?php
 require "db_connection.php";
 if($con) {
   $USERNAME = ucwords($_GET["USERNAME"]);
   $CONTACT_NUMBER = $_GET["CONTACT_NUMBER"];
   $EMAIL = ucwords($_GET["EMAIL"]);
   $room = ucwords($_GET["room"]);
   $manager_team_user = $_GET['manager_team_user'];
   $position_manager = ucwords($_GET["position_manager"]);
   $create_by = ucwords($_GET["create_by"]);
   $PASSWORD_1 = ucwords($_GET["PASSWORD_1"]);

   $query = "SELECT * FROM admin_credentials WHERE CONTACT_NUMBER = '$CONTACT_NUMBER'";
   $result = mysqli_query($con, $query);
   $row = mysqli_fetch_array($result);
   if($row)
     echo "admin_credentials ".$row['USERNAME']." with contact number $CONTACT_NUMBER already exists!";
   else {
     $query = "INSERT INTO admin_credentials (USERNAME, id_team_user, CONTACT_NUMBER, EMAIL, room,  position_manager, create_by, PASSWORD_1) VALUES('$USERNAME', '$manager_team_user', '$CONTACT_NUMBER', '$EMAIL', '$room', '$position_manager', '$create_by', '$PASSWORD_1')";
     var_dump( $query);
     $result = mysqli_query($con, $query);
     if(!empty($result))
       echo "$USERNAME added...";
     else
       echo "Failed to add $USERNAME!";
   }
 }
?>