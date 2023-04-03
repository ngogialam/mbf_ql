function notNull(text, error) {
    var result = document.getElementById(error);
    result.style.display = '"block"';
    if (text < 0) {
        result.innerHTML = "Invalid!";
        return false;
    } else if (text.trim() == "") {
        result.innerHTML = "Must be filled out!";
        return false;
    }
    result.style.display = "none";
    return true;
}

function validateName(name, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (name.trim() == "") {
        result.innerHTML = "Must be filled out!";
        return false;
    }
    result.innerHTML = "Must contain only letters!";
    for (var i = 0; i < name.length; i++)
        if (!((name[i] >= 'a' && name[i] <= 'z') || (name[i] >= 'A' && name[i] <= 'Z') || name[i] == ' '))
            return false;
    result.style.display = "none";
    return true;
}

function validateContactNumber(contact_number, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (contact_number.length != 10) {
        result.innerHTML = "Must contain 10 digits!";
        return false;
    } else
        result.style.display = "none";
    return true;
}

function validateAddress(address, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (address.trim().length < 10) {
        result.innerHTML = "Please enter more specific address!";
        return false;
    } else
        result.style.display = "none";
    return true;
}

function checkExpiry(date, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (date.trim() == "" || date.trim().length != 5 || date[2] != "/")
        result.innerHTML = "Please enter date in mm/yy format!";
    else if (date.slice(0, 2) < 1 || date.slice(0, 2) > 12)
        result.innerHTML = "Invalid month!";
    else if (new Date("20" + date.slice(3, 5), date.slice(0, 2)) < new Date()) {
        result.innerHTML = "Expired Medicine!";
        return -1;
    } else {
        result.style.display = "none";
        return true;
    }
    return false;
}

function checkQuantity(quantity, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (quantity < 0 || !Number.isInteger(parseFloat(quantity)))
        result.innerHTML = "Invalid quantity!";
    else {
        result.style.display = "none";
        return true;
    }
    return false;
}

function checkValue(value, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (value < 0 || value == "")
        result.innerHTML = "Invalid!";
    else {
        result.style.display = "none";
        return true;
    }
    return false;
}

function checkDate(date, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (date == "")
        result.innerHTML = "Mustn't be empty!!";
    else if (new Date(date) > new Date())
        result.innerHTML = "Mustn't be future date!";
    else {
        result.style.display = "none";
        return true;
    }
    return false;
}

function addCustomer() {
    document.getElementById("customer_acknowledgement").innerHTML = "";
    var name_user_manager = document.getElementById("name_user_manager");
    var sdt = document.getElementById("sdt");
    var gmail = document.getElementById("gmail");
    var room = document.getElementById("room");
    var position_manager = document.getElementById("position_manager");
    var create_by = document.getElementById("create_by");
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
    else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById("customer_acknowledgement").innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/add_new_customer.php?name_user_manager=" + name_user_manager.value + "&sdt=" + sdt.value + "&gmail=" + gmail.value + "&room=" + room.value + "&position_manager=" + position_manager.value + "&create_by=" + create_by.value, true);
        xhttp.send();
    }
    console.log(name_user_manager);
    return false;
}

function addSupplier() {
    document.getElementById("new_sys_team").innerHTML = "";
    var name_team_sys = document.getElementById("name_team_sys");
    var type = document.getElementById("type_sys");
    var describe = document.getElementById("describe_sys");
    // 
    console.log(document.getElementById("file_des"))
    console.log(name_team_sys)
    console.log(type)
    console.log(describe)
    var file_des = document.getElementById("file_des").files[0];

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById("new_sys_team").innerHTML = xhttp.responseText;
    };
    xhttp.open('POST','php/add_new_supplier.php',true);
    var formData = new FormData();
    formData.append("file_des", file_des);
    formData.append('name_team_sys', name_team_sys.value);
    formData.append('type_sys', type.value);
    formData.append('describe_sys', describe.value);
    xhttp.send(formData);
}

function addMedicine() {
    document.getElementById("medicine_acknowledgement").innerHTML = "";
    var name = document.getElementById("medicine_name");
    var packing = document.getElementById("packing");
    var generic_name = document.getElementById("generic_name");
    var suppliers_name = document.getElementById("suppliers_name");
    if (!notNull(name.value, "medicine_name_error"))
        name.focus();
    else if (!notNull(packing.value, "pack_error"))
        packing.focus();
    else if (!notNull(generic_name.value, "generic_name_error"))
        generic_name.focus();
    else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById("medicine_acknowledgement").innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/add_new_medicine.php?name=" + name.value + "&packing=" + packing.value + "&generic_name=" + generic_name.value + "&suppliers_name=" + suppliers_name.value, true);
        xhttp.send();
    }
}