<?php

  if(isset($_GET['action']) && $_GET['action'] == 'is_setup_done')
    isSetupDone();

  // function isSetupDone() {
  //   require "db_connection.php";
  //   if($con) {
  //     $query = "SELECT * FROM admin_credentials";
  //     $result = mysqli_query($con, $query);
  //     $row = mysqli_fetch_array($result);
  //     echo ($row) ? "true" : "false";
  //   }
  // }
  function isSetupDone() {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM manager_user";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'is_admin')
    isAdmin();

  function isAdmin() {
    require "db_connection.php";
    if($con) {
      $username = $_GET["uname"];
      $password = $_GET["pswd"];

      $query = "SELECT * FROM admin_credentials WHERE USERNAME_USER = '$username' AND PASSWORD_1 = '$password'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      if($row)  {
        $query = "UPDATE admin_credentials SET IS_LOGGED_IN = 'true'";
        $result = mysqli_query($con, $query);
        echo "true";
      }
      else
        echo "false";
    }
  }
  // function isAdmin() {
  //   require "db_connection.php";
  //   if($con) {
  //     $gmail = $_GET["gmail"];
  //     $password = $_GET["pswd"];

  //     $query = "SELECT * FROM manager_user WHERE gmail = '$gmail' AND password = '$password'";
  //     $result = mysqli_query($con, $query);
  //     $row = mysqli_fetch_array($result);
  //     if($row)  {
  //       $query = "UPDATE manager_user SET IS_LOGGED_IN = 'true'";
  //       $result = mysqli_query($con, $query);
  //       echo "true";
  //     }
  //     else
  //       echo "false";
  //   }
  // }

  if(isset($_GET['action']) && $_GET['action'] == 'store_admin_info')
    storeAdminData();

  function storeAdminData() {
    require "db_connection.php";
    if($con) {
      $pharmacy_name = $_GET["pharmacy_name"];
      $address = $_GET["address"];
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];
      $username = $_GET["username"];
      $password = $_GET["password"];

      $query = "INSERT INTO admin_credentials (PHARMACY_NAME, ADDRESS, EMAIL, CONTACT_NUMBER, USERNAME, PASSWORD, IS_LOGGED_IN) VALUES('$pharmacy_name', '$address', '$email', '$contact_number', '$username', '$password', 'false')";
      $result = mysqli_query($con, $query);
      echo ($result) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'verify_email_number')
    verifyEmailNumber();

  function verifyEmailNumber() {
    require "db_connection.php";
    if($con) {
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];

      $query = "SELECT * FROM admin_credentials WHERE EMAIL = '$email' AND CONTACT_NUMBER = '$contact_number'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'update_username_password')
    updateUsernamePassword();

  function updateUsernamePassword() {
    require "db_connection.php";
    if($con) {
      $username = $_GET["username"];
      $password = $_GET["password"];
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];

      $query = "UPDATE admin_credentials SET USERNAME = '$username', PASSWORD = '$password' WHERE EMAIL = '$email' AND CONTACT_NUMBER = '$contact_number'";
      $result = mysqli_query($con, $query);
      echo ($result) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'validate_password')
    validatePassword();

  function validatePassword() {
    require "db_connection.php";
    if($con) {
      $password = $_GET["pswd"];

      $query = "SELECT * FROM admin_credentials WHERE PASSWORD = '$password'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'update_admin_info'){
  $ID = $_GET["ID"]; 
  $USERNAME_USER = ucwords($_GET["USERNAME_USER"]);
  $CONTACT_NUMBER = $_GET["CONTACT_NUMBER"];
  $EMAIL = ucwords($_GET["EMAIL"]);  
  $created_at = $_GET["created_at"]; 
  updateAdminInfo($ID, $USERNAME_USER, $CONTACT_NUMBER, $EMAIL,$created_at);
  }
  function updateAdminInfo($ID, $USERNAME_USER, $CONTACT_NUMBER, $EMAIL,$created_at) {
    require "db_connection.php";
  $query = "UPDATE admin_credentials SET USERNAME_USER = '$USERNAME_USER', CONTACT_NUMBER = '$CONTACT_NUMBER', EMAIL = '$EMAIL', created_at = '$created_at' WHERE ID = $ID";
  $result = mysqli_query($con, $query);
  if (!empty($result)) {
    echo "<td colspan='10'><div id='medicine_acknowledgement' class='col-md-12 h5 text-success font-weight-bold text-center' style='font-family: sans-serif;'>Cập nhật thành  người sử dụng :$USERNAME_USER </div></td>";
  } else {
    echo "<td colspan='10'><div id='medicine_acknowledgement' class='col-md-12 h5 text-success font-weight-bold text-center' style='font-family: sans-serif;'>Cập nhật không thành  người sử dụng :$USERNAME_USER </div></td>";
  }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'change_password')
    changePassword();

  function changePassword() {
    require "db_connection.php";
    if($con) {
      $password = $_GET["pswd"];

      $query = "UPDATE admin_credentials SET PASSWORD = '$password'";
      $result = mysqli_query($con, $query);
      echo ($result) ? "Password changed..." : "Oops! Somthing wrong happend...";
    }
  }

 ?>
