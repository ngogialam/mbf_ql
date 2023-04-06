function deleteUser(id_team_user) {
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('user_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/managerUser.php?action=delete&id_user=" + id_user, true);
        xhttp.send();
    }
}

function editUser(id_user) {
    console.log("55555555");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('user_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/managerUser.php?action=edit&id_user=" + id_user, true);
    xhttp.send();
}

function updateUser(id_user) {
    var id_team_user = document.getElementById("id_team_user");
    var name_user_manager = document.getElementById("name_user_manager");
    var sdt = document.getElementById("sdt");
    var gmail = document.getElementById("gmail");
    var room = document.getElementById("room");
    var position_manager = document.getElementById("position_manager");
    var create_by = document.getElementById("create_by");
    var created_at = document.getElementById("created_at");
    if (!validateName(name_user_manager.value, "name_err"))
        name_user_manager.focus();
    else if (!validateContactNumber(sdt.value, "sdt_err"))
        sdt.focus();
    else if (!validateAddress(gmail.value, "gmail_err"))
        gmail.focus();
    else if (!notNull(room.value, 'room_err'))
        room.focus();
    else if (!notNull(position_manager.value, 'position_manager_err'))
        position_manager.focus();
    else if (!notNull(create_by.value, "create_by_error"))
        create_by.focus();
    else if (!notNull(created_at.value, "created_at_err"))
        created_at.focus();
    else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('user_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/managerUser.php?action=update&id_user=" + id_user + "&id_team_user=" + id_team_user.value + "&name_user_manager=" + name_user_manager.value + "&sdt=" + sdt.value + "&gmail=" + gmail.value + "&room=" + room.value + "&position_manager=" + position_manager.value + "&create_by=" + create_by.value + "&created_at=" + created_at.value, true);
        xhttp.send();
    }
}

function printPurchase(id) {
    //Get the HTML of div
    var divElements = document.getElementById("user_div").innerHTML;

    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;

    //Reset the pages HTML with divs HTML only
    document.body.innerHTML = "<html><head><title></title></head><body>" + divElements + "</body>";

    //Print Page
    window.print();

    //Restore orignal HTML
    document.body.innerHTML = oldPage;
}

function cancel() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('user_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/managerUser.php?action=cancel", true);
    xhttp.send();
}

function searchPurchase(text, tag) {
    if (tag == "VOUCHER_NUMBER") {
        document.getElementById("by_suppliers_name").value = "";
        document.getElementById("by_invoice_number").value = "";
        document.getElementById("by_purchase_date").value = "";
    }
    if (tag == "SUPPLIER_NAME") {
        document.getElementById("by_voucher_number").value = "";
        document.getElementById("by_invoice_number").value = "";
        document.getElementById("by_purchase_date").value = "";
    }
    if (tag == "INVOICE_NUMBER") {
        document.getElementById("by_suppliers_name").value = "";
        document.getElementById("by_voucher_number").value = "";
        document.getElementById("by_purchase_date").value = "";
    }
    if (tag == "PURCHASE_DATE") {
        document.getElementById("by_suppliers_name").value = "";
        document.getElementById("by_voucher_number").value = "";
        document.getElementById("by_invoice_number").value = "";
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('user_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/managerUser.php?action=search&text=" + text + "&tag=" + tag, true);
    xhttp.send();
}