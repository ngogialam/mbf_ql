<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Danh sách hệ thống</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/manage_invoice.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
   <h3>hhhhhhhhhhhhhhhhhhhhhhhhhhhhh</h3>
   <!-- Button trigger modal -->

   <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">Extra large modal</button>

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <h3>hhhhhhhhhhhhhhhhhhhhhhhhhhhhh</h3>
    <p>ủuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu</p>
    </div>
  </div>
</div>

   <button type="button" style="background:#FF9900;" class="btn btn-success btn-icon-text" data-toggle="modal" data-target="#modalAddMenu"><i class="mdi mdi-plus-circle"></i>
                                    Thêm mới tài khoản</button>



<div class="modal modalCloseReload" id="modalAddMenu"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                
            </div>
            <div class="form-group row">
                <label for="email_address" class="col-md-4 col-form-label text-md-right">Đối tác</label>
                <div class="col-md-6">
                    <select class="form-control pdm chosen-select" id="namePartner" name="namePartner">
                        <!-- <option>Chọn đối tác </option> -->
                        <?php foreach ($listPartner as $key => $partner) { ?>
                            <option value="<?= $partner->id ?>"> <?= $partner->name ?> </option>
                        <?php } ?>
                    </select>
                    <span class="error_text errNamePartner"></span>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Tài khoản </label>
                <div class="col-md-6">

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
                <button type="button" style="background:#FFC0CB;" class="btn btn-default d-none" id="test" data-toggle="modal" data-target="#modalAdd" onclick="editAccount()">Cập nhật đối tác cho tài khoản</button>
                <button id="hide_div" type="button" style="background:#FF9900;" class="btn btn-success btn-ok saveMenus btnAddMenu" onclick="addAccount()">Thêm mới tài khoản</button>
            </div>
        </div>
    </div>
</div>
  </body>
</html>
