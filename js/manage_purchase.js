function deletePurchase(id) {
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('purchases_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_purchase.php?action=delete&id=" + id, true);
        xhttp.send();
    }
}

function editPurchase(id_team_user) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('purchases_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_purchase.php?action=edit&id_team_user=" + id_team_user, true);
    xhttp.send();
}

function updatePurchase(id_team_user) {
    var name_team_user = document.getElementById("name_team_user");
    var user_status = document.getElementById("user_status");
    var create_by = document.getElementById("create_by");
    var created_at = document.getElementById("created_at");
    if (!notNull(name_team_user.value, "name_team_user_error"))
        name_team_user.focus();
    else if (!notNull(user_status.value, "user_status_error"))
        user_status.focus();
    else if (!notNull(create_by.value, "create_by_error"))
        create_by.focus();
    else if (!notNull(created_at.value, "created_at_error"))
        created_at.focus();
    else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('medicines_stock_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_purchase.php?action=update&id_team_user=" + id_team_user + "&name_team_user=" + name_team_user.value + "&user_status=" + user_status.value + "&create_by=" + create_by.value + "&created_at=" + created_at.value, true);
        xhttp.send();
    }
}

function printPurchase(id) {
    //Get the HTML of div
    var divElements = document.getElementById("purchases_div").innerHTML;

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
            document.getElementById('purchases_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_purchase.php?action=cancel", true);
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
            document.getElementById('purchases_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_purchase.php?action=search&text=" + text + "&tag=" + tag, true);
    xhttp.send();
}