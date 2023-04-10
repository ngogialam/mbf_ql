function deleteInvoice(id_sys) {
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('invoices_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_invoice.php?action=delete&id_sys=" + id_sys, true);
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
    document.getElementById('name_team_sys').disabled = action;
    document.getElementById('first_number').disabled = action;
    document.getElementById('name_unit_manager').disabled = action;
    document.getElementById('name_user_manager').disabled = action;
    document.getElementById('describe_sys').disabled = action;
    document.getElementById('document_sys').disabled = action;
    document.getElementById('server_sys').disabled = action;
    document.getElementById('ip_sys').disabled = action;
    document.getElementById('config_sys').disabled = action;


    if (action) {
        document.getElementById('edit').style.display = "block";
        document.getElementById('update_cancel').style.display = "none";
        document.getElementById('file_des_div').style.display = "none";
    } else {
        document.getElementById('edit').style.display = "none";
        document.getElementById('update_cancel').style.display = "block";
        document.getElementById('file_des_div').style.display = "block";
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

function update() {
    var id_sys = document.getElementById('id_sys').value;
    var team_sys_manager = document.getElementById("team_sys_manager").value;
    var name_sys = document.getElementById("name_sys").value;
    var first_number = document.getElementById("first_number").value;
    var unit_sys = document.getElementById("unit_sys").value;

    var unit_user = document.getElementById("unit_user").value;
    var manager_user = document.getElementById("manager_user").value;
    var describe = document.getElementById("describe_sys").value;
    console.log(describe);
    var document_sys = document.getElementById("document_sys").value;
    var server_sys = document.getElementById("server_sys").value;
    var ip_sys = document.getElementById("ip_sys").value;
    var config_sys = document.getElementById("config_sys").value;
    var create_by = document.getElementById("create_by").value;
    var file_des = document.querySelector('#file_des').files[0];


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('sys_div').innerHTML = xhttp.responseText;
    };

    xhttp.open('POST', 'php/manage_invoice.php');

    var formData = new FormData();
    formData.append("id_sys", id_sys);
    formData.append("team_sys_manager", team_sys_manager);
    formData.append("unit_sys", unit_sys);
    formData.append("unit_user", unit_user);
    formData.append("manager_user", manager_user);
    formData.append("name_sys", name_sys);
    formData.append("first_number", first_number);
    formData.append('describe_sys', describe);
    formData.append('document_sys', document_sys);
    formData.append('server_sys', server_sys);
    formData.append('ip_sys', ip_sys);
    formData.append('config_sys', config_sys);
    formData.append('create_by', create_by);
    formData.append("file_des", file_des);

    xhttp.send(formData);
}

function create() {
    var team_sys_manager = document.getElementById("team_sys_manager").value;
    var name_sys = document.getElementById("name_sys").value;
    var first_number = document.getElementById("first_number").value;
    var unit_sys = document.getElementById("unit_sys").value;
    var unit_user = document.getElementById("unit_user").value;
    var manager_user = document.getElementById("manager_user").value;
    var describe = document.getElementById("describe_sys").value;
    var document_sys = document.getElementById("document_sys").value;
    var server_sys = document.getElementById("server_sys").value;
    var ip_sys = document.getElementById("ip_sys").value;
    var config_sys = document.getElementById("config_sys").value;
    var create_by = document.getElementById("create_by").value;
    var file_des = document.querySelector('#file_des').files[0];


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('sys_div').innerHTML = xhttp.responseText;
    };

    xhttp.open('POST', 'php/add_new_invoice.php');

    var formData = new FormData();
    formData.append("team_sys_manager", team_sys_manager);
    formData.append("name_sys", name_sys);
    formData.append("first_number", first_number);
    formData.append("unit_sys", unit_sys);
    formData.append("unit_user", unit_user);
    formData.append("manager_user", manager_user);
    formData.append('describe_sys', describe);
    formData.append('document_sys', document_sys);
    formData.append('server_sys', server_sys);
    formData.append('ip_sys', ip_sys);
    formData.append('config_sys', config_sys);
    formData.append('create_by', create_by);
    formData.append("file_des", file_des);

    xhttp.send(formData);
}