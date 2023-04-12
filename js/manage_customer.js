function deleteCustomer(id_user_manager) {
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('customers_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_customer.php?action=delete&id_user_manager=" + id_user_manager, true);
        xhttp.send();
    }
}

function editCustomer(id_user_manager) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('customers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_customer.php?action=edit&id_user_manager=" + id_user_manager, true);
    xhttp.send();
}

function updateCustomer(id_user_manager) {
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
    else if (!validateName(room.value, 'room_err'))
        room.focus();
    else if (!validateName(position_manager.value, 'position_manager_err'))
        position_manager.focus();
    else if (!validateName(create_by.value, 'create_by_err'))
        create_by.focus();
    else if (!notNull(created_at.value, "created_at_error"))
        created_at.focus();
    else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('customers_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_customer.php?action=update&id_user_manager=" + id_user_manager + "&name_user_manager=" + name_user_manager.value + "&sdt=" + sdt.value + "&gmail=" + gmail.value + "&room=" + room.value + "&position_manager=" + position_manager.value + "&create_by=" + create_by.value + "&created_at=" + created_at.value, true);
        xhttp.send();
    }
    // alert('Cập nhật thành công !');
}

function cancel() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('customers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_customer.php?action=cancel", true);
    xhttp.send();
}

function searchCustomer(text) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('customers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_customer.php?action=search&text=" + text, true);
    xhttp.send();
}

var myDiv = document.getElementById("myDiv");
// Hẹn thời gian 5 giây và sau đó ẩn thẻ div

function refresh() {
    console.log('5');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('customers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_customer.php?action=refresh", true);
    xhttp.send();
}