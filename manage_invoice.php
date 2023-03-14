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
  <!-- including side navigations -->
  <?php include("sections/sidenav.html"); ?>

  <div class="container-fluid" style="margin-right: 0px;">
    <div class="container">

          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Tìm kiếm :&emsp;</label>
            <input type="number" class="form-control" id="by_invoice_number" placeholder="tên hệ thống" onkeyup="searchInvoice(this.value, 'INVOICE_ID');">
            &emsp;<input type="text" class="form-control" id="by_customer_name" placeholder="Người quản trị" onkeyup="searchInvoice(this.value, 'NAME');">
            &emsp;<label class="font-weight-bold" for="">Ngày tạo :&emsp;</label>
            <!-- <input type="text" class="form-control" id="by_customer_name" placeholder="By Customer Name" onkeyup="searchInvoice(this.value, 'NAME');">
            &emsp;<label class="font-weight-bold" for="">By Invoice Date :&emsp;</label>
            <input type="date" class="form-control" id="by_date" onchange="searchInvoice(this.value, 'INVOICE_DATE');">
            &emsp; -->
          <button class="btn btn-success font-weight-bold" onclick="refresh();"><i class="fa fa-refresh"></i></button>
        </div>

        <div class="col col-md-12">
          <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
        </div>


        <div class="col col-md-12 table-responsive">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>SL.</th>
                  <th>ID hệ thống</th>
                  <th>Tên nhóm hệ thống </th>
                  <th>Tên hệ thống </th>
                  <th>Đầug số</th>
                  <th>Tên đơn vị quản lý</th>
                  <th>Tên người quản lý</th>
                  <th>Mô tả hệ thống</th>
                  <th>Tài liệu hệ thống</th>
                  <th>IP hệ thống</th>
                  <th>Server hệ thống</th>
                  <th>Cấu hình hệ thống</th>
                  <th>Thời gian tạo</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="invoices_div">
                <?php
                require 'php/manage_invoice.php';
                showInvoices();
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal modalCloseReload" id="modalAddMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg" style="witdh: 100%;">
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
                <button type="button" style="background:#FFC0CB;" class="btn btn-default d-none" id="test"
                  data-toggle="modal" data-target="#modalAdd" onclick="editAccount()">Cập nhật đối tác cho tài
                  khoản</button>
                <button id="hide_div" type="button" style="background:#FF9900;"
                  class="btn btn-success btn-ok saveMenus btnAddMenu" onclick="addAccount()">Thêm mới tài khoản</button>
              </div>
            </div>
          </div>
        </div>
      <!-- edit cho ng dùng -->
      <div class="modal modalCloseReload" id="editfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg" style="witdh: 100%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="form-group row">
                <label for="email_address" class="col-md-4 col-form-label text-md-right">test tính năng</label>
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
                <button type="button" style="background:#FFC0CB;" class="btn btn-default d-none" id="test"
                  data-toggle="modal" data-target="#modalAdd" onclick="editAccount()">Cập nhật đối tác cho tài
                  khoản</button>
                <button id="hide_div" type="button" style="background:#FF9900;"
                  class="btn btn-success btn-ok saveMenus btnAddMenu" onclick="addAccount()">Thêm mới tài khoản</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- form content end -->
      <hr style="border-top: 2px solid #ff5252;">
    </div>
  </div>
</body>

</html>