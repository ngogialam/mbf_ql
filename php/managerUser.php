<?php
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "DELETE FROM purchases WHERE VOUCHER_NUMBER = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
    		showUser(0);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showUser($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $suppliers_name = ucwords($_GET["suppliers_name"]);
      $invoice_date = $_GET["invoice_date"];
      $grand_total = $_GET["grand_total"];
      $payment_status = $_GET["payment_status"];
      updatePurchase($id, $suppliers_name, $invoice_date, $grand_total, $payment_status);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
    showUser(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchPurchase(strtoupper($_GET["text"]), $_GET["tag"]);
  }

  function showUser($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM manager_user";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['id_user'] == $id)
        showEditUserRow($seq_no, $row);
        else
          showUserRow($seq_no, $row);
      }
    }
  }

  function showUserRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['id_team_user']; ?></td>
      <td><?php echo $row['name_user_manager'] ?></td>
      <td><?php echo $row['sdt']; ?></td>
      <td><?php echo $row['gmail']; ?></td>
      <td><?php echo $row['room']; ?></td>
      <td><?php echo $row['positon_manager']; ?></td>
      <td><?php echo $row['create_by']; ?></td>
      <td>
        <!--
        <button class="btn btn-warning btn-sm" onclick="printPurchase(<?php echo $row['VOUCHER_NUMBER']; ?>);">
          <i class="fa fa-fax"></i>
        </button>
      -->
        <button href="" class="btn btn-info btn-sm" onclick="editUser(<?php echo $row['id_user']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteUser(<?php echo $row['id_user']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    </tr>
    <?php
  }

function showEditUserRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['VOUCHER_NUMBER'] ?></td>
    <td>
      <input id="suppliers_name" type="text" class="form-control" value="<?php echo $row['SUPPLIER_NAME']; ?>" placeholder="Supplier Name" name="suppliers_name" onkeyup="showSuggestions(this.value, 'supplier');" disabled>
      <!--<code class="text-danger small font-weight-bold float-right" id="supplier_name_error" style="display: none;"></code>
      <div id="supplier_suggestions" class="list-group position-fixed" style="z-index: 1; width: 25.10%; overflow: auto; max-height: 200px;"></div>-->
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['INVOICE_NUMBER']; ?>" id="invoice_number" disabled>
    </td>
    <td>
      <input type="date" class="datepicker form-control hasDatepicker" id="invoice_date" name="invoice_date" value='<?php echo $row['PURCHASE_DATE'] ?>' onblur="checkDate(this.value, 'date_error');">
      <code class="text-danger small font-weight-bold float-right" id="date_error" style="display: none;"></code>
    </td>
    <td><input type="text" class="form-control" value="<?php echo $row['TOTAL_AMOUNT']; ?>" id="grand_total" name="grand_total" disabled></td>
    <td>
      <select id="payment_status" class="form-control">
        <option value="DUE" <?php if($row['PAYMENT_STATUS'] == "DUE") echo "selected" ?>>DUE</option>
        <option value="PAID" <?php if($row['PAYMENT_STATUS'] == "PAID") echo "selected" ?>>PAID</option>
      </select>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updatePurchase(<?php echo $row['VOUCHER_NUMBER']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updatePurchase($id, $suppliers_name, $invoice_date, $grand_total, $payment_status) {
  require "db_connection.php";
  //echo $payment_status;
  $query = "UPDATE purchases SET SUPPLIER_NAME = '$suppliers_name', PURCHASE_DATE = '$invoice_date', TOTAL_AMOUNT = $grand_total, PAYMENT_STATUS = '$payment_status' WHERE VOUCHER_NUMBER = $id";
  $result = mysqli_query($con, $query);
  if(!empty($result))
  showUser(0);
}

function searchPurchase($text, $column) {
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM manager_user WHERE $column LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showUserRow($seq_no, $row);
    }
  }
}

?>
