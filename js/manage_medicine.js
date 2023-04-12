function deleteMedicine(id) {
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('medicines_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_medicine.php?action=delete&id=" + id, true);
        xhttp.send();
    }
}

function editMedicine(id_unit_sys) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('medicines_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_medicine.php?action=edit&id_unit_sys=" + id_unit_sys, true);
    xhttp.send();
}

function updateMedicine(id_unit_sys) {
    var name_unit_sys = document.getElementById("name_unit_sys");
    var name_room = document.getElementById("name_room");
    var create_by = document.getElementById("create_by");
    var created_at = document.getElementById("created_at");

    if (!notNull(name_unit_sys.value, "name_unit_sys_error"))
        medicine_name.focus();
    else if (!notNull(name_room.value, "name_room_error"))
        packing.focus();
    else if (!notNull(create_by.value, "create_by_error"))
        create_by.focus();
    else if (!notNull(created_at.value, "created_at_error"))
        created_at.focus();
    else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('medicines_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_medicine.php?action=update&id_unit_sys=" + id_unit_sys + "&name_unit_sys=" + name_unit_sys.value + "&name_room=" + name_room.value + "&create_by=" + create_by.value + "&created_at=" + created_at.value, true);
        xhttp.send();
    }
}

function cancel() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('medicines_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_medicine.php?action=cancel", true);
    xhttp.send();
}

function searchMedicine(text) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('medicines_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_medicine.php?action=search&text=" + text, true);
    xhttp.send();
}

function refresh() {
    console.log('5');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('medicines_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_medicine.php?action=refresh", true);
    xhttp.send();
}