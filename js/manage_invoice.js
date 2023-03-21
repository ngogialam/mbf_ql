function deleteInvoice(invoice_number) {
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('invoices_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_invoice.php?action=delete&invoice_number=" + invoice_number, true);
        xhttp.send();
    }
}

function viewItem(id_sys) {
    window.location.href = 'detail_sys_ql.php?id_sys=' + id_sys;
}

function viewEdit(id_sys) {
    window.location.href = 'edit_sys_ql.php?id_sys=' + id_sys;
}

function goBack() {
    window.location.href = 'manage_invoice.php';
}

function refresh() {
    console.log('5');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('invoices_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_invoice.php?action=refresh", true);
    xhttp.send();
}

function searchInvoice(text, tag) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('invoices_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_invoice.php?action=search&text=" + text + "&tag=" + tag, true);
    xhttp.send();
}

function printInvoice(invoice_number) {
    var print_content;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            print_content = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_invoice.php?action=print_invoice&invoice_number=" + invoice_number, false);
    xhttp.send();
    var print_window = window.open('', '', 'width=1000,height=600');
    var is_chrome = Boolean(print_window.chrome);
    print_window.document.write(print_content);

    if (is_chrome) {
        setTimeout(function() {
            print_window.document.close();
            print_window.focus();
            print_window.print();
            print_window.close();
        }, 250);
    } else {
        print_window.document.close();
        print_window.focus();
        print_window.print();
        print_window.close();
    }
    return true;
}

function edit(action) {
    document.getElementById('id_sys').disabled = action;
    document.getElementById('name_team_sys').disabled = action;
    document.getElementById('first_number').disabled = action;
    document.getElementById('name_unit_manager').disabled = action;
    document.getElementById('name_user_manager').disabled = action;
    document.getElementById('describe_sys').disabled = action;
    document.getElementById('document_sys').disabled = action;
    document.getElementById('server_sys').disabled = action;
    document.getElementById('ip_sys').disabled = action;
    document.getElementById('config_sys').disabled = action;
    document.getElementById('hidden').style.display = "none";
    if (action) {
        document.getElementById('edit').style.display = "block";
        document.getElementById('update_cancel').style.display = "none";
    } else {
        document.getElementById('edit').style.display = "none";
        document.getElementById('update_cancel').style.display = "block";
    }

    document.getElementById('id_sys_error').style.display = "none";
    document.getElementById('name_team_sys_error').style.display = "none";
    document.getElementById('first_number_error').style.display = "none";
    document.getElementById('name_unit_manager_error').style.display = "none";
    document.getElementById('name_user_manager_error').style.display = "none";
    document.getElementById('describe_sys_error').style.display = "none";
    document.getElementById('document_sys_error').style.display = "none";
    document.getElementById('server_sys_error').style.display = "none";
    document.getElementById('ip_sys_error').style.display = "none";
    document.getElementById('config_sys_error').style.display = "none";

    if (!action)
        document.getElementById('admin_acknowledgement').innerHTML = "";
}