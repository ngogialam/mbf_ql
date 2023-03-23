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

function viewEdit(id_team_sys) {
  window.location.href = 'edit_team_sys.php?id_team_sys=' + id_team_sys;
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
  var name_team_sys = document.getElementById("name_team_sys");
  var type = document.getElementById("type_sys");
  var describe = document.getElementById("describe_sys");
  var create_by = document.getElementById("create_by");
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('suppliers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_supplier.php?action=update&id_team_sys=" + id + "&name_team_sys=" + name_team_sys.value + "&type_sys=" + type.value +"&describe_sys=" + describe.value +"&create_by=" + create_by.value , true);
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
