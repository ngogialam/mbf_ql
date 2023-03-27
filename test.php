<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Danh sách hệ thống</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/manage_invoice.js"></script>
    <script src="js/restrict.js"></script>
</head>

<body>

    <!-- Button trigger modal -->
    <a class="btn btn-success" href="php/export.php">Xuất file Excel</a>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">Extra large
        modal</button>
    </hr>
    <h3>----------------------------------------------------------------------------------</h3>
    </br>

    <div class="col-md-12">
        <a href="uploads/demo.xlsx" class="btn btn-primary"> Tải mẫu file về</a>
        </hr>
        <?php
        require "php/db_connection.php";
        require "php/PHPExcel.php";

        if (isset($_POST['submit'])) {
            $file = $_FILES['file']['tmp_name'];
            $objReader = PHPExcel_IOFactory::createReaderForFile($file);
            $objReader->setLoadSheetsOnly('Danh_sach_quan_tri');
            $objExcel = $objReader->load($file);
            $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);
            // print_r($sheetData);
            $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
            // echo $highestRow;
            for ($row = 2; $row <= $highestRow; $row++) {
                $name_user_manager = $sheetData[$row]['A'];
                $sdt = $sheetData[$row]['B'];
                $gmail = $sheetData[$row]['C'];
                $room = $sheetData[$row]['D'];
                $position_manager = $sheetData[$row]['E'];
                $create_by = $sheetData[$row]['F'];
                $query = "INSERT INTO user_manager(name_user_manager,sdt,gmail,room,position_manager,create_by) VALUES ('$name_user_manager',$sdt,'$gmail','$room','$position_manager','$create_by')";
                $result = mysqli_query($con, $query);
            }
            if (!empty($result))
                echo "Nhập dữ liệu thành công";
            else
                echo "Không thành công!";
        }


        // }
        ?>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file"><br><br>
            <input type="submit" value="submit" name="submit">
        </form>
        <!-- <form  method="POST" enctype="multipart/form-data">
            <label for=""> Chọn file Import </label>
            <input type="file" name="file"></input>
            <button type="submit" class="btn btn-primary" name="btnGui">Import</button>
        </form> -->
    </div>
</body>

<input id="selectedUserId" type="hidden">
<input id="editMapperId" type="hidden">
<input id="isShowDropdown" type="hidden">
<input id="isShowClick" type="hidden">

<input type="text" name="phoneUser" id="phoneUser" class="form-control" autocomplete="off">
<span style="font-weight: bold; font-size: 15px;" class="error_text errCheck"></span>

<span class="error_text errPhoneName"></span>
</div>
</div>
<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">Tên tài khoản </label>
    <div class="col-md-6">
        <div id="result" style="margin-top:15px;">

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
    <button type="button" style="background:#FFC0CB;" class="btn btn-default d-none" id="test" data-toggle="modal"
        data-target="#modalAdd" onclick="editAccount()">Cập nhật đối tác cho tài khoản</button>
    <button id="hide_div" type="button" style="background:#FF9900;" class="btn btn-success btn-ok saveMenus btnAddMenu"
        onclick="addAccount()">Thêm mới tài khoản</button>
</div>
</div>
</div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadfile">Upload file</button>

<?php
function getDirContents($dir, $filter = '', &$results = array())
{
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);

        if (!is_dir($path)) {
            if (empty($filter) || preg_match($filter, $path))
                $results[] = $path;
        } elseif ($value != "." && $value != "..") {
            getDirContents($path, $filter, $results);
        }
    }

    return $results;

    function read($file)
    {
        header("Content-type: application/pdf");

        header("Content-Length: " . filesize($file));

        // Send the file to the browser.
        readfile($file);
    }
}

// Simple Call: List all files
$files = getDirContents('uploads/')
    ?>
<table>
    <?php foreach ($files as $key => $value): ?>
        <tr>
            <td>
                <?php
                $info = pathinfo($value);
                ?>
            <td>
                <?= $key; ?> <a href="php/read.php?filename=<?php echo $value; ?>" formtarget="_blank"><?= $info['basename']; ?></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="modal fade bd-example-modal-xl" id="uploadfile" tabindex="-1" role="dialog" aria-labelledby="uploadfile"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="php/upload.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
        </div>
    </div>
</div>
</body>

</html>
<?php

// // The location of the PDF file
// // on the server
// $filename = "/path/to/the/file.pdf";

// // Header content type
// header("Content-type: application/pdf");

// header("Content-Length: " . filesize($filename));

// // Send the file to the browser.
// readfile($filename);
// ?>