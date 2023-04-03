function deleteMedicineStock(id) {
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('medicines_stock_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_medicine_stock.php?action=delete&id=" + id, true);
        xhttp.send();
    }
}

function editMedicineStock(id_unit_user) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('medicines_stock_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_medicine_stock.php?action=edit&id_unit_user=" + id_unit_user, true);
    xhttp.send();
}

function updateMedicineStock(id_unit_user) {
    var name_unit_user = document.getElementById("name_unit_user");
    var name_room_unit = document.getElementById("name_room_unit");
    var create_by = document.getElementById("create_by");
    var created_at = document.getElementById("created_at");
    if (!notNull(name_unit_user.value, "name_unit_user_error"))
        name_unit_user.focus();
    else if (!notNull(name_room_unit.value, "name_room_unit_error"))
        name_room_unit.focus();
    else if (!notNull(create_by.value, "create_by_error"))
        create_by.focus();
    else if (!notNull(created_at.value, "created_at_error"))
        created_at.focus();
    // else if (Number.parseInt(mrp.value) < Number.parseFloat(rate.value)) {
    //     document.getElementById("rate_error").style.display = "block";
    //     document.getElementById("rate_error").innerHTML = "Rate must be less than MRP!";
    //     rate.focus();
    // } 
    else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('medicines_stock_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_medicine_stock.php?action=update&id_unit_user=" + id_unit_user + "&name_unit_user=" + name_unit_user.value + "&name_room=" + name_room_unit.value + "&create_by=" + create_by.value + "&created_at=" + created_at.value, true);
        xhttp.send();
    }
    document.getElementById("name_room_unit").value;
    console.log(name_room_unit);
    console.log(create_by);
}

function cancel() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('medicines_stock_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_medicine_stock.php?action=cancel", true);
    xhttp.send();
}

function searchMedicineStock(text, tag) {
    if (tag == "NAME") {
        document.getElementById("by_generic_name").value = "";
        document.getElementById("by_suppliers_name").value = "";
    }
    if (tag == "GENERIC_NAME") {
        document.getElementById("by_name").value = "";
        document.getElementById("by_suppliers_name").value = "";
    }
    if (tag == "SUPPLIER_NAME") {
        document.getElementById("by_name").value = "";
        document.getElementById("by_generic_name").value = "";
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('medicines_stock_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_medicine_stock.php?action=search&text=" + text + "&tag=" + tag, true);
    xhttp.send();
}