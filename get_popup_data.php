<?php
require "php/db_connection.php";
if ($con) {
    $ID = $_GET['ID'];
    $query = "SELECT admin_credentials.ID, admin_credentials.USERNAME_USER, manager_team_user.name_team_user, manager_team_user.user_status,manager_team_user.id_team_user, manager_team_user.create_by, manager_team_user.created_at FROM admin_credentials JOIN manager_team_user ON admin_credentials.id_team_user = manager_team_user.id_team_user WHERE admin_credentials.ID = '$ID'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    // Encode the fetched data as JSON and send it back to the client
    header('Content-Type: application/json');
    echo json_encode($row);
}
mysqli_close($con);
?>