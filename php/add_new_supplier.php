<?php
  require "db_connection.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if($con) {
      $name_team_sys = ucwords($_POST["name_team_sys"]);
      $type_sys = $_POST["type_sys"];
      $describe_sys = $_POST["describe_sys"];
      $file_des = $_FILES["file_des"]['name'];

      $name_team_sys = ucwords($_POST["name_team_sys"]);
      $type_sys = $_POST["type_sys"];
      $describe_sys = $_POST["describe_sys"];
      $create_by = $_POST["create_by"];

      if(!empty($_FILES["file_des"])){
        $file_des = basename($_FILES["file_des"]["name"]);
      
      // collect value of input field
        $check = False;

        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["file_des"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $query = "SELECT * FROM team_sys_manager WHERE UPPER(name_team_sys) = '".strtoupper($name_team_sys)."'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        if($row){
          $mess = "Nhóm hệ thống $name_team_sys đã tồn tại!";
          header("Location: ../add_supplier.php? mess=$mess", false);    
          exit();
        }
        else {
        // Check if file already exists
          if (file_exists($target_file)) {
            // alert("Sorry, file đã tồn tại.");
            $mess = "File đã tồn tại";
            header("Location: ../add_supplier.php? mess=$mess", false);
            exit();
            $uploadOk = 0;
          }
        
          // Check file file_des
          if ($_FILES["file_des"]["size"] > 5000000) {
            // alert("Kích thước file quá lớn");
            $mess = "kích thước file quá lớn";
            header("Location: ../add_supplier.php? mess=$mess", false);
            
            exit();
          }
        
        // Allow certain file formats
          if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "ppt"
          && $imageFileType != "xlsx" && $imageFileType != "docx" ) {
            // alert("Sorry, only pdf, ppt, doc & xlsx files are allowed.");
            $mess = "Sorry, chỉ upload file pdf, ppt, doc, xlsx";
            header("Location: ../add_supplier.php? mess=$mess", false);
            exit();
            $uploadOk = 0;
          }
        
        // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            // alert();
            $mess = "The file" . htmlspecialchars( basename( $_FILES["file_des"]["name"])) . "has been uploaded.";
            header("Location: ../add_supplier.php? mess=$mess", false); 
            exit();
          // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["file_des"]["tmp_name"], $target_file)) {

                $query = "INSERT INTO team_sys_manager (name_team_sys, type_sys, describe_sys, file_des) VALUES('$name_team_sys', '$type_sys', '$describe_sys', '$file_des')";
                $result = mysqli_query($con, $query);
                if(!empty($result)){
                  // alert("$name_team_sys added...");
                  header('Location: ../manage_supplier.php', true);
                  exit();
                }
                else{
                  header('Location: ../add_supplier.php', true);
                  // alert("Failed to add $name_team_sys!");
                  exit();
                }
              }
            }
          }
       }
  }
}
?>