function deleteSupplier(id) {
  var confirmation = confirm("Are you sure?");
  if(confirmation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('suppliers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_supplier.php?action=delete&id=" + id, true);
    xhttp.send();
  }
}
function viewItem(id_team_sys) {
  window.location.href = 'detail_team_sys.php?id_team_sys=' + id_team_sys;
}

function goBack() {
  window.location.href = 'manage_supplier.php';
}

function editSupplier(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('suppliers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_supplier.php?action=edit&id=" + id, true);
  xhttp.send();
}

function updateSupplier(id) {
  var supplier_name = document.getElementById("name_team_sys");
  var supplier_email = document.getElementById("type");
  var contact_number = document.getElementById("describe");
  var supplier_address = document.getElementById("create_by");
  // if(!validateName(supplier_name.value, "name_error"))
  //   supplier_name.focus();
  // else if(!validateContactNumber(contact_number.value, "contact_number_error"))
  //   contact_number.focus();
  // else if(!validateAddress(supplier_address.value, "address_error"))
  //   supplier_address.focus();
  // else {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('suppliers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_supplier.php?action=update&id=" + id + "&name=" + supplier_name.value + "&email=" + supplier_email.value +"&contact_number=" + contact_number.value + "&address=" + supplier_address.value, true);
  xhttp.send();
  // }
}

function cancel() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('suppliers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_supplier.php?action=cancel", true);
  xhttp.send();
}

function searchSupplier(text) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('suppliers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_supplier.php?action=search&text=" + text, true);
  xhttp.send();
}
